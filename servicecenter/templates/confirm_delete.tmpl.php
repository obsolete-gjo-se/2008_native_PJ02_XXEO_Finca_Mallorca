<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=$TXTConfirm_delete_title;?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
</head>

<body>

<div class='page_layout'>

<? if ($action<>'elogoff')	include('top_menu.tmpl.php'); ?>

<?=$HeadlineTagOn?><?=$TXTConfirm_DeleteTitle;?><?=$HeadlineTagOff?>

<form method=post action="index.php" class='p_1' name="f1">
<p><?=$TXTConfirm_Delete;?></p>
<input type="hidden" name="action" value="login">
<p>
<input type="image" src='<?=$pic_Ok;?>' alt="<?=$Confirm_delete_yes_button_caption;?>" onclick='javascript: document.f1.action.value="deleteaccount"; f1.submit(); return false;'>
<input type="image" src='<?=$pic_Cancel;?>' alt="<?=$Confirm_delete_no_button_caption;?>" onclick='javascript: document.f1.action.value="profile"; f1.submit(); return false;'>
</form>

<? if ($action=='elogoff')	echo '<p><a href=\'../index.php?action=profile\'>'.$BackToStartpageText.'</a>'; ?>

</div>

</body>
</html>