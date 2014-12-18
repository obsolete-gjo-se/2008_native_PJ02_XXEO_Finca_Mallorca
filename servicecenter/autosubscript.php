<?
// auto subscription script

if ( file_exists ( 'includes/mail2date.cfg.php'  )) {
	$SUFFIX='php';
} elseif ( file_exists ( 'includes/mail2date.cfg.php3' ) ) {
    $SUFFIX='php3';
} elseif ( file_exists ( 'includes/mail2date.cfg.php4' ) ) {
    $SUFFIX='php4';
} elseif ( file_exists ( 'includes/mail2date.cfg.php5' ) ) {
	$SUFFIX='php5';
} else {
    exit( 0 );
}

include( 'includes/functions.'.$SUFFIX );
include 'includes/mail2date.cfg.'.$SUFFIX;


if ( isset($_POST['personal']['email']) and ($_POST['personal']['email']<>'') ) {
	$user = read_user(strtolower($_POST['personal']['email']));
	if ($user != 0) {
		$USERDATA_REDISPLAY=1;
		$arrOut['EMAIL_MISMATCH'] = 1;
	}

	$arrOut['personal'] = $_POST['personal'];
	$arrOut['personal']['password'] = mt_rand(1000000,9999999);
	
	$arrOut['userfield']=array();
	$arrOut['userfield2_type1']=array();
	$arrOut['userfield2_type2']=array();
	$arrOut['userfield2_type3']=array();
	$arrOut['userfield2_type4']=array();
	$update = 0;

	// if there no fields firstname, lastname and title, then set default value (enchanced 01.10.07)
	if(!isset($_POST['personal']['firstname'])) $arrOut['personal']['firstname'] = '(Vorname)';
	if(!isset($_POST['personal']['lastname'])) $arrOut['personal']['lastname'] = '(Nachname)';
	if(!isset($_POST['personal']['title'])) $arrOut['personal']['title'] = 'Herr';


	if ( ($arrOut['personal']['firstname'] == '') or ($arrOut['personal']['lastname'] == '') ) {
		$USERDATA_REDISPLAY=1;
		$arrOut['NAME_MISMATCH'] = 1;
	}

	if ( empty($_POST['personal']['email']) or (!check_email($_POST['personal']['email'])) ) {
		$USERDATA_REDISPLAY=1;
		$arrOut['EMAIL_MISMATCH_2'] = 1;
	}

	$arrOut['personal']['email_form'] = $DEFAULT_EMAIL_FORM; //'html';
	$arrOut['MAIL_DEST'] = str_replace('autosubscript','index',$WebServerAddress.$_SERVER['PHP_SELF'].'?action=confirm');
	$Index = str_replace('autosubscript','index',$_SERVER['PHP_SELF']);
		
	if ( $USERDATA_REDISPLAY==0 ) {
		$newsletters = read_newsletters();
		foreach($newsletters as $k=>$v)
			$arrOut['personal']['abo'][$k] = 1;
		
		if ( $CONFIRM_EMAIL == 1 and $update == 0 ) {
			$ret_val = send_email( $arrOut, 'confirmation', $template_dir, $newsletters, $Index );
			echo '<h3>Vielen Dank, Sie wurden angemeldet!</h3><br>';
			if ($CONFIRM_EMAIL > 0) {
				echo 'Bitte &uuml;berpr&uuml;fen Sie Ihr E-Mail-Postfach, Sie sollten eine Best&auml;tigungsmail erhalten.<br>';
			}
			echo '<br><form action="Close"><input type="button" value="Fenster schlie&szlig;en" onclick="self.close()"></form>';
		} 
		else {
			if ($CONFIRM_EMAIL == 2 and $update == 0) {
				$ret_val = send_email2( $arrOut, 'information', $newsletters, $Index );
			}

			$ret_val = write_user(	$arrOut['personal'], 
								$arrOut['personal']['password'], 
								array_keys($arrOut['personal']['abo']),
								$arrOut['userfield']['value'], 
								$update, 
								$arrOut['userfield2_type1'], 
								$arrOut['userfield2_type2'],
								$arrOut['userfield2_type3'],
								$arrOut['userfield2_type4'],
								$CONFIRM_EMAIL);

			if ( $ret_val == 0 ) {
				print( "ERROR Writing file" );
				exit();
			}
    echo '<h3>Vielen Dank, Sie wurden angemeldet!</h3><br>';
		if ($CONFIRM_EMAIL > 0) {
			echo 'Bitte &uuml;berpr&uuml;fen Sie Ihr E-Mail-Postfach, Sie sollten eine Best&auml;tigungsmail erhalten.<br>';
		}


		echo '<br><form action="Close"><input type="button" value="Fenster schlie&szlig;en" onclick="self.close()"></form>';
		}
		exit();
	}
}
else 
{
  echo '<h3 style=\'color: red;\'>Es wurde keine E-Mail-Adresse angegeben</h3><br>Es wurde keine E-Mail-Adresse angegeben, daher können Sie nicht angemeldet werden. Bitte melden Sie sich erneut mit E-Mail-Adresse an.<br><form action="Close"><input type="button" value="Fenster schlie&szlig;en" onclick="self.close()"></form>';
}

if (isset($arrOut['EMAIL_MISMATCH'])) echo '<h3 style=\'color: red;\'>Die E-Mail-Adresse existiert bereits</h3><br>Diese E-Mail-Adresse ist bereits angemeldet, eine erneute Anmeldung kann mit dieser E-Mail-Adresse nicht vorgenommen werden.<br><form action="Close"><input type="button" value="Fenster schlie&szlig;en" onclick="self.close()"></form>';
if (isset($arrOut['EMAIL_MISMATCH_2'])) echo '<h3 style=\'color: red;\'>Die E-Mail-Adresse ist nicht korrekt</h3><br>Die E-Mail-Adresse ist nicht g&uuml;ltig, es kann daher keine Anmeldung vorgenommen werden.<br><input type="button" value="Fenster schlie&szlig;en" onclick="self.close()"></form>';
if (isset($arrOut['NAME_MISMATCH'])) echo '<h3 style=\'color: red;\'>Die Angaben zum Namen sind nicht korrekt</h3><br>F&uuml;r eine erfolgreiche Anmeldung muss sowohl Vorname als auch Nachname angegeben werden.<br><input type="button" value="Fenster schlie&szlig;en" onclick="self.close()"></form>';
?>