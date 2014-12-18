<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=$TXTPassword_forgotten_title;?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
</head>

<body>

<div class='page_layout'>
<? include('top_menu.tmpl.php'); ?>

<?=$HeadlineTagOn?><?=$TXTForg_Title?><?=$HeadlineTagOff?>

<form action="<?=$arrOut['DEST']?>" method="POST" name='myform1'>
	<p><?=$TXTForg_Text?></p>
	<p><?=$TXTCOMMON_EMail?>&nbsp;<input type="text" name="email" />
	<p><input type="image" src='<?=$pic_Ok;?>' alt="<?=$TXTCOMMON_Submit;?>" onclick='javascript: myform1.submit(); return false;'>
</form>
</div>

</body>
</html>