<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
		<title><?=$TXTSend_to_friend_title?></title>
    <link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
  </head>

<body>

<div class='page_layout'>

<? include('top_menu.tmpl.php'); ?>

<?=$HeadlineTagOn?><?=$TXTFriend_TextTitle?><?=$HeadlineTagOff?>
 
<form action="<?=$arrOut['DEST']?>" method="POST" name='myform1'>
<input type="hidden" name="invitor" value="<?=strtolower($arrOut['personal']['email'])?>">
<table>
  <tbody>
    <!--tr>
      <td colspan="2"><h1><?//=$TXTFriend_TextTitle?></h1></td>
    </tr-->
    <tr>
      <td colspan="2">
      <p><?=$TXTCOMMON_Salutation?> <?=$arrOut['personal']['firstname'] ?> <?=$arrOut['personal']['lastname'] ?>,</p>
        <p><?=$TXTFriend_Text?></p>
    <br>
    </td>  
  </tr>
  <tr>
      <td><?=$TXTFriend_FirstName?></td>
      <td><input type="text" name="friend[firstname]" value="<?=$friend['firstname']?>"/></td>
    </tr>
    <tr>
      <td><?=$TXTFriend_LastName?></td>
      <td><input type="text" name="friend[lastname]" value="<?=$friend['lastname']?>" /></td>
    </tr>
    <tr>
      <td><?=$TXTFriend_EMail?></td>
      <td><input type="text" name="friend[email]" value="<?=$friend['email']?>"></td>
    </tr>

<?
	$newsletters = $arrOut['newsletters'];

	if (count($newsletters)>1) {
		echo '<tr><td>'.$TXTFriend_Newsletters.'</td><td>';
		foreach ($arrOut['newsletters'] as $letter) { 
			echo '<input type=\'checkbox\' name=\'friend[abo]['.$letter['no'].']\' value=\''.$letter['no'].'\'';
			if ( isset( $arrOut['personal']['abo'][$letter['no']]) and  $arrOut['personal']['abo'][$letter['no']] == 1) echo ' checked="checked"'; 
			echo '/>'.$letter['name'].'<br />';
      	} 
		echo '</td></tr>';
	}
	elseif (count($newsletters)==1) {
		$keyname = array_keys($newsletters);
		//echo '<p>'.$TXTSubscriptions_only_one_variant_text_future.'</p>';
		//echo '<p>"'.$newsletters[$keyname[0]]['name'].'"</p>';
		//echo '<div class=\'letter_description\'>'.$newsletters[$keyname[0]]['description'].'</div>';
		echo '<input type=\'hidden\' name=\'friend[abo]['.$newsletters[$keyname[0]]['no'].']\' value=\''.$newsletters[$keyname[0]]['no'].'\'>';
	}
	else {
		echo '<tr><td></td><td>'.$TXTSubscriptions_nothing.'</td></tr>';
	}

?>

    <tr>
      <td><?=$TXTFriend_Message?></td>
      <td><textarea name="friend[text]" cols="50" rows="10"><?=$friend['text'] ?><?=$arrOut['txt_field_prefill']?></textarea></td>
    </tr>
    <tr>
      <td></td>
      <td>   
        <input type="image" src='<?=$pic_Ok;?>' alt="<?=$TXTCOMMON_Submit?>" onclick='javascript: myform1.submit(); return false;'>&nbsp;
		<input type="image" src='<?=$pic_Reset;?>' alt="<?=$TXTCOMMON_Reset?>" onclick='javascript: myform1.reset(); return false;' >
      </td>
    </tr>
  </tbody>
</table>
        
</form>

</div>

</body>
</html>