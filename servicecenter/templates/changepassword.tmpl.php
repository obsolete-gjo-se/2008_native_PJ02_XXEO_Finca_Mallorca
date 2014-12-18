<?
session_start();
if(!session_is_registered('user_logged')) header('Location: index.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=$TXTChange_password_page_title;?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
</head>

<body>

<div class='page_layout'>

<? include('top_menu.tmpl.php'); ?>

	<?=$HeadlineTagOn?><?=$TXTChange_password_page_title;?><?=$HeadlineTagOff?>
	<p><?=$TXTChange_password_Text;?></p>

	<?
	//echo 'error='.$error;
	if(isset($error))
		switch ($error) {
			case 1: echo $TXTChange_password_error1; break;
			case 2: echo $TXTChange_password_error2; break;
			case 3: echo $TXTChange_password_error3; break;
		}
	?>

	<form method=post action="index.php" name='myform1'>
	<input type="hidden" name="action" value="changepasswordconfirm">
	<table cellpadding=0 cellspacing=5 border=0>
		<tr>
		<td align=right><p><?=$TXTOld_password;?></p></td><td><input type="password" name="old"></td>
		</tr>
		<tr>
		<td align=right><p><?=$TXTNew_password;?></p></td><td><input type="password" name="new"></td>
		</tr>
		<tr>
		<td align=right><p><?=$TXTNew_password_confirm;?></p></td><td><input type="password" name="new1"></td>
		</tr>
		<tr>
		<td></td>
		<td>
			<input type="image" src='<?=$pic_Ok;?>' alt="<?=$Confirm_password_button_text;?>" onclick='javascript: myform1.submit(); return false;' >
		</td>
		</tr>
	</table>
	</form>

</div>

</body>
</html>