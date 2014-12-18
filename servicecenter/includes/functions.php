<?php
	
function correct_fax($fax)
{
	//return preg_match('/^\+?(\d{2,5}\s)*(\d{2,5}\s)*(\d{6,12})$/',$fax);
	return preg_match('/^\+?(\d{2,5}\s)*(\d{2,5}\s)*(\d{6,50})$/',$fax);
}

function correct_sms($sms)
{
	//return preg_match('/^\+?(\d{2,5}\s)*(\d{2,5}\s)*(\d{6,12})$/',$sms);
	return preg_match('/^\+?(\d{2,5}\s)*(\d{2,5}\s)*(\d{6,50})$/',$sms);
}

function check_email($email)
{
	$s = trim(strtolower($email));
	return ereg('^([a-z0-9_]|\\-|\\.)+'.'@'.'(([a-z0-9_]|\\-)+\\.)+'.'[a-z]{2,4}$', $s);
}

###############################################################################
# Diese Exit-Funktion muss verwendet werden, da diese die angelegt LCK-Datei 
# wieder löscht
function my_exit() {
  global $LCK_File;
  unlink ( $LCK_File );
  exit();
}

###############################################################################
# Liste die aktuellen Newsletter aus der Datei "newsletter.csv" ein
# Return: Array of Array mit Newslettern oder 0 falls Datei nicht 
# geöffnet werden kann
function read_newsletters() {

  $newsletter_file = "files/newsletter.csv";

  $fp = fopen( $newsletter_file, "r" );

  if ( !$fp) { return 0; }
#  while (($data = fgetcsv($fp, 1000, ",", "\"" )) !== FALSE ) {
   while (($data = fgetcsv($fp, 1000, "," )) !== FALSE ) {
    if (! isset( $data[0])) {
       next;
    }
    if ( ! isset( $data[2] )) { $data[2] = ''; }
    $newsletter_ary[$data[0]] = array( 'no' => $data[0],
                                       'name' => $data[1],
                                       'description' => $data[2] );
  }
  fclose( $fp );
  return $newsletter_ary;
}

######################################################################
# Liest die Benutzer aus der Datei "files/users.csv" aus und gibt den
# zurück, dessen Email-Adresse passt. Aber es wird nur der letzte Eintrag
# zurückgegeben, falls des Benutzer mehrfach in der Datei auftauchen sollte.
#
# $email: die Emailadresse des zu suchenden Benutzers
# Return: Array mit den Benutzerdaten bei Erfolg, sonst 0
function read_user( $email ) {

  $users_file = "files/users.csv";
  if ( test_lock_file( 'user.csv' ) ) {
    sleep( 1 );
  }
  if ( ! file_exists( $users_file )) {
     return 0;
  }
  $fp = fopen( $users_file, "r" );
  if (! $fp) { return 0; }
#  while (($data = fgetcsv($fp, 1000, ",", "\"" )) !== FALSE) {

  while ( $line = fscanf( $fp, "%s\n" )) {
    $data_string = mydecrypt( $line[0] );
//	 print "<pre>line:";print_r( $line );print "</pre>";
    $data = explode( '","', $data_string );
    $data = str_replace( '"', "" , $data );
  //   print "<pre>data:";print_r( $data );print "</pre>";
    
# while (($data = fgetcsv($fp, 1000, "," )) !== FALSE) {
//	echo '$data[1]='.$data[1].' $email='.$email.'<br>';

    if ( $data[1] == strtolower($email) ) {
//		echo 'finded<br>';
      $user_ary = array( 'email' => $data[1], 'firstname' => $data[2],
                                  'lastname' => $data[3],
                                   'password' => $data[4], 'street' => $data[5],
                                   'zip' => $data[6], 'town' => $data[7],
                                   'status' => $data[9],
                                   'email_form' => $data[11],
                                   'temp_userfields' => $data[12],
                                   'title' => $data[13],
                                   'country' => $data[14],
                                   'birth_day' => $data[15], 'birth_month' => $data[16], 'birth_year' => $data[17] ,									'temp_userfields2_type1'=>$data[18],
								   'temp_userfields2_type2'=>$data[19],
								   'temp_userfields2_type3'=>$data[20],
								   'temp_userfields2_type4'=>$data[21],
									'timestamp'=>$data[0],
									'ip'=>$data[22],
									'fax_number'=>$data[24],
									'sms_number'=>$data[25],
									'also_sms'=>$data[26]
					);
      $my_abo = $data[8];
    }
  }
  fclose( $fp );

  if ( isset ($user_ary) ) {
    $newsletter_abo = array();
    $newsletter_abo = split( ':', $my_abo );
    $temp_abo=array();
    foreach ( $newsletter_abo as $no ) {
      $temp_abo[$no] = 1;
    }
    $user_ary['abo'] = $temp_abo;
    $email = strtolower($data[1]);
    $temp_user = split( ":", $user_ary['temp_userfields'] );
#    print "<pre>LALA:\n";print_r( $temp_user );print "</pre>";
#    $user_ary['userfield']['value'] = preg_replace( '/\\\:/', ':', $temp_user );
    $user_ary['userfield']['value']  = $temp_user;

   //print "<pre>LALA:\n";print_r( $user_ary );print "</pre>";

	$temparr = split(":", $user_ary['temp_userfields2_type1']);
	$i=0;
	while($i<(sizeof($temparr)-1)) {
		$user_ary['userfield2_type1'][$temparr[$i]]=$temparr[$i+1];
		$i=$i+2;
	}

	$temparr = split(":", $user_ary['temp_userfields2_type2']);
	$i=0;
	while($i<(sizeof($temparr)-1)) {
		$user_ary['userfield2_type2'][$temparr[$i]]=$temparr[$i+1];
		$i=$i+2;
	}
	//$user_ary['userfield2_type2'] = split(":", $user_ary['temp_userfields2_type2']);

	$temparr = split(":", $user_ary['temp_userfields2_type3']);
	$i=0;
	while($i<(sizeof($temparr)-1)) {
		$user_ary['userfield2_type3'][$temparr[$i]]=$temparr[$i+1];
		$i=$i+2;
	}

	$temparr = split(":", $user_ary['temp_userfields2_type4']);
	$i=0;
	while($i<(sizeof($temparr)-1)) {
		$user_ary['userfield2_type4'][$temparr[$i]]=$temparr[$i+1];
		$i=$i+2;
	}


    if ( $user_ary['status'] == 9 ) {
      return 0;
    }

    return $user_ary;
  } else {
    return 0;
  }
}

#######################################################################
# Schreibt einen neuen Benutzereintrag ans Ende der Datei "files/users.csv"
#
# $personal: Array mit den übertragenen Formulardaten
# $pass: Das Passwort des Benutzers
# $newsletter: die ID's der abonnierten Newsletter
# $userfields: Array das die Werte und Bezeichnungen der Benutzerfelder enthält
# $update: bool: Ob es sich um ein Update oder Neueintrag handelt
#
function write_user( $personal, $pass, $newsletter, $userfields, $update, $userfields2, $userfields3, $userfields4, $userfields5, $OptIn ) {

  $users_file = "files/users.csv";
  $timestamp = date("d.m.Y H:i:s", time());
  if ( $newsletter == '' ) {
    $abo = '';
  } else {
    $abo = join( ':', $newsletter );
  }

  for ( $i = 0; $i < 10;$i++ ) {
    if ( ! isset ( $userfields[$i] )) {
      $userfields[$i] = '';
    }
    $userfields_2[] = $userfields[$i];
  }

  $temp_userfields = preg_replace( "/:/", ";", $userfields_2 );
  $userfieldstring = join( ":", $temp_userfields );

//Fuga
$userfieldstring2 = '';
foreach($userfields2 as $field)
{
	if ($userfieldstring2!='') $userfieldstring2 .= ':';
	$userfieldstring2 .= $field['name'].':'.$field['value'];
}

//$userfieldstring3 = join( ":", $userfields3);
$userfieldstring3 = '';
foreach($userfields3 as $field)
{
	if ($userfieldstring3!='') $userfieldstring3 .= ':';
	$userfieldstring3 .= $field['name'].':'.$field['value'];
}

$userfieldstring4 = '';
foreach($userfields4 as $field)
{
	if ($userfieldstring4!='') $userfieldstring4 .= ':';
	$userfieldstring4 .= $field['name'].':'.$field['value'];
}

$userfieldstring5 = '';
foreach($userfields5 as $field)
{
	if ($userfieldstring5!='') $userfieldstring5 .= ':';
	$userfieldstring5 .= $field['name'].':'.$field['value'];
}

$ip = getIP();


//Fuga 22.11.06
if($personal['email_form']=='') $personal['email_form']=$DEFAULT_EMAIL_FORM; //'html';


$put_ary = array( $timestamp, strtolower($personal['email']),
                                $personal['firstname'],
                                $personal['lastname'],
                                $pass,
                                $personal['street'],
                                $personal['zip'],
                                $personal['town'],
                                $abo,
                                $update,
                                'leer',
                                $personal['email_form'],
                                $userfieldstring,
                                $personal['title'],
                                $personal['country'],
                                $personal['birth_day'],
                                $personal['birth_month'],
                                $personal['birth_year'],
								$userfieldstring2,
								$userfieldstring3,
								$userfieldstring4,
  								$userfieldstring5,
								$ip,
								$OptIn,
								$personal['fax_number'],
								$personal['sms_number'],
								$personal['also_sms'],
                                 );
/*
echo '<pre>';
print_r($put_ary);
echo '</pre>';
*/

### Hier das Locking für die Datei einbauen.
  $FILE = 'user.csv';
  unlock_file( $FILE, 10 );
  $count = 0;
  while ( test_lock_file( $FILE ) ) {
    sleep( 1 );
    $count++;
  }
  lock_file( $FILE );
  $fp = fopen( $users_file, "a" );
  while ( !$fp ) {
    sleep( 1 );
    $fp =  fopen( $users_file, "a" );
  }

  # Auf jeden Fall schreiben. Falls Datei schon geöffnet, warten und nochmals
  #  versuchen.
  $ret_val = my_fputcsv( $fp, $put_ary, 1 );
  fclose($fp);

  unlock_file( $FILE, 0 );
  return 1;

}

#######################################################################
function send_email( $arrOut, $art, $template_dir, $newsletters, $phpselfname='' ) {
  
	global $SUFFIX;
	global $SENDMAIL_SENDER_NAME;
	global $SENDMAIL_SENDER;
	global $DOUBLEOPTIN_MSG11;
	global $DOUBLEOPTIN_MSG10;
	global $TXTDOpt_Subject;
	global $SEND_CONFIRM_EMAILS_AS_HTML;
	global $WebServerAddress;
	global $MAIL_PARAMETER5;

  
  	if (empty($phpselfname)) $phpselfname = $_SERVER['PHP_SELF'];
  
#  include ( 'templates/email.tmpl.'.$SUFFIX );

  $boundary = md5(uniqid(time()));
  
  $headers = "From: ".$SENDMAIL_SENDER_NAME."<".$SENDMAIL_SENDER.'>' . "\n";
  $headers .= 'Return-Path: '. $SENDMAIL_SENDER . "\n";
  $headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-Type: text/plain; charset=ISO-8859-1; format=flowed  ' . "\n";
	/*$headers .= 'Content-Type: multipart/alternative; boundary="'.$boundary.'"' . "\n";*/

#Christian Start
#Statt den String mit den Inhalten der Anmeldung direkt im Link anzugeben, wird er in eine Datei geschrieben
  $userfilename = "User".date( 'ymd' )."_".time('s')."_".rand(0,999).".txt";
  $fp = fopen( "files/".$userfilename, "a" );
	fwrite($fp, code_email_string( $arrOut ));
	fclose($fp);
#Christian Ende
    
  $html_anmeldungslink = "<a href=\"http://".$arrOut['MAIL_DEST']."&q="
    .$userfilename.'">'; #cc 
		# 	.code_email_string( $arrOut ).'">'; #cc
  $html_anmeldungslink .= $DOUBLEOPTIN_MSG10.'</a>';
  $html_url = '<a href="http://'.$WebServerAddress.$phpselfname.'">http://'.$WebServerAddress.$phpselfname.'</a>';
#    .$_SERVER["PHP_SELF"].'">'.$_SERVER['HTTP_HOST'].'</a>';



  $text_anmeldungslink = 'http://'.$arrOut['MAIL_DEST']."&q="
  .$userfilename; #cc
	#    .code_email_string( $arrOut );  #cc
  $text_url = 'http://'.$WebServerAddress.$phpselfname;


  $receiver = $arrOut['personal']['firstname'].' '
    .$arrOut['personal']['lastname'];

	$html_newsletterlist = '';
	$text_newsletterlist = '';
	if ( is_array( $arrOut['personal']['abo'] ) ) {
		foreach( $arrOut['personal']['abo'] as $key => $value ) {
			$html_newsletterlist .= $newsletters[$key]['name'].'<br>&nbsp;&nbsp;'.$newsletters[$key]['description'].'<p>';
			$text_newsletterlist .= $newsletters[$key]['name']."\n   ".$newsletters[$key]['description']."\n\n";
	    }
	}
  
  $passwort = $arrOut['personal']['password'];


$n = base64_encode( $arrOut['personal']['email'] );
$p = base64_encode( $arrOut['personal']['password'] );
$html_unsubscribelink = '<a href=\'http://'.$WebServerAddress.$phpselfname.'?action=elogoff&n='.$n.'&p='.$p.'\'>'; 
$html_unsubscribelink .= $DOUBLEOPTIN_MSG11.'</a>';

$text_unsubscribelink = 'http://'.$WebServerAddress.$phpselfname.'?action=elogoff&n='.$n.'&p='.$p; 


  $text_message = gen_DOpt_email( 'TEXT', $receiver, $SENDMAIL_SENDER_NAME, 
      $text_newsletterlist, $text_anmeldungslink, $text_url, $passwort, $text_unsubscribelink );
  $html_message = gen_DOpt_email( 'HTML', $receiver, $SENDMAIL_SENDER_NAME, 
      $html_newsletterlist, $html_anmeldungslink, $html_url, $passwort, $html_unsubscribelink );

/*  $outmessage = '--'.$boundary."\n";
  $outmessage .= 'Content-Type: text/plain; charset=ISO-8859-1'."\n";
  $outmessage .= 'Content-Transfer-Encoding: 8bit'."\n\n";*/
  $outmessage .= $text_message."\n\n";

  /*  HTML-Messages make problems with german "Umlaute"

  $outmessage .= '--'.$boundary."\n";
  $outmessage .= 'Content-Type: text/HTML; charset=ISO-8859-1'."\n";
  $outmessage .= 'Content-Transfer-Encoding: 8bit'."\n\n";
  $outmessage .= $html_message."\n";
  $outmessage .= '--'.$boundary.'--'."\n";
  */
  
  mail( strtolower($arrOut['personal']['email']), $TXTDOpt_Subject, $outmessage, $headers, $MAIL_PARAMETER5 );

  return 1;
}

#######################################################################
function code_email_string( $arrOut ) {

  $string1 = serialize( $arrOut );
  $string = base64_encode( $string1 );
  
  return $string;
}

#######################################################################

function decode_string( $string ) {


  $string1 = base64_decode( $string );
  $arrOut = unserialize( $string1 );
  
  return $arrOut;
}


#######################################################################
function calc_changes( $personal, $abo, $old_user, $update, $newsletters ) {

#  print "<pre> personal";print_r( $personal);print "</pre>";
#  print "<pre> abo";print_r( $abo );print "</pre>";
#  print "<pre> old_user";print_r( $old_user );print "</pre>";
#  print "<pre> newsletters: ";print_r( $newsletters );print "</pre>";
  
  $changed = array();
# Differences from user
  foreach ( $personal as $key => $value) {
    if ( $value != $old_user[$key] ) {
      $changed[$key]['deleted'] = $old_user[$key];
      $changed[$key]['new'] = $value;
    }
  }
  
# Differences from newsletters
  if ( is_array( $abo ) ) {
    foreach( $abo as $key => $value ) {  
      if ( ! isset ( $old_user['abo'][$value] ) ) {
        $changed['abo'][$key]['new'] = $newsletters[$value]['name'];
      }
    }
    if ( $old_user != 0 ) {
      foreach ( $old_user['abo'] as $key => $value ) {
        if ( ! in_array( $key, $abo ) ) {
          $changed['abo'][$key]['deleted'] = $newsletters[$value]['name'];
        } 
      }
    }
  }
  return $changed;
}

#######################################################################
function send_password ( $user ) {

  global $EMAIL_FOOTER;
  global $SENDMAIL_SENDER_NAME;
  global $SENDMAIL_SENDER;
  global $SENDPASS_HEADER;
  global $SENDPASS_ANREDE;
  global $SENDPASS_INTRO;
  global $SENDPASS_STARTPASS;
  global $SENDPASS_BEFORE_LINK;
	global $WebServerAddress;


  global $SEND_CONFIRM_EMAILS_AS_HTML;
 
  $car_return = "\n";
  $car_absatz = "\n\n";
  
  $headers = "From: ".$SENDMAIL_SENDER_NAME."<".$SENDMAIL_SENDER.">\r\n";
  
  if ( $SEND_CONFIRM_EMAILS_AS_HTML == 1 ) {
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
    #  $headers .= "To: ".$user['firstname'].' '.$user['lastname'].'<'.$user['email'].'>'."\r\n";
    $car_return = '<br />';
    $car_absatz = '<p />';
  }

  $message = $SENDPASS_ANREDE.' '.$user['title'].' '.$user['firstname'].' '.$user['lastname'].',';
  $message .= $car_absatz;
  $message .= $SENDPASS_INTRO.$car_return;
  $message .= $SENDPASS_STARTPASS.' '.$user['password'];
  $message .= $car_absatz;  
  $message .= $SENDPASS_BEFORE_LINK.$car_return;
  
  if ( $SEND_CONFIRM_EMAILS_AS_HTML == 1 ) {
    $message .= ' <a href="http://'.$WebServerAddress.$_SERVER["PHP_SELF"].'">servicecenter</a><br />';
  } else {
    $message .= 'http://'.$WebServerAddress.$_SERVER["PHP_SELF"];
  }
  $message .= $car_absatz;
  $message .= '';
  
  mail ( $user['email'], $SENDPASS_HEADER, $message, $headers );
  
  return 1;
}


#######################################################################
function my_fputcsv($filePointer, $dataArray, $encrypt=0, $delimiter=',', $enclosure="\"" ){
  // Write a line to a file
  // $filePointer = the file resource to write to
  // $dataArray = the data to write out
  // $delimeter = the field separator

  // Build the string
  $string = "";
  $writeDelimiter = FALSE;
  foreach($dataArray as $dataElement){
    if($writeDelimiter) $string .= $delimiter;
    $dataElement = str_replace( '"', '', $dataElement );
    $string .= $enclosure . $dataElement . $enclosure;
    $writeDelimiter = TRUE;
  } // end foreach($dataArray as $dataElement)

  
  if ( $encrypt == 1 ) {
    $string = mycrypt( $string );
  }
  
  // Append new line
  $string .= "\n";
  
  // Write the string to the file
  fwrite($filePointer, $string);

} // end function my_fputcsv($filePointer, $dataArray, $delimiter)

########################################################
function RandomString($length=32){
  $randstr='';
  srand((double)microtime()*1000000);
  //our array add all letters and numbers if you wish
  $chars = array ( 'a','b','c','d','e','f');
  for ($rand = 0; $rand <= $length; $rand++) {
    $random = rand(0, count($chars) -1);
    $randstr .= $chars[$random];
  }
  return $randstr;
}

############################################################
function make_send_to_friend_lnk($arrOut) {
  
  $string = strtolower($arrOut['personal']['email']);
#  $string .= '::'.$arrOut['personal']['password'];
  
  return "q=".base64_encode( $string );
}
##############################################################
function decode_send_to_friend_lnk( $string ) {

  $decoded = base64_decode( $string );
#  $ary = split( '::', $decoded );
  
  $return['email'] = $decoded;
#  $return['password'] = $ary[1];
  
  return $return;
}

################################################################################
function mail_link_to_friend( $friend, $invitor, $newsletters ) {
  
  global $SENDTOFRIEND_HEADER;
  global $SENDTOFRIEND_INTRO;
  global $SENDTOFRIEND_INTRO_P2;
  global $SENDTOFRIEND_INTRO_P3;
  global $SENDTOFRIEND_INTRO_P4;
  global $SENDTOFRIEND_FILLTEXT;
  global $SENDTOFRIEND_END;
  global $SENDTOFRIEND_END_2;
  global $SENDTOFRIEND_LINK;
  global $SENDMAIL_SENDER;
  global $SENDMAIL_SENDER_NAME;
  global $EMAIL_FOOTER;
	global $WebServerAddress;

  
  
  global $SEND_CONFIRM_EMAILS_AS_HTML;
  

  if ( $SEND_CONFIRM_EMAILS_AS_HTML == 1 ) {
    $car_return = '<br>';
    $car_absatz = '<p>';
    $Leerzeichen = '&nbsp;';
    $friend_text = ereg_replace("\n", "<br>", $friend['text'] );
  } else {
    $car_return = "\n";
    $car_absatz = "\n\n";
    $Leerzeichen = ' '; 
    $friend_text = $friend['text'];
  }
	
  $friend_text = str_replace("\'", "'", $friend_text );
  
  $body = $SENDTOFRIEND_INTRO.' '.$friend['firstname'].' '.$friend['lastname'].','.$car_absatz;
  
  $body .= $SENDTOFRIEND_INTRO_P2.$invitor['firstname']." ".$invitor['lastname'].':'.$car_absatz;
  
  
  $body .= $friend_text;
  
  $body .= $car_return.$car_return.$SENDTOFRIEND_INTRO_P3.$car_return.$car_return;

  if ( is_array( $friend['abo'] ) ) {
    foreach( $friend['abo'] as $key => $value ) {
      $body .= $newsletters[$value]['name'].$car_return;
      $body .= $Leerzeichen.$Leerzeichen.$Leerzeichen.$newsletters[$value]['description'].$car_return;
      $arrOut['personal']['abo'][$key] = 1;
    }
  }
 
  $body .= $car_return.$SENDTOFRIEND_INTRO_P4;
  
  $arrOut['personal']['email'] = strtolower($friend['email']);
  $arrOut['personal']['firstname'] = $friend['firstname'];
  $arrOut['personal']['lastname'] = $friend['lastname'];

  
  if ( $SEND_CONFIRM_EMAILS_AS_HTML == 1 ) {
    $anmelde_link = $WebServerAddress.$_SERVER['PHP_SELF'].'?action=from_friend&q='.code_email_string( $arrOut );
  $body .= '<p><a href="http://'.$anmelde_link.'">'.$SENDTOFRIEND_LINK.'</a><p>';
  } else {
    $body .= "\n".' http://'.$WebServerAddress.$_SERVER['PHP_SELF'].'?action=from_friend&q='.code_email_string( $arrOut )."\n\n";
  }
  $body .= $SENDTOFRIEND_END.$car_return;
  $body .= $SENDTOFRIEND_END_2.' '.$SENDMAIL_SENDER_NAME.'.';
  

  $headers = "From: ".$SENDMAIL_SENDER_NAME."<".$SENDMAIL_SENDER.">\r\n";
  
  if ( $SEND_CONFIRM_EMAILS_AS_HTML == 1 ) {
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
  }
  
  $ret_val = mail ( $friend['email'], $SENDTOFRIEND_HEADER, $body, $headers );

  return 1;
}

###########################################################################
function file_lock_name( $filename ) {

  return 'lock/'.$filename.'.LCK';

}

###########################################################################
function test_lock_file( $filename ) {

  if ( file_exists(file_lock_name($filename)) ) {
    return 1;
  }
  return 0;
}
###########################################################################
function lock_file( $filename ) {

  touch( file_lock_name($filename) );

  return 0;

}
###########################################################################
function unlock_file( $filename, $time_dist = 0 ) {

  $file = file_lock_name($filename);
  if ( file_exists ( $file )) {
    if ( $time_dist == 0 ) {
      unlink( $file );
    } else {
      $filemtime = filemtime( $file );
      if ( $filemtime ) {
        if ( $time_dist < ( time() - $filemtime ) ) {
          unlink( $file );
        }
      }
    }
  }
  return 0;
}


###################################################################
function mycrypt( $string ) {
	$crypted = base64_encode( $string );
	//$crypted = $string;
	return $crypted;
}

function mydecrypt( $string ) {
	$decrypted = base64_decode( $string );
	//$decrypted = $string;
	return $decrypted;
}

####################################################################
function gen_DOpt_email( $FORMAT, $receiver, $sendername, $newsletterlist, $anmeldungslink, $url, $passwort, $unsubscribe_link ){
  global $DOUBLEOPTIN_MSG0;
  global $DOUBLEOPTIN_MSG1;
  global $DOUBLEOPTIN_MSG2;
  global $DOUBLEOPTIN_MSG3;
  global $DOUBLEOPTIN_MSG4;
  global $DOUBLEOPTIN_MSG5;
  global $DOUBLEOPTIN_MSG6;
  global $DOUBLEOPTIN_MSG7;
  global $DOUBLEOPTIN_MSG8;
  global $DOUBLEOPTIN_MSG9;
  global $DOUBLEOPTIN_MSG10;
  global $DOUBLEOPTIN_MSG11;
  global $MINI_MODE_FLAG;
  global $TXTDearReader;

  //global $SHOW_UNSUBSCRIBELINK_IN_EMAIL; 
    
  if ( $FORMAT == 'HTML' ) {
    $car_return = '<br>';
    $car_absatz = '<p>';
  } else {
    $car_return = "\n";
    $car_absatz = "\n\n";
  }

	if ($receiver=='(Vorname) (Nachname)') {
    $message = $TXTDearReader.','.$car_return.$car_return;
	} else {
    $message = $DOUBLEOPTIN_MSG0.' '.$receiver.','.$car_return.$car_return;
	}
  
  $message .= $DOUBLEOPTIN_MSG1.' '.$sendername.'.';
  $message .= $car_absatz;
  $message .= $DOUBLEOPTIN_MSG2;
  $message .= $car_return;
  $message .= $newsletterlist.$car_absatz;
  $message .= $DOUBLEOPTIN_MSG3;
  $message .= $car_return.$anmeldungslink.$car_absatz;

if ($MINI_MODE_FLAG==0) {
  $message .= $DOUBLEOPTIN_MSG4.' '.$url.$DOUBLEOPTIN_MSG5.' '.$car_return;
  $message .= $DOUBLEOPTIN_MSG6.$passwort.$DOUBLEOPTIN_MSG7.$car_absatz;
}

//if ($SHOW_UNSUBSCRIBELINK_IN_EMAIL==1) {
//	  $message .= $DOUBLEOPTIN_MSG10.' '.$unsubscribe_link.' '.$car_absatz;
//}

  $message .= $DOUBLEOPTIN_MSG8.$car_absatz;
  $message .= $DOUBLEOPTIN_MSG9.' '.$sendername;

  return $message;
}











//Fuga make the copy :)
#######################################################################
function send_email2( $arrOut, $art, $newsletters, $phpselfname='') {
  
	global $SUFFIX;
	global $SENDMAIL_SENDER_NAME;
	global $SENDMAIL_SENDER;
	global $DOUBLEOPTIN_MSG10;
	global $DOUBLEOPTIN_MSG11;
	global $TXTDOpt_Subject;
	global $SEND_CONFIRM_EMAILS_AS_HTML;
	global $WebServerAddress;
	global $MAIL_PARAMETER5;

	if (empty($phpselfname)) $phpselfname = $_SERVER['PHP_SELF'];
	

    $boundary = md5(uniqid(time()));
    $headers = "From: ".$SENDMAIL_SENDER_NAME."<".$SENDMAIL_SENDER.'>' . "\n";
	$headers .= 'Return-Path: '. $SENDMAIL_SENDER . "\n";
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-Type: multipart/alternative; boundary="'.$boundary.'"' . "\n";

	$n = base64_encode( $arrOut['personal']['email'] );
	$p = base64_encode( $arrOut['personal']['password'] );
	
	$html_unsubscribelink = '<a href=\'http://'.$WebServerAddress.$phpselfname.'?action=elogoff&n='.$n.'&p='.$p.'\'>'; 
	$html_unsubscribelink .= $DOUBLEOPTIN_MSG11.'</a>';
	$html_url = '<a href="http://'.$WebServerAddress.$phpselfname.'">http://'.$WebServerAddress.$phpselfname.'</a>';

	//$text_unsubscribelink = 'http://'.$WebServerAddress.$_SERVER['PHP_SELF'].'?action=elogoff&n='.$n.'&p='.$p; 
	$text_unsubscribelink = $DOUBLEOPTIN_MSG11.': http://'.$WebServerAddress.$phpselfname.'?action=elogoff&n='.$n.'&p='.$p; 
	$text_url = 'http://'.$WebServerAddress.$phpselfname;

	$receiver = $arrOut['personal']['firstname'].' '.$arrOut['personal']['lastname'];

	$html_newsletterlist = '';
	$text_newsletterlist = '';
	if ( is_array( $arrOut['personal']['abo'] ) ) {
		foreach( $arrOut['personal']['abo'] as $key => $value ) {
			$html_newsletterlist .= $newsletters[$key]['name'].'<br>&nbsp;&nbsp;'.$newsletters[$key]['description'].'<p>';
			$text_newsletterlist .= $newsletters[$key]['name']."\n   ".$newsletters[$key]['description']."\n\n";
	    }
	}
	

	$passwort = $arrOut['personal']['password'];

	$text_message = gen_ConfirmedOpt_email( 'TEXT', $receiver, $SENDMAIL_SENDER_NAME, $text_newsletterlist, $text_unsubscribelink, $text_url, $passwort );
	$html_message = gen_ConfirmedOpt_email( 'HTML', $receiver, $SENDMAIL_SENDER_NAME, $html_newsletterlist, $html_unsubscribelink, $html_url, $passwort );

	$outmessage = '--'.$boundary."\n";
	$outmessage .= 'Content-Type: text/plain; charset=ISO-8859-1'."\n";
	$outmessage .= 'Content-Transfer-Encoding: 8bit'."\n\n";
	$outmessage .= $text_message."\n\n";

	$outmessage .= '--'.$boundary."\n";
	$outmessage .= 'Content-Type: text/HTML; charset=ISO-8859-1'."\n";
	$outmessage .= 'Content-Transfer-Encoding: 8bit'."\n\n";
	$outmessage .= $html_message."\n";
	$outmessage .= '--'.$boundary.'--'."\n";
  
	mail( strtolower($arrOut['personal']['email']), $TXTDOpt_Subject, $outmessage, $headers, $MAIL_PARAMETER5 );

	return 1;
}


####################################################################
function gen_ConfirmedOpt_email( $FORMAT, $receiver, $sendername, $newsletterlist, $unsubscribelink, $url, $passwort ){

  global $DOUBLEOPTIN_MSG0;
  global $DOUBLEOPTIN_MSG1;
  global $DOUBLEOPTIN_MSG2;
  global $DOUBLEOPTIN_MSG3;
  global $DOUBLEOPTIN_MSG4;
  global $DOUBLEOPTIN_MSG5;
  global $DOUBLEOPTIN_MSG6;
  global $DOUBLEOPTIN_MSG7;
  global $DOUBLEOPTIN_MSG8;
  global $DOUBLEOPTIN_MSG9;
  global $DOUBLEOPTIN_MSG10;
  global $DOUBLEOPTIN_MSG11;
	global $TXTDearReader;

  /*global $CONFIRMEDOPTIN_MSG0;
  global $CONFIRMEDOPTIN_MSG1;
  global $CONFIRMEDOPTIN_MSG2;
  global $CONFIRMEDOPTIN_MSG3;
  global $CONFIRMEDOPTIN_MSG4;
  global $CONFIRMEDOPTIN_MSG5;
  global $CONFIRMEDOPTIN_MSG6;
  global $CONFIRMEDOPTIN_MSG7;
  global $CONFIRMEDOPTIN_MSG8;
  global $CONFIRMEDOPTIN_MSG9;*/
  global $MINI_MODE_FLAG;
  global $SHOW_UNSUBSCRIBELINK_IN_EMAIL;
  
  if ( $FORMAT == 'HTML' ) {
    $car_return = '<br>';
    $car_absatz = '<p>';
  } else {
    $car_return = "\n";
    $car_absatz = "\n\n";
  }

/*
  $message = $CONFIRMEDOPTIN_MSG0.' '.$receiver.','.$car_return.$car_return;
  $message .= $CONFIRMEDOPTIN_MSG1;//.' '.$sendername.'.';
  $message .= $car_absatz;
  $message .= $CONFIRMEDOPTIN_MSG2.$car_return;
  $message .= $newsletterlist.$car_absatz;
  $message .= $CONFIRMEDOPTIN_MSG3.$car_return;
//  $message .= $car_return.$anmeldungslink.$car_absatz;

if ($SHOW_UNSUBSCRIBELINK_IN_EMAIL == 1) {
  $message .= $car_absatz.$CONFIRMEDOPTIN_MSG4.' '.$unsubscribelink.$CONFIRMEDOPTIN_MSG5.' '.$car_return;
}

//  $message .= $CONFIRMEDOPTIN_MSG6.$passwort.$CONFIRMEDOPTIN_MSG7.$car_absatz;
//  $message .= $CONFIRMEDOPTIN_MSG8.$car_absatz;
  $message .= $car_absatz.$CONFIRMEDOPTIN_MSG9.' '.$sendername;
*/

// use same variables with Double Opt-In, for easy Delphi programming
    if ($receiver=='(Vorname) (Nachname)') {
		  $message = $TXTDearReader.','.$car_return;
		} else {
      $message = $DOUBLEOPTIN_MSG0.' '.$receiver.','.$car_return;
		}
	 $message .= $DOUBLEOPTIN_MSG1.' '.$sendername.'.';
	 $message .= $car_absatz;
	 $message .= $DOUBLEOPTIN_MSG2;
	 $message .= $car_return;
	 $message .= $newsletterlist.$car_absatz;
//	 $message .= $DOUBLEOPTIN_MSG3.$car_absatz;
//	 $message .= $car_return.$anmeldungslink.$car_absatz;

	 if ($MINI_MODE_FLAG==0) {
		 $message .= $DOUBLEOPTIN_MSG4.' '.$url.$DOUBLEOPTIN_MSG5.' '.$car_return;
		 $message .= $DOUBLEOPTIN_MSG6.$passwort.$DOUBLEOPTIN_MSG7.$car_absatz;
	}

	if ($SHOW_UNSUBSCRIBELINK_IN_EMAIL==1) {
		//$message .= $DOUBLEOPTIN_MSG10.' '.$unsubscribelink.' '.$car_absatz;
		$message .= $unsubscribelink.' '.$car_absatz;
	}

  $message .= $DOUBLEOPTIN_MSG8.$car_absatz;
  $message .= $DOUBLEOPTIN_MSG9.' '.$sendername;
//---------------------

  return $message;
}


function getIP() {

	global $HTTP_X_FORWARDED_FOR;

  $ip="";
  $proxy="";
  $host="";
  
  if (!isset($HTTP_X_FORWARDED_FOR))
    $HTTP_X_FORWARDED_FOR = "";
  if ($HTTP_X_FORWARDED_FOR)
  {
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    $proxy = getenv("REMOTE_ADDR");
    $host = gethostbyaddr($REMOTE_ADDR);
  } 
  else 
  {
    $ip = getenv("REMOTE_ADDR");
    $host = gethostbyaddr($REMOTE_ADDR);
    $proxy = "";
  }              
  
  return $ip.':'.$proxy.':'.$host;
}

?>
