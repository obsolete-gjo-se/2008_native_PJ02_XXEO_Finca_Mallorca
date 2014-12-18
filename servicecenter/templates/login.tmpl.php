<?
session_start();

$no_password_link = $_SERVER["PHP_SELF"].'?action=nopassword';
$new_registration_link = $_SERVER["PHP_SELF"].'?action=new';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=$TXTLogin_page_title;?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
</head>

<body>

<div class='page_layout'>

<? include('top_menu.tmpl.php'); ?>

	<?=$HeadlineTagOn?><?=$TXTLOGIN_Title?><?=$HeadlineTagOff?>
	<p><?=$TXTLOGIN_Text?></p>

	<?
		if (isset($arrOut['PASSWORD_MISMATCH'])) echo '<p>'.$TXTLOGIN_WrongPassword.'</p>';
	?>

	<!--form action="<?//=$arrOut['DEST']?>" method="post"-->
	<form action="index.php?action=login" method="post" name='myform1'>
		<table border=0 style='width: 300px;'>
		<tr>
			<td><p><?=$TXTCOMMON_EMail?></p></td>
			<td width=100%><input type="text" name="email" size="30" maxlength="50" style='width: 100%;'/></td>
		</tr>
		<tr>
			<td><p><?=$TXTCOMMON_Password?></p></td>
			<td><input type="password" name="password" size="30" maxlength="50" style='width: 100%;'/></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
			<input type="image" src='<?=$pic_Ok;?>' alt="<?=$TXTLOGIN_SendButton;?>" onclick='javascript: myform1.submit(); return false;'>
			</td>
		</tr>
		</table>
	</form>

<?
	if (in_array("Password",$USERFORMFIELDSVISIBILITY)) {
?>
		<p><a href="<?=$no_password_link;?>"><?=$TXTLOGIN_ForgotPassword?></a></p>
<?
	}
?>

<p><a href="<?=$new_registration_link;?>"><?=$TXTLOGIN_NewUser?></a></p>  

</div>

</body>
</html>