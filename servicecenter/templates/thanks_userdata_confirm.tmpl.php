<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=$TXTThanks_userdata_confirm?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
</head>
<body>

<div class='page_layout'>

<?
$newsletters = $_SESSION['info']['newsletters'];

// For what??????????????????
session_unset();

include('top_menu.tmpl.php'); 

?>

<?=$HeadlineTagOn?><?=$TXTConfirm_UserdataNoMailTitle?><?=$HeadlineTagOff?>
<p><?=$TXTConfirm_UserdataNoMail?></p>

<?
	if(count($newsletters)>1) {
		echo '<p>'.$TXTConfirm_UserdataYouSubscribedTo.'</p>';
		echo '<ul>';
		if ( is_array( $arrOut['personal']['abo'] ) ) {
			foreach ( $arrOut['personal']['abo'] as $k=>$v ) {
				echo "<li><p class=\'p_1\'>".$newsletters[$k]['name'].'<p class=\'letter_description\'>'.$newsletters[$k]['description'].'</p>';
			}
		}
		echo '</ul>';
	}
?>

</div>

</body>
</html>