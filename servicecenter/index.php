<?
session_start();

if (file_exists('includes/mail2date.cfg.php')) $SUFFIX='php';
elseif (file_exists('includes/mail2date.cfg.php3')) $SUFFIX='php3';
elseif (file_exists('includes/mail2date.cfg.php4')) $SUFFIX='php4';
elseif (file_exists('includes/mail2date.cfg.php5')) $SUFFIX='php5';
else exit("Can't find configuration file...");

include_once 'includes/functions.'.$SUFFIX;
$template_dir = 'templates/';
include_once 'includes/mail2date.cfg.'.$SUFFIX;

// What is it??? maintenance.tmpl.php is absent....
if (file_exists('lock/newsletter_FTP.LCK')) {
//  include($template_dir.'maintenance.tmpl.'.$SUFFIX );
  my_exit();
}


# Sofort Datei anlegen, dass ich dran bin.
$LCK_File = 'lock/newsletter_'.RandomString(8).'.LCK';
touch ($LCK_File);


error_reporting(E_ALL);
ini_set('display_errors', false);
ini_set('html_errors', false);


if ( $DEBUG ) {
  print "<pre>";
  print "POST: \n";
  print_r( $_POST );
  print "GET: \n";
  print_r( $_GET );
  print "COOKIE: \n";
  print_r( $_COOKIE );
  print "</pre>";
}

// set action variable
$action = ($MINI_MODE_FLAG==0)?'init':'new';
if (isset($_GET['action'])) $action = $_GET['action'];
elseif (isset($_POST['action'])) $action = $_POST['action'];

// check needed file existance
$login_tmpl = $template_dir.'login.tmpl.'.$SUFFIX;
if(!file_exists($login_tmpl)) exit ("File $login_tmpl not found...");
$userdata_tmpl = $template_dir.'userdata.tmpl.'.$SUFFIX;
if(!file_exists($userdata_tmpl)) exit ("File $userdata_tmpl not found...");
$password_forgotten_tmpl = $template_dir.'password_forgotten.tmpl.'.$SUFFIX;
if(!file_exists($password_forgotten_tmpl)) exit ("File $password_forgotten_tmpl not found...");
$thanks_sendpass_tmpl = $template_dir.'thanks_sendpass.tmpl.'.$SUFFIX;
if(!file_exists($thanks_sendpass_tmpl)) exit ("File $thanks_sendpass_tmpl not found...");
$sendtofriend_tmpl = $template_dir.'sendtofriend.tmpl.'.$SUFFIX;
if(!file_exists($sendtofriend_tmpl)) exit ("File $sendtofriend_tmpl not found...");
$thanks_sendtofriend_tmpl = $template_dir.'thanks_sendtofriend.tmpl.'.$SUFFIX;
if(!file_exists($thanks_sendtofriend_tmpl)) exit ("File $thanks_sendtofriend_tmpl not found...");
$removed_from_all_tmpl = $template_dir.'removed_from_all.tmp.'.$SUFFIX;
if(!file_exists($removed_from_all_tmpl)) exit ("File $removed_from_all_tmpl not found...");
$thanks_userdata_confirm_tmpl = $template_dir.'thanks_userdata_confirm.tmpl.'.$SUFFIX;
if(!file_exists($thanks_userdata_confirm_tmpl)) exit ("File $thanks_userdata_confirm_tmpl not found...");
$thanks_userdata_tmpl = $template_dir.'thanks_userdata.tmpl.'.$SUFFIX;
if(!file_exists($thanks_userdata_tmpl)) exit ("File $thanks_userdata_tmpl not found...");
$terms_tmpl = $template_dir.'terms.tmpl.'.$SUFFIX;
if(!file_exists($terms_tmpl)) exit ("File $terms_tmpl not found...");
$imprint_tmpl = $template_dir.'imprint.tmpl.'.$SUFFIX;
if(!file_exists($imprint_tmpl)) exit ("File $imprint_tmpl not found...");
$subscriptions_tmpl = $template_dir.'subscriptions.tmpl.'.$SUFFIX;
if(!file_exists($subscriptions_tmpl)) exit ("File $subscriptions_tmpl not found...");
$confirm_delete_tmpl = $template_dir.'confirm_delete.tmpl.'.$SUFFIX;
if(!file_exists($confirm_delete_tmpl)) exit ("File $confirm_delete_tmpl not found...");
$change_password_tmpl = $template_dir.'changepassword.tmpl.'.$SUFFIX;
if(!file_exists($change_password_tmpl)) exit ("File $change_password_tmpl not found...");
$Thanks_change_password_tmpl = $template_dir.'thanks_change_password_form.tmpl.'.$SUFFIX;
if(!file_exists($Thanks_change_password_tmpl)) exit ("File $Thanks_change_password_tmpl not found...");



# Userfields einbinden
foreach ( $USERFIELDS as $field ) {
  $arrOut['userfield']['name'][] = $field;
  $arrOut['userfield']['value'][] = '';
}


//Fuga

//array for sorting unlimited userfileds.
// array( userfieldtype, localnum)
// userfieldtype = 1..4 (editbox, checkbox, combobox, radiobuttons)
// localnum = position (key) of element in base array
$arrOut['USERFIELDS2_SORTORDER']=array();


//editbox
$arrOut['userfield2_type1']=array();
foreach($USERFIELDS2_TYPE1 as $key=>$value)
{
	$temparr=array();
	$temparr['name']=$key;
	$temparr['order']=$value[0];
	$temparr['description']=$value[1];
	$temparr['obligatory']=$value[2];
	$temparr['visibility']=$value[3];
	$temparr['default']=$value[4];
	$temparr['error_message']=$value[5];
	$temparr['value']=$value[6];
	$temparr['missing']=0;
	$arrOut['userfield2_type1'][$key]=$temparr;
	$arrOut['USERFIELDS2_SORTORDER'][$temparr['order']] = array(1, $key);
}

//checkbox
$arrOut['userfield2_type2']=array();
foreach($USERFIELDS2_TYPE2 as $key=>$value)
{
	$temparr=array();
	$temparr['name']=$key;
	$temparr['order']=$value[0];
	$temparr['description']=$value[1];
	$temparr['obligatory']=$value[2];
	$temparr['visibility']=$value[3];
	$temparr['default']=$value[4];
	$temparr['error_message']=$value[5];
	$temparr['value']=$value[4];
	$temparr['missing']=0;
	$arrOut['userfield2_type2'][$key]=$temparr;
	$arrOut['USERFIELDS2_SORTORDER'][$temparr['order']] = array(2, $key);
}

//combobox
$arrOut['userfield2_type3']=array();
foreach($USERFIELDS2_TYPE3 as $key=>$value)
{
	$temparr=array();
	$temparr['name']=$key;
	$temparr['order']=$value[0];
	$temparr['description']=$value[1];
	$temparr['obligatory']=$value[2];
	$temparr['visibility']=$value[3];
	$temparr['default']=$value[4];
	$temparr['set']=$value[5];
	$temparr['error_message']=$value[6];
	$temparr['value']=$value[4];
	$temparr['missing']=0;
	$arrOut['userfield2_type3'][$key]=$temparr;
	$arrOut['USERFIELDS2_SORTORDER'][$temparr['order']] = array(3, $key);
}

//radiobuttons
$arrOut['userfield2_type4']=array();
foreach($USERFIELDS2_TYPE4 as $key=>$value)
{
	$temparr=array();
	$temparr['name']=$key;
	$temparr['order']=$value[0];
	$temparr['description']=$value[1];
	$temparr['obligatory']=$value[2];
	$temparr['visibility']=$value[3];
	$temparr['default']=$value[4];
	$temparr['set']=$value[5];
	$temparr['error_message']=$value[6];
	if(in_array($value[4], $value[5])) {
		$temparr['value']=$value[4];
	} 
	else {
		$temparr['value']='';
	}
	$temparr['missing']=0;
	$arrOut['userfield2_type4'][$key]=$temparr;
	$arrOut['USERFIELDS2_SORTORDER'][$temparr['order']] = array(4, $key);
}

ksort($arrOut['USERFIELDS2_SORTORDER']);
reset($arrOut['USERFIELDS2_SORTORDER']);


$arrOut['USERFIELDSMUST'] = $USERFIELDSMUST;
$arrOut['TITLEMUST'] = $TITLEMUST;
$arrOut['BIRTHDATEMUST'] = $BIRTHDATEMUST;
//$arrOut['ADDRESSMUST'] = $ADDRESSMUST;
$arrOut['COUNTRYMUST'] = $COUNTRYMUST;
$arrOut['STREETMUST'] = $STREETMUST;
$arrOut['ZIPMUST'] = $ZIPMUST;
$arrOut['CITYMUST'] = $CITYMUST;

/// ????
$STARTPAGE = $_SERVER["PHP_SELF"];

$TXT_AGB = $TXT_AGB_1."<a href=\"".$STARTPAGE."\">Login</a>".$TXT_AGB_2." ".$SENDMAIL_SENDER_NAME;



switch ( $action ) {

// -------- terms page
	case 'terms':
		include($terms_tmpl);
		my_exit();
	break;

// -------- imprint page
	case 'imprint':
		include($imprint_tmpl);
		my_exit();
	break;

// -------- subscription page
	case 'subscriptions':
		$arrOut['DEST'] = $_SERVER["PHP_SELF"]."?action=changesubscriptions";
		include($subscriptions_tmpl);
		my_exit();
	break;

// -------- check valid data from subscription page and write changes if all right
	case 'changesubscriptions':

		if(isset($_POST['abo'])) {
			$_SESSION['info']['personal']['abo'] = array();
			foreach ($_POST['abo'] as $abo1) {
				$_SESSION['info']['personal']['abo'][$abo1] = 1;
			}
		} 
		else {
			$_SESSION['info']['personal']['abo'] = array();
			$arrOut['LETTER_MISMATCH'] = 1;
			$SUBSCRIPTION_REDISPLAY=1;
		}

		$_SESSION['info']['personal']['email_form'] = $_POST['personal']['email_form'];

		if ($_POST['personal']['email_form']=='fax') {
			$_SESSION['info']['personal']['fax_number'] = $_POST['personal']['fax_number'];
			if(!correct_fax($_POST['personal']['fax_number'])) {
				$arrOut['FAX_NUMBER_MISMATCH'] = 1;
				$SUBSCRIPTION_REDISPLAY=1;
			}
		}
		else {
			$_SESSION['info']['personal']['fax_number'] = '';
		}
		
		if($_POST['personal']['also_sms'] == 'on') {
			//$_SESSION['info']['personal']['also_sms'] = 1;
			$_SESSION['info']['personal']['also_sms'] = 'on';
			$_SESSION['info']['personal']['sms_number'] = $_POST['personal']['sms_number'];
			if(!correct_sms($_POST['personal']['sms_number'])) {
				$arrOut['SMS_NUMBER_MISMATCH'] = 1;
				$SUBSCRIPTION_REDISPLAY=1;
			}
		}
		else {
			$_SESSION['info']['personal']['also_sms'] = '';
			$_SESSION['info']['personal']['sms_number'] = '';
		}
	
		if($SUBSCRIPTION_REDISPLAY==1) {
			$arrOut['DEST'] = $_SERVER["PHP_SELF"]."?action=changesubscriptions";
			include($subscriptions_tmpl);
			my_exit();
		}
		else {
			$temp_pass = read_user($_SESSION['info']['personal']['email']);

			$ret_val = write_user(	$_SESSION['info']['personal'], 
									$temp_pass['password'], //$_SESSION['info']['personal']['password'], 
									array_keys($_SESSION['info']['personal']['abo']),
						            $_SESSION['info']['userfield']['value'], 
									1, 
									$_SESSION['info']['userfield2_type1'], 
									//array_keys($_POST['userfields3']),
									$_SESSION['info']['userfield2_type2'],
									$_SESSION['info']['userfield2_type3'],
									$_SESSION['info']['userfield2_type4'],
									$CONFIRM_EMAIL);
			unset($temp_pass);
			
			$arrOut = $_SESSION['info'];
			$arrOut['send_email'] = 0;
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time() );
			include $thanks_userdata_confirm_tmpl;
			my_exit();
		}
	break;


// -------- profile page, used userpage_tmpl
	case 'profile':
		if(session_is_registered('user_logged')) {
			//$arrOut['personal'] = $_SESSION['info']['personal'];
			$arrOut = $_SESSION['info'];
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time()+600 );
			$arrOut['DEST'] = $_SERVER["PHP_SELF"]."?action=userdata";
			include $userdata_tmpl;
			my_exit();
		}
		else {
			include $login_tmpl;
			my_exit();
		}
	break;


// -------- 
	case 'changepassword':
		include $change_password_tmpl;
		my_exit();
	break;

// -------- 
	case 'changepasswordconfirm':

		$temp_pass = read_user($_SESSION['info']['personal']['email']);

		if($_POST['old']!=$temp_pass['password']) $error = 1;
		if($_POST['new']=='') $error = 2;
		if($_POST['new']!=$_POST['new1']) $error = 3;
		unset($temp_pass);

		if($error!=0) {
			include $change_password_tmpl;
			my_exit();
		}
		else {
			//$_SESSION['info']['personal']['password'] = $_POST['new'];
			$ret_val = write_user(	$_SESSION['info']['personal'], 
									$_POST['new'], //$_SESSION['info']['personal']['password'], 
									array_keys($_SESSION['info']['personal']['abo']),
						            $_SESSION['info']['userfield']['value'], 
									1, 
									$_SESSION['info']['userfield2_type1'], 
									//array_keys($_POST['userfields3']),
									$_SESSION['info']['userfield2_type2'],
									$_SESSION['info']['userfield2_type3'],
									$_SESSION['info']['userfield2_type4'],
									$CONFIRM_EMAIL);			
			$arrOut = $_SESSION['info'];
			$arrOut['send_email'] = 0;
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time() );
			include $Thanks_change_password_tmpl;
			my_exit();
		}

	break;


// -------- init, call login page
	# Standardausgabe, falls kein Parameter angegeben wurde
	case 'init':
		include( $login_tmpl);
		my_exit();
	break;



// -------- login page
	# Loggt in das System ein und zeigt die Benutzerdaten, falls
	#  Passwort und Username/Emailaddresse stimmen.
	case 'login':
		// close previous session data
		session_unset();
		$pass = (isset($_POST['password']))?$_POST['password']:'';
		$email = (isset($_POST['email']))?$_POST['email']:'';

		# Falls pass oder email == '' => Zeige wieder login-Seite. 
		if ( $pass == '' or $email == '' ) {
		#      $arrOut['PASSWORD_MISMATCH'] = 1;
			include $login_tmpl;
			my_exit();
		}

		# Benutzerdaten, die zur "email" gehören einlesen
		$user = read_user( $email );

		# user ist 0, falls die Emailadresse nicht gefunden werden kann,
		if ( $user != 0 ) {
		
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time()+600 );
			# Benutzer ist vorhanden, aber passwort stimmt nicht. 
			if ( $user['password'] != $pass ) {
				$arrOut['PASSWORD_MISMATCH'] = 1;
				include $login_tmpl;
				exit();
			}

			$arrOut['personal'] = $user;
			# Alle vorhandenen Newsletter einlesen
			$arrOut['newsletters'] = read_newsletters();
			$arrOut['checked_news'] = $user['abo'];
			$arrOut['userfield']['value'] = $user['userfield']['value'];

			//load editbox values
			foreach($user['userfield2_type1'] as $key=>$value) 
				$arrOut['userfield2_type1'][$key]['value'] = $value;

			foreach($user['userfield2_type2'] as $key=>$value) 
				$arrOut['userfield2_type2'][$key]['value'] = $value;

			//load combobox values
			foreach($user['userfield2_type3'] as $key=>$value) 
				$arrOut['userfield2_type3'][$key]['value'] = $value;

			//load radiobuttons values
			foreach($user['userfield2_type4'] as $key=>$value) 
				$arrOut['userfield2_type4'][$key]['value'] = $value;

			$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=userdata';

			$arrOut['GlobalRemoveLnk'] = $_SERVER["PHP_SELF"].'?action=logoff'
				.'&n='.base64_encode( strtolower($arrOut['personal']['email'] ))
				.'&p='.base64_encode( $arrOut['personal']['password'] );

			$arrOut['SendToFriendLnk'] = $_SERVER["PHP_SELF"].'?action=sendtofriend'
				.'&n='.base64_encode( strtolower($arrOut['personal']['email']))
				.'&p='.base64_encode( $arrOut['personal']['password'] );

			foreach ( $USERFIELDS as $field ) {
				$arrOut['userfield']['value'][] = '';
			}
			$arrOut['AGB'] = 1;
			
			// ----------------- user log in seccessfully, write it fact in session variable...
			// close previous session data
			session_unset();
			// open new session data
			session_register('user_logged');
			session_register('info');
			$_SESSION['info'] = $arrOut;

			include $userdata_tmpl;
			my_exit();
		} 
		else {

			# Benutzer nicht vorhanden -> login-seite anzeigen
			$arrOut['PASSWORD_MISMATCH'] = 1;
			include $login_tmpl;
			my_exit();
		}
	break;
	// --------------- break login block



	# Es wurden die Daten der Seite "userdata_tmpl" übermittelt
	case 'userdata':

		// åñëè íåò ìàññèâà personal òî îòïðàâëÿåì ëîãèíèòüñÿ...
		if(!isset($_POST['personal'])) {
			include $login_tmpl;
			my_exit();
		}
		
		// ÷èòàåì èíôó î þçåðå ïî ïîëó÷åííîìó email
		$user = read_user(strtolower($_POST['personal']['email']));
		$update = 0;

		// åñëè åñòü êóêà
		if(!empty($_COOKIE['ServiceCenter'])) {
			// è þçåð ïî äàííîì åìàéëó íàéäåí, òî update=1
			if($user != 0) $update = 1;

			$cookie_val = base64_encode('ServiceCenter');
			// åñëè çíà÷åíèå êóêè íå òî, òî îòïðàâëÿåì ëîãèíèòüñÿ
			if( $_COOKIE['ServiceCenter'] != $cookie_val ) {
				include $login_tmpl;
				my_exit();
			}
		} 
		else {
			// åñëè íåò êóêè, è åñòü ïîëüçîâàòåëü ñ äàííûì åìàéëîì, òî ïèøåì ÷òî åìàéë çàíÿò
			if ( $user != 0 ) {
				# Es gibt einen Benutzer mit gleicher Email
				$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=userdata';
				$arrOut['newsletters'] = read_newsletters();

				$arrOut['personal']['title'] = '';
				$arrOut['personal']['email'] = '';
				$arrOut['personal']['firstname'] = '';
				$arrOut['personal']['lastname'] = '';
				$arrOut['personal']['street'] = '';
				$arrOut['personal']['zip'] = '';
				$arrOut['personal']['town'] = '';
				$arrOut['personal']['email_form'] = $DEFAULT_EMAIL_FORM; //'html';
				$arrOut['personal']['fax_number']='';
				$arrOut['personal']['sms_number']='';
				$arrOut['new'] = 1;
				$arrOut['EMAIL_MISMATCH'] = 1;
				include $userdata_tmpl;
				my_exit();
			}
		}


		$arrOut['personal'] = $_POST['personal'];
		$arrOut['personal']['password'] = $_POST['password'];
		$arrOut['newsletters'] = read_newsletters();
		$arrOut['userfield']['value'] = $_POST['userfields'];

		//editbox
		foreach($_POST['userfields2'] as $key=>$value) {
			$arrOut['userfield2_type1'][$key]['value']=$value;
		}
	
		//checkbox
		foreach($arrOut['userfield2_type2'] as $key=>$value) {
			if (in_array($key, array_keys($_POST['userfields3']))) {
				$arrOut['userfield2_type2'][$key]['value']=1;
			}
			else {
				$arrOut['userfield2_type2'][$key]['value']=0;
			}
		}
	
		//combobox
		foreach($_POST['userfields4'] as $key=>$value) {
			$arrOut['userfield2_type3'][$key]['value']=$value;
		}

		//radiobuttons
		foreach($_POST['userfields5'] as $key=>$value) {
			$arrOut['userfield2_type4'][$key]['value']=$value;
		}

		$USERDATA_REDISPLAY=0;

		//if (in_array("Password",$USERFORMFIELDSVISIBILITY)) {
		if ($MINI_MODE_FLAG==0) {

			# Passwort ungereimtheit feststellen
			if ( (($_POST['password'] != $_POST['password2'] or empty($_POST['password'])) and $update == 0) 
				or (empty($_COOKIE['ServiceCenter']) and $user != 0) 
				or ($update == 1 and $_POST['password'] != $_POST['password2'])	) {
				# Passwörter nicht gleich oder leer 
				# -> Hinweis und userdata_tmpl anzeigen mit schon
				# ausgefüllten Feldern.
				$arrOut['PASSWORD_MISMATCH'] = 1;
				$USERDATA_REDISPLAY=1;
				$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=userdata';
				setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time()+600 );
			}
		}

		if ( empty($_POST['personal']['email']) or (!check_email($_POST['personal']['email'])) ) {
			$USERDATA_REDISPLAY=1;
			$arrOut['EMAIL_MISMATCH_2'] = 1;
		}


		if (($_POST['personal']['country'] == $NO_COUNTRY_SYMBOL) and ($arrOut['COUNTRYMUST'] == 1)) {
			$USERDATA_REDISPLAY=1;
			$arrOut['COUNTRY_MISMATCH'] = 1;
		}

		# Sollte es ein Update sein, und der Benutzer kein Passwort
		#  angegeben haben, nimm das alte
		if ( $update == 1 ) {
			if ( $_POST['password'] == '' ) {
				$_POST['password'] = $user['password'];
			}
		}
		$ret_val = 0;

		if (( ! isset( $_POST['agb'] ) or $_POST['agb'] == 0 ) 
			and in_array("AGB",$USERFORMFIELDSVISIBILITY)
		) {
			$USERDATA_REDISPLAY=1;
			$arrOut['AGB_MISMATCH'] = 1;
		}

		# Hier alle obligatorischen Felder prüfen
		# Zuerst die Anrede.
		if ( $TITLEMUST==1 and (! isset ( $_POST['personal']['title'] ) or $_POST['personal']['title'] == '' )
			and in_array("Title",$USERFORMFIELDSVISIBILITY)
		) {
			$USERDATA_REDISPLAY=1;
			$arrOut['TITLE_MISMATCH'] = 1;
		}

		# Name:
		if ( ! isset ( $_POST['personal']['firstname'] )
			or ! isset ( $_POST['personal']['lastname'] )
			or  $_POST['personal']['firstname'] == ''
			or $_POST['personal']['lastname'] == '' ) {
			$USERDATA_REDISPLAY=1;
			$arrOut['NAME_MISMATCH'] = 1;
		}


		//street
		if ( $STREETMUST==1 and in_array("Street",$USERFORMFIELDSVISIBILITY)) 
			if (!isset($_POST['personal']['street']) or ($_POST['personal']['street'] == '' )) {
				$USERDATA_REDISPLAY=1;
				$arrOut['STREET_MISMATCH'] = 1;
			}

		//zip
		if ( $ZIPMUST==1 and in_array("Zip",$USERFORMFIELDSVISIBILITY)) 
			if (!isset($_POST['personal']['zip']) or ($_POST['personal']['zip'] == '' )) {
				$USERDATA_REDISPLAY=1;
				$arrOut['ZIP_MISMATCH'] = 1;
			}

		//city
		if ( $CITYMUST==1 and in_array("City",$USERFORMFIELDSVISIBILITY)) 
			if (!isset($_POST['personal']['town']) or ($_POST['personal']['town'] == '' )) {
				$USERDATA_REDISPLAY=1;
				$arrOut['CITY_MISMATCH'] = 1;
			}

		# Geburtstag prüfen
		if ( $BIRTHDATEMUST == 1 and
			in_array("Birthday",$USERFORMFIELDSVISIBILITY) and
			( $_POST['personal']['birth_day'] == 0
			or $_POST['personal']['birth_month'] == 0
			or $_POST['personal']['birth_year'] == 0 ) ) {
			$USERDATA_REDISPLAY=1;
			$arrOut['BIRTHDATE_MISMATCH'] = 1;
		}
         
		# Benutzerfelder prüfen:
		$fieldcounter=0;
		foreach ( $arrOut['userfield']['name'] as $fieldname ) {
			if ( $fieldname != '' and $USERFIELDSMUST[$fieldcounter] == 1
				and ( ! isset( $arrOut['userfield']['value'][$fieldcounter]) or $arrOut['userfield']['value'][$fieldcounter] == '' )) {
				$USERDATA_REDISPLAY=1;
				$arrOut['USERFIELD_MISMATCH'][$fieldcounter] = 1;
			}
			$fieldcounter++;
		}

		//Fuga
		//check for data in fields 

		if ($MINI_MODE_FLAG==0) {

			foreach($arrOut['userfield2_type1'] as $field) {
				if(($field['obligatory']==1) and ($field['visibility']==1) and ($field['value']=='')) {
					$USERDATA_REDISPLAY=1;
					$arrOut['userfield2_type1'][$field['name']]['missing']=1;
				}
			}

			foreach($arrOut['userfield2_type2'] as $field) {
				if(($field['obligatory']==1) and ($field['visibility']==1) and ($field['value']==0)) {
					$USERDATA_REDISPLAY=1;
					$arrOut['userfield2_type2'][$field['name']]['missing']=1;
				}
			}

			foreach($arrOut['userfield2_type3'] as $field) {
				if(($field['obligatory']==1) and ($field['visibility']==1) and ($field['value']=='')) {
					$USERDATA_REDISPLAY=1;
					$arrOut['userfield2_type3'][$field['name']]['missing']=1;
				}
			}

			foreach($arrOut['userfield2_type4'] as $field) {
				if(($field['obligatory']==1) and ($field['visibility']==1) and ($field['value']=='')) {
					$USERDATA_REDISPLAY=1;
					$arrOut['userfield2_type4'][$field['name']]['missing']=1;
				}
			}

		}

/*
		echo '<pre>';
		print_r($_POST);
		print_r($arrOut);
		echo '</pre>';
*/


//
		if(isset($_POST['personal']['email_form'])) {
			$_SESSION['info']['personal']['email_form'] = $_POST['personal']['email_form'];

			if ($_POST['personal']['email_form']=='fax') {
				$_SESSION['info']['personal']['fax_number'] = $_POST['personal']['fax_number'];
				if(!correct_fax($_POST['personal']['fax_number'])) {
					$arrOut['FAX_NUMBER_MISMATCH'] = 1;
					$USERDATA_REDISPLAY=1;
				}
			}
			else {
				$_SESSION['info']['personal']['fax_number'] = '';
			}
		
			if($_POST['personal']['also_sms'] == 'on') {
				//$_SESSION['info']['personal']['also_sms'] = 1;
				$_SESSION['info']['personal']['also_sms'] = 'on';
				$_SESSION['info']['personal']['sms_number'] = $_POST['personal']['sms_number'];
				if(!correct_sms($_POST['personal']['sms_number'])) {
					$arrOut['SMS_NUMBER_MISMATCH'] = 1;
					$USERDATA_REDISPLAY=1;
				}
			}
			else {
				$_SESSION['info']['personal']['also_sms'] = '';
				$_SESSION['info']['personal']['sms_number'] = '';
			}
		}


		$arrOut['personal'] = $_POST['personal'];
		if (!isset($_POST['personal']['email_form'])) {
			$arrOut['personal']['email_form'] = $_SESSION['info']['personal']['email_form'];
			$arrOut['personal']['also_sms'] = $_SESSION['info']['personal']['also_sms'];
			$arrOut['personal']['sms_number'] = $_SESSION['info']['personal']['sms_number'];
			$arrOut['personal']['fax_number'] = $_SESSION['info']['personal']['fax_number'];
		}


		if (!isset($_POST['abo'])) {
			// åñëè íåò abo è þçåð íå çàðåãèñòðèðîâàí, òîãäà ïðè ðåãèñòðàöèè íå óêàçàëè íèîäíó ðàññûëêó
			if(!session_is_registered('user_logged')) {
				$arrOut['LETTER_MISMATCH']=1;
				$USERDATA_REDISPLAY=1;
			}
			else {
				$arrOut['personal']['abo'] = $_SESSION['info']['personal']['abo'];
			}

		}
		else {
			foreach($_POST['abo'] as $k=>$v)
				$arrOut['personal']['abo'][$k] = 1; //$k;
			//$arrOut['personal']['abo'] = $_POST['abo'];
		}


		# Ausgabe des Templates mit alle Fehlermeldungen
		if ( $USERDATA_REDISPLAY==1 ) {
			$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=userdata';
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time()+600 );
			include $userdata_tmpl;
			my_exit();
		}

		$arrOut['update'] = $update;
		$newsletters = read_newsletters();
		# Prüfen, welche Änderungen der Benutzer gemacht hat
		# -> wichtig für die Informationsemail
                #    $arrOut['newsletters']['changes'] = calc_changes( $_POST['personal'], $arrOut['abo'],
                #                                                      $user, $update, $newsletters );
		$arrOut['MAIL_DEST'] = $WebServerAddress.$_SERVER['PHP_SELF'].'?action=confirm';
		$arrOut['WebServerAddress'] = $WebServerAddress;




		$arrOut['personal']['password'] = $_POST['password'];

		if ( $CONFIRM_EMAIL == 1 and $update == 0 ) {
			# Bestätigungsemail mit Link senden und nicht in Datei schreiben 
			$ret_val = send_email( $arrOut, 'confirmation', $template_dir, $newsletters );
			# abo-stringmit newsletter als text
			$arrOut['send_email'] = 1;
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time() );
			# setcookie( 'ServiceCenter', base64_encode( $user['email'] ), time() );
			include $thanks_userdata_tmpl;
		} 
		else {
			//Fuga
			if ($CONFIRM_EMAIL == 2 and $update == 0) {
				//send email with an unsubscribe link
				$ret_val = send_email2( $arrOut, 'information', $newsletters );
			}

			# Daten direkt in die Datei schreiben und als Bestätigung
			#  Email (ohne Link) schicken. (Email wird doch nicht benötigt)
			//if ( ! isset( $_POST['abo'] )) { $_POST['abo'] = ''; }

			/*
			echo '<pre>';
			print_r($_POST);
			print_r($arrOut);
			echo '</pre>';
			*/

			$ret_val = write_user(	$arrOut['personal'], 
									$_POST['password'], 
									//$arrOut['newsletters'],
									array_keys($arrOut['personal']['abo']),
									$arrOut['userfield']['value'], 
									$update, 
									$arrOut['userfield2_type1'], 
									//array_keys($_POST['userfields3']),
									$arrOut['userfield2_type2'],
									$arrOut['userfield2_type3'],
									$arrOut['userfield2_type4'],
									$CONFIRM_EMAIL);

			# send_email( $arrOut, 'changes', $template_dir, $newsletters );
			# Alle Änderungen in einer Mail
			$arrOut['send_email'] = 0;
			#      setcookie( 'ServiceCenter', base64_encode( $user['email'] ), time() );
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time() );

			// ----------------- user log in seccessfully, write it fact in session variable...
			$arrOut['AGB'] = 1;
			session_register('user_logged');
			session_register('info');
			$_SESSION['info'] = $arrOut;

			include $thanks_userdata_confirm_tmpl;
			my_exit();
		}
		# Fehler beim Schreiben des Users.csv-Files
		if ( $ret_val == 0 ) {
			print( "ERROR Writing file" );
			my_exit();
		}
	break;
	// --------------- break userdata block


	# Passwort-vergessen Link wurde angeklickt
	case 'nopassword':
		$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=sendpass';
		include $password_forgotten_tmpl;
		my_exit();
	break;


	# Passwort an den Benutzer senden, falls er in der "Datenbank" steht  
	case 'sendpass':
		$user = read_user( $_POST['email'] );
		if ( $user != 0 ) {
			send_password ( $user );
			include $thanks_sendpass_tmpl;
			my_exit();
		} 
		else {
			include $thanks_sendpass_tmpl;
			my_exit();
		}
	break;


	# Es möchte sich jemand neu registrieren, Formular mit leeren Feldern anzeigen.
	case 'new':
		$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=userdata';
		$arrOut['newsletters'] = read_newsletters();

		$arrOut['personal']['title'] = '';
		$arrOut['personal']['email'] = '';
		$arrOut['personal']['firstname'] = '';
		$arrOut['personal']['lastname'] = '';
		$arrOut['personal']['street'] = '';
		$arrOut['personal']['zip'] = '';
		$arrOut['personal']['town'] = '';
		$arrOut['personal']['email_form'] = $DEFAULT_EMAIL_FORM; //'html';
		#        $arrOut['SendToFriendLnk'] = action=sendtofriend&';
		$arrOut['new'] = 1;
		include $userdata_tmpl;
		my_exit();
	break;

	# Ein Freund wurde eingeladen und der hat den Link in der Email angeklickt.
	case 'from_friend':
		$string = $_GET['q'];
		$arrOut = decode_string( $string );
		$arrOut['USERFIELDSMUST'] = $USERFIELDSMUST;
		$arrOut['TITLEMUST'] = $TITLEMUST;
		$arrOut['BIRTHDATEMUST'] = $BIRTHDATEMUST;
		$arrOut['ADDRESSMUST'] = $ADDRESSMUST;

		$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=userdata';
		$arrOut['newsletters'] = read_newsletters();
		$arrOut['new'] = 1;
		foreach ( $USERFIELDS as $field ) {
			$arrOut['userfield']['name'][] = $field;
			$arrOut['userfield']['value'][] = '';
		}
		$arrOut['personal']['email_form'] = $DEFAULT_EMAIL_FORM; //'html';
		$arrOut['personal']['title'] = '';
		$arrOut['personal']['street'] = '';
		$arrOut['personal']['zip'] = '';
		$arrOut['personal']['town'] = '';
		$arrOut['FRIEND'] = 1;
		$tmp = 'Vorname ist: '.$arrOut['personal']['firstname'];
 	  $tmp = "<p/>".$TXTUser_Send_To_Friend_Intro_1;
    $tmp .= $arrOut['personal']['firstname']." ".$arrOut['personal']['lastname'].",<br><br>".$TXTUser_Send_To_Friend_Intro_2.' '.$SENDMAIL_SENDER_NAME."<p>";
		$tmp .= $TXTUser_Send_To_Friend_Intro_3;
		$TXTUser_Text = $tmp."<p>".$TXTUser_Text;
		include $userdata_tmpl;
		my_exit();
	break;


	# Der Link in der Bestätigungemail wurde angeklickt
	case 'confirm':
		$string = $_GET['q'];
		#Christian Start
		if (strpos($string, 'User') === false) {
			$arrOut = decode_string( $string );
		}
		else 
		{
			if ( file_exists( "files/".$string )) {
				$fp = fopen( "files/".$string, "r" );
				$arrOut = decode_string(fread($fp, filesize("files/".$string)));
				fclose( $fp );
				unlink("files/".$string);
			} 
			else {
	  			print $LoginInfoTooOld;
				exit;
			} 			
		}
		#Christian Ende

		$ret_val = write_user( $arrOut['personal'],
                            $arrOut['personal']['password'],
							//$arrOut['abo'], 
							//$arrOut['newsletters'],
							array_keys($arrOut['personal']['abo']),
							$arrOut['userfield']['value'],
							$arrOut['update'], 
							$arrOut['userfield2_type1'], 
							//array_keys($arrOut['userfield2_type2']),
							$arrOut['userfield2_type2'],
							$arrOut['userfield2_type3'],
							$arrOut['userfield2_type4'],
							$CONFIRM_EMAIL);
		$newsletters = read_newsletters();
		# Änderungen als Email (ohne Link) schicken
		$arrOut['send_email'] = 0;
		#   send_email( $arrOut, 'changes', $template_dir, $newsletters ); # Alle Änderungen in einer Mail
		#    print "<pre> arrOut ";print_r( $arrOut );print "</pre>";
    
		// ----------------- user log in seccessfully, write it fact in session variable...
		$arrOut['AGB']=1;
		session_register('user_logged');
		session_register('info');
		$_SESSION['info'] = $arrOut;

		include $thanks_userdata_confirm_tmpl;
		my_exit();
	break;   


	# Meldet den Benutzer komplett vom System ab. er erhält ab jetzt keine
	# Newsletter mehr.

	// Simple logoff
	case 'logout':
		session_unset();

		include $login_tmpl;
		my_exit();
	break;


	// delete account
	case 'elogoff':
		$email = base64_decode($_GET['n']);
		$password = base64_decode($_GET['p']);

		if(($email == '') or ($password == '' and $MINI_MODE_FLAG == 0)) {
			include $login_tmpl;
			my_exit();
		}

		$_SESSION['info']['personal'] = read_user($email);
		if($password != $_SESSION['info']['personal']['password']) {
			include $login_tmpl;
			my_exit();
		}

	case 'logoff':
		session_register('process_delete');
		include $confirm_delete_tmpl;
		my_exit();
	break;

	case 'deleteaccount':
		//echo 'inda deleteaccount action!';
		if(session_is_registered('process_delete')) {
			write_user( $_SESSION['info']['personal'], 
						$_SESSION['info']['personal']['password'], 
						$_SESSION['info']['personal']['abo'], 
						'', 
						9 );
			setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time() );
			session_unset();
			include $removed_from_all_tmpl;
			my_exit();
		}
	break;


	case 'sendtofriend':
		# n = <email>
		# p = <passwort>
		# email und passwort sind base64 codiert.
		if ( isset( $_GET['n'] )) {
			$email = base64_decode( $_GET['n'] );
		} 
		else {
			include $login_tmpl;
			my_exit();
		}
		if ( isset( $_GET['p'] ) ) {
			$password = base64_decode( $_GET['p'] );
		} 
		else {
			include $login_tmpl;
			my_exit();
		}
		if ( $password == '' or $email == '' ) {
			include $login_tmpl;
			my_exit();
		}

		$arrOut['personal'] = read_user( $email );
		if ( $password == $arrOut['personal']['password'] ) {
			$arrOut['newsletters'] = read_newsletters();
			$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=sendittofriend';
			$friend['email'] = '';
			$friend['firstname'] = '';
			$friend['lastname'] = '';
			$friend['text'] = '';
			$arrOut['txt_field_prefill'] = $TXT_User_Friend_prefill;
			include $sendtofriend_tmpl;
			my_exit();
		}
		include $login_tmpl;
		my_exit();
	break;
	// end sendtofriend block


    case 'sendittofriend':
		$friend = $_POST['friend'];
		$invitor = read_user( $_POST['invitor'] );
		if ( is_array( $friend['abo'] )) {
			$newsletters = read_newsletters();
			if ( $friend['email'] != '') {
				if ( $invitor != 0 ) {
					$ret_val = mail_link_to_friend( $friend, $invitor, $newsletters );
					setcookie( 'ServiceCenter', base64_encode( 'ServiceCenter' ), time() );
					include $thanks_sendtofriend_tmpl;
					my_exit();
				}
			}
		}
		$arrOut['personal'] = $invitor;
		$arrOut['newsletters'] = read_newsletters();

		$arrOut['DEST'] = $_SERVER["PHP_SELF"].'?action=sendittofriend';
		include $sendtofriend_tmpl;
		my_exit();
    break;


	# Sollte was anderes angegeben worden sein -> Login-Seite 
	default:
		include $login_tmpl;
		my_exit();
	break;
}

my_exit();
