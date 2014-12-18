<?
session_start();
// Check for logged
if(!session_is_registered('user_logged')) header('Location: ../index.php');


$delivery_method_count = count(array_intersect( array("email_form_html","email_form_text","email_form_post","email_form_fax","email_form_sms"), $USERFORMFIELDSVISIBILITY));
$newsletters = $_SESSION['info']['newsletters'];

if (  (count($newsletters)<2) and ( (($delivery_method_count<2) and (!in_array("email_form_fax",$USERFORMFIELDSVISIBILITY))) ) 	) {
	header('Location: ../index.php?action=profile');
}



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=$TXTSubscriptions_page_title;?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
	<META HTTP-EQUIV="Expires" CONTENT="Mon, 25 Sep 2002 00:02:01 GMT"> 
</head>

<body>

<div class='page_layout'>

<? include('top_menu.tmpl.php'); ?>

	<?=$HeadlineTagOn?><?=$TXTSubscriptions_Title?><?=$HeadlineTagOff?>

<?

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

// Åñëè òîëüêî îäèí âàðèàíò, òî âûâîäèì ïðîñòî òåêñò, 

$abo = $_SESSION['info']['personal']['abo'];

echo '<form method=post action=\'index.php\' name=\'myform1\'>';

echo '<input type=\'hidden\' name=\'action\' value=\'changesubscriptions\'>';

if(count($newsletters)>1) {
	echo '<p>'.$TXTSubscriptions_Text.'</p>';
	if($arrOut['LETTER_MISMATCH']==1) echo '<p>'.$TXTForg_Newsletter.'</p>';

	foreach($newsletters as $letter ) {
        echo '<p class=\'p_1\'><input type=\'checkbox\' name=\'abo['.$letter['no'].']\' value=\''.$letter['no'].'\''
		.(($abo[$letter['no']] == 1)?' checked':''); 
		echo '/>'.$letter['name'].'</p>';
		if($letter['description'] != '') echo '<div class=\'letter_description\'>'.$letter['description'].'</div>';
	}
}
elseif (count($newsletters)==1) {
	$keyname = array_keys($newsletters);
	//echo '<p>'.$TXTSubscriptions_only_one_variant_text.'"'.$newsletters[$keyname[0]]['name'].'"</p>';
	echo '<input type=\'hidden\' name=\'abo['.$newsletters[$keyname[0]]['no'].']\' value=\'1\'>';
}
else {
	echo '<p>'.$TXTSubscriptions_nothing.'</p>';
}




// if > 1 then show all
if( $delivery_method_count>1 ) {

    echo '<p>'.$TXTUser_EMailFormat.'</p>';

	$checkarr = array();

	if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) { 
		if($_SESSION['info']['personal']['email_form'] == 'html') $checkarr['html'] = true;
	}
	if (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) { 
		if(($_SESSION['info']['personal']['email_form'] == 'text') and (count($checkarr)==0)) $checkarr['text'] = true;
	}
	if (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) { 
		if(($_SESSION['info']['personal']['email_form'] == 'post') and (count($checkarr)==0)) $checkarr['post'] = true;
	}
	if (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) { 
		if(($_SESSION['info']['personal']['email_form'] == 'fax') and (count($checkarr)==0)) $checkarr['fax'] = true;
	}
	if (in_array("email_form_sms",$USERFORMFIELDSVISIBILITY)) { 
		if(isset($_SESSION['info']['personal']['also_sms']) and ($_SESSION['info']['personal']['also_sms']=='on')) $checkarr['sms'] = true;
	}

	if(count($checkarr)==0) {
		if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) {$checkarr['html'] = true;}
		elseif (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) {$checkarr['text'] = true;}
		elseif (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) {$checkarr['post'] = true;}
		elseif (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) {$checkarr['fax'] = true;}
		elseif (in_array("email_form_sms",$USERFORMFIELDSVISIBILITY)) {$checkarr['sms'] = true;}
	}

	if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) {
		echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'html\''.(($checkarr['html'])?' checked':'').'>'.$TXTUser_EMailHTML.'</p>';
	}
	if (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) {
		echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'text\''.(($checkarr['text'])?' checked':'').'>'.$TXTUser_EMailText.'</p>';
	}
	if (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) {
		echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'post\''.(($checkarr['post'])?' checked':'').'>'.$TXTUser_EMailPost.'</p>';
	}
	if (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) {
		echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'fax\''.(($checkarr['fax'])?' checked':'').'>'.$TXTUser_EMailFax.'</p>';
		if ( isset ( $arrOut['FAX_NUMBER_MISMATCH']) and  $arrOut['FAX_NUMBER_MISMATCH'] == 1 ) 
			echo $TXTForg_Fax.'<br>';
		echo '<p class=\'p_1\'><input type=\'text\' name=\'personal[fax_number]\' value=\''.$_SESSION['info']['personal']['fax_number'].'\'></p>';
	}
	if (in_array("email_form_sms",$USERFORMFIELDSVISIBILITY)) {
		echo '<p class=\'p_1\'><input type=\'checkbox\' name=\'personal[also_sms]\''.(($checkarr['sms'])?' checked':'').'>'.$TXTUser_EMailSms.'</p>';
		if ( isset ( $arrOut['SMS_NUMBER_MISMATCH']) and  $arrOut['SMS_NUMBER_MISMATCH'] == 1 ) 
			echo $TXTForg_Sms.'<br>';
		echo '<p class=\'p_1\'><input type=\'text\' name=\'personal[sms_number]\' value=\''.$_SESSION['info']['personal']['sms_number'].'\'></p>';
	}
}
else {
	// if = 1 & it's FAX then show input field for fax number.
	if (($delivery_method_count=1) and (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) ) {
		echo '<p>'.$TXTUser_EMailFormat.'</p>';
		echo '<p class=\'p_1\'><input type=\'hidden\' name=\'personal[email_form]\' value=\'fax\'>'.$TXTUser_EMailFax.'</p>';
		if ( isset ( $arrOut['FAX_NUMBER_MISMATCH']) and  $arrOut['FAX_NUMBER_MISMATCH'] == 1 ) 
			echo $TXTForg_Fax;
		echo '<p class=\'p_1\'><input type=\'text\' name=\'personal[fax_number]\' value=\''.$_SESSION['info']['personal']['fax_number'].'\'></p>';
	}
	elseif ($delivery_method_count=1) {
		if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) {$method = 'html';}
		elseif (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) {$method = 'text';}
		elseif (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) {$method = 'post';}
		echo '<input type=\'hidden\' name=\'personal[email_form]\' value=\''.$method.'\'>';
	}
}


?>

<p>
	<input type="image" src='<?=$pic_Ok;?>'  onclick='javascript: myform1.submit(); return false;'>
</p>
</form>

</div>

</body>
</html>