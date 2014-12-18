<?

if ( file_exists ( 'includes/mail2date.cfg.php'  )) {
	$SUFFIX='php';
} 
elseif ( file_exists ( 'includes/mail2date.cfg.php3' ) ) {
	$SUFFIX='php3';
} 
elseif ( file_exists ( 'includes/mail2date.cfg.php4' ) ) {
	$SUFFIX='php4';
} 
elseif ( file_exists ( 'includes/mail2date.cfg.php5' ) ) {
	$SUFFIX='php5';
	} 
else {
	exit( 0 );
}

unset($MINI_MODE_FLAG);

$template_dir = 'templates/';
include_once ('includes/functions.'.$SUFFIX);
include_once('includes/mail2date.cfg.'.$SUFFIX);

if ((isset($email)) and (isset($form)) and ($MINI_MODE_FLAG==1) and (in_array(strtolower($form), array('html','text','post','fax','sms'))) )
{
	$email = strtolower($email);
	$form = strtolower($form);

	$user = read_user($email);

	if ( $user != 0 ) {

		$arrOut['personal'] = $user;
		$arrOut['newsletters'] = read_newsletters();
		$arrOut['checked_news'] = $user['abo'];
		$arrOut['userfield']['value'] = $user['userfield']['value'];

		//load editbox values
		foreach($user['userfield2_type1'] as $key=>$value) 
			$arrOut['userfield2_type1'][$key]['value'] = $value;
		//load checkbox values
		foreach($user['userfield2_type2'] as $key=>$value) 
			$arrOut['userfield2_type2'][$key]['value'] = $value;
		//load combobox values
		foreach($user['userfield2_type3'] as $key=>$value) 
			$arrOut['userfield2_type3'][$key]['value'] = $value;
		//load radiobuttons values
		foreach($user['userfield2_type4'] as $key=>$value) 
			$arrOut['userfield2_type4'][$key]['value'] = $value;
/*
		print('<pre>');
		print_r($arrOut);
		print('</pre>');
*/

		$form1 = $arrOut['personal']['email_form'];

		// if email form different then rewrite user record
		if($arrOut['personal']['email_form'] != $form) {
			$arrOut['personal']['email_form'] = $form;
/*
			print('<pre>');
			print_r($arrOut);
			print('</pre>');
*/

			$form2 = $arrOut['personal']['email_form'];

			$ret_val = write_user( $arrOut['personal'], $arrOut['password'], $arrOut['abo'],
													$arrOut['userfield']['value'], 0, // $update, 
													$arrOut['userfield2_type1'], 
													$arrOut['userfield2_type2'],
													$arrOut['userfield2_type3'],
													$arrOut['userfield2_type4'],
													$CONFIRM_EMAIL
													);
			if ( $ret_val == 0 ) {
				print( "ERROR Writing file" );
				my_exit();
			}
			include $template_dir.'thanks_change_email_form.tmpl.'.$SUFFIX;
			exit();
		}


	} 
	else {
		exit();
	}

}

?>