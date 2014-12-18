<?php

if (file_exists('includes/mail2date.cfg.php')) {
	$SUFFIX='php';
}
elseif(file_exists('includes/mail2date.cfg.php3')) {
	$SUFFIX='php3';
}
elseif(file_exists('includes/mail2date.cfg.php4')) {
	$SUFFIX='php4';
}
elseif (file_exists('includes/mail2date.cfg.php5')) {
	$SUFFIX='php5';
}
else {
	exit(0);
}


include "includes/mail2date.cfg.".$SUFFIX;


if (isset($_GET['url']) and $_GET['url']!=='') {
	$url = $_GET['url'];
}
else {
	$url = '';
}

$LCK_File = 'lock/sendmail.LCK';

if (isset($_GET['q']) and $_GET['q'] == 'rmlck' ) {
	if ($url == '') {
		print "Removing Lock-File\n";
	}
	if ( file_exists( $LCK_File )) {
		unlink( $LCK_File );
	}
	if ($url == '') {
		print "Removed the lock-file if it existed<br>\n";
	}
	//write_log( "LOCK-File", "Removed the lock-file if it eixisted" );
	exit();
}


$verbose = 1;
if ( isset ( $_GET['verbose']) and $_GET['verbose'] == '1' ) {
	$verbose = 1;
}

if ($verbose) print "Testing $LCK_File<br>\n";

if (file_exists($LCK_File)) {
	$filemtime = filemtime($LCK_File);
	if ($filemtime) {
		if (600 > (time()-$filemtime)) {  # 10 Minuten
			if ($url !== '') {
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: '.$url);
			}
			else {
				if ($url == '') print "Lock-File exists and is not younger than 600 seconds. Aborting<br>\n";
				//write_log("LOCK_file", "Lock-File exists and is not younger than 600 seconds. Aborting");
			}
			if ($url !== '') {
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: '.$url);
			}
			exit();
		}
	}
}

if ($verbose) print "Touching $LCK_File<br>\n";
touch ($LCK_File);

$dir = 'sendmail';
$handle = opendir($dir);

if ($verbose) print "Started : $handle<br>\n";

function myconvert(&$item, $key) {
	$item = intval($item);
}
// support for delete and pause jobs
$delete_jobs = array();
if(file_exists('includes/deletejobs.cfg')) {
	$delete_jobs = file('includes/deletejobs.cfg');
	array_walk($delete_jobs, 'myconvert');
}
$pause_jobs = array();
if(file_exists('includes/pausejobs.cfg')) {
	$pause_jobs = file('includes/pausejobs.cfg');
	array_walk($pause_jobs, 'myconvert');
}


//open log file
$log = fopen('logs/sendfile.log', 'w');
fwrite($log, "sendmail.php started at [".date('d.m.Y H:i:s')."]\n---------------------------------------------\n");

while(($file=readdir($handle))!==false) {
	if ($verbose) print "File : $file<br>\n";
	if(ereg(".eml$",$file) or ereg(".sms$",$file)) {
		if ($verbose) print( "Found email : $file <br>\n");

		// extract job number from file name
		preg_match("/_([0-9]+)_/",$file,$mas);

		// check for delete list
		if(in_array($mas[1],$delete_jobs)) {
			//write_log("$file - (deleted)\n");
			fwrite($log, "$file - (deleted)\n");
			unlink($dir."/".$file);
			continue;
		}

		// check for pause list
		if(in_array($mas[1],$pause_jobs)) {
			//write_log("$file - (paused)\n");
			fwrite($log, "$file - (paused)\n");
			continue;
		}

		if (parse_file_date($file)) {
			if ($verbose) print "date matches <br>\n";

			if(ereg(".eml$",$file))
				$ret = send_file($dir."/".$file);
			else
				$ret = send_sms($dir."/".$file);

			echo '$ret = '.$ret.'<br>';
			
			if ($ret) {
				if ($verbose) print("deleting file $file<br>\n");
				//write_log("$file\n");
				fwrite($log, "$file - (sended)\n");
				unlink($dir."/".$file);
			}
			else {
				//write_log("$file - (send error)\n");
				fwrite($log, "$file - (send error)\n");
			}
		}
	}
}

closedir($handle);
if ($verbose) print "unlink $LCK_File<br>\n";
unlink($LCK_File);

//close log file
fclose($log);

if ($url!=='') {
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: '.$url);
}
else {
	//write_log( "SendMail", "OK: All mails sent; for errors from single mails have a look at the lines above" );
	print "All files for today sent<br>\n";
}
exit();



###################################################################
function parse_file_date($file) {
	global $verbose;
	$result = 0;

	if ($url !== '') {
		#    print "Bitte warten, es geht gleich weiter.<br>";
	}
	else {
		print $file."<br>\n";
	}
	
	$file_ary = split('_',$file);

	$today = date('ymd');
	if ($verbose) print "Today: $today   -   File: ".$file_ary[0]."<br>\n";
	return $file_ary[0]<=$today;
}


function send_sms($file) {
	global $SMSOKReturnCode;

	$tmp = file($file);
	
	// read url for sending sms
	$urlstring = $tmp[0];

	// get url and look at server answer
	$fd = @fopen($urlstring,'r');
	if($fd) {
		$buffer = fgets($fd, 4096);
		fclose ($fd);
	}

	//return (strtoupper(trim($buffer))==strtoupper($SMSOKReturnCode));
	echo 'Buffer = '.$buffer.'<br>';
	echo 'SMSOKReturnCode = '.$SMSOKReturnCode.'<br>';
	echo 'URLString = '.$urlstring.'<br>';
	
	if(preg_match('/'.$SMSOKReturnCode.'/i', $buffer)) {
  	echo 'Das gilt als erfolgreich';
	}
	return preg_match('/'.$SMSOKReturnCode.'/i', $buffer);
}

function send_file ($file) {
	global $verbose, $url;

	# Zuerst Datei einlesen bis Leerzeile kommt.
	# Während des Einlesens testen, ob "To: *", "Subject: *" kommt.
	# Sollte das der Fall sein, Werte extra speichern.
	# Restliche Headerdaten in einem Array speichern. -> Trennen durch \r\n
	# Ist Leerzeile erreicht, sind wir beim Body -> komplett in eigene Variable
	if ($url == '') print "Sending file: $file<br>\n";
	
	$fh = fopen($file, 'r');
	if (!$fh) {
		if ($url == '') print "$file: couldn't open file<br>\n";
		return 0;
	}
	if ($verbose) print "$file: file opened<br>\n";

	$head = 1;
	$message = '';
	$header = '';

	$to = fgets($fh,1024);
	$to_name = fgets($fh,1024);
	$subject = fgets($fh,1024);

	if ($to == '') {
		if ($verbose) print "$file: No Reveiver specified<br>\n";
		return 0;
	}

	while (!feof($fh)) {
		$temp = fgets($fh, 4068);
		if (eregi( "^\n$", $temp) and $head == 1) {
			$head = 0;
		}
		if ($head) {
			$header .= $temp;
		}
		else {
			$message .= $temp;
		}
	}

	fclose( $fh );

	$ret = mail($to, $subject, $message, $header);
	if ($ret = 0) print "Mails konnten nicht verschickt werden\n";
	if ($ret = 1) print "Wurden erfolgreich verschickt\n";
	if ($verbose) print "Return Information from mail: $ret\n";
	return $ret;
}

/*
function write_log($text) {
	$fp = fopen('logs/sendfile.log', 'a');
	fwrite($fp, $text);
	fclose( $fp );
}
*/

?>