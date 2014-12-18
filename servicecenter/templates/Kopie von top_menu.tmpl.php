<?php

if (!(isset($SUPPRESS_HEADER_PIC) and ($SUPPRESS_HEADER_PIC == 1))) {
	if ($HEADER_LINK == '')
		echo '<img src=\''.$HEADER_IMAGE.'\' border=\'0\'>';
	else
		echo '<a href=\''.$HEADER_LINK.'\'><img src=\''.$HEADER_IMAGE.'\' border=\'0\'></a>';
}
?>
<?

echo '<ul class=\'top_menu\'>';

if ($MINI_MODE_FLAG == 0) {
	if (!session_is_registered("user_logged")) {
		echo '<li><a href=\'index.php?action=login\'><img src=\''.$pic_login.'\' border=0 	alt=\''.$TXTTopMenu_Login.'\'></a></li>';
		
		if (in_array("Password",$USERFORMFIELDSVISIBILITY)) {
			echo '<li><a href=\'index.php?action=nopassword\'><img src=\''.$pic_remember_password.'\' border=0 alt=\''.$TXTTopMenu_RememberPassword.'\'></a></li>';
		}

		echo '<li><a href=\'index.php?action=new\'><img src=\''.$pic_registration.'\' border=0 alt=\''.$TXTTopMenu_Registration.'\'></a></li>';
	}
	else {
		echo '<li><a href=\'index.php?action=profile\'><img src=\''.$pic_profile.'\' border=0 alt=\''.$TXTTopMenu_ChangeProfile.'\'></a></li>';
		
		if (in_array("Password",$USERFORMFIELDSVISIBILITY)) {
			echo '<li><a href=\'index.php?action=changepassword\'><img src=\''.$pic_change_password.'\' border=0 alt=\''.$TXTTopMenu_ChangePassword.'\'></a></li>';
		}

		
		$delivery_method_count = count(array_intersect( array("email_form_html","email_form_text","email_form_post","email_form_fax","email_form_sms"), $USERFORMFIELDSVISIBILITY));
		$newsletters = $_SESSION['info']['newsletters'];
		if (!(  (count($newsletters)<2) and ( (($delivery_method_count<2) and (!in_array("email_form_fax",$USERFORMFIELDSVISIBILITY))) ) 	)) {
			echo '<li><a href=\'index.php?action=subscriptions\'><img src=\''.$pic_subscriptions.'\' border=0 alt=\''.$TXTTopMenu_Subscriptions.'\'></a></li>';
		}

		echo '<li><a href=\'index.php?action=logoff&n='.base64_encode(strtolower($_SESSION['info']['personal']['email'])).'&p='.base64_encode($_SESSION['info']['personal']['password']).'\'><img src=\''.$pic_del_account.'\' border=0 alt=\''.$TXTTopMenu_DeleteAccount.'\'></a></li>';
		echo '<li><a href=\'index.php?action=logout\'><img src=\''.$pic_logout.'\' border=0 alt=\''.$TXTTopMenu_Logout.'\'></a></li>';
	}
}
else {
	echo '<li><a href=\'index.php?action=new\'><img src=\''.$pic_registration.'\' border=0 alt=\''.$TXTTopMenu_Registration.'\'></a></li>';
}

if (in_array("AGB",$USERFORMFIELDSVISIBILITY)) {
	echo '<li><a href=\'index.php?action=imprint\'><img src=\''.$pic_imprint.'\' border=0 alt=\''.$TXTTopMenu_Imprint.'\'></a></li>';
}
if (in_array("Terms",$USERFORMFIELDSVISIBILITY)) {
	echo '<li><a href=\'index.php?action=terms\'><img src=\''.$pic_terms.'\' border=0 alt=\''.$TXTTopMenu_Terms.'\'></a></li>';
}

echo '</ul>';


?>
