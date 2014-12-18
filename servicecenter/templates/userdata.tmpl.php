<?
session_start();
?>

<!--DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"-->
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><?=((!session_is_registered('user_logged'))?$TXTUser_Title_new_users:$TXTUser_Title_logged_users)?></title>
	<link rel="stylesheet" type="text/css" href="<?=$CSS_FILE?>">
</head>
<body>


<div class='page_layout'>

<? include('top_menu.tmpl.php'); ?>

<?=$HeadlineTagOn?><?=((!session_is_registered('user_logged'))?$TXTUser_Title_new_users:$TXTUser_Title_logged_users)?><?=$HeadlineTagOff?>


<p><?=$TXTUser_Text?>
<FORM action="<?=$arrOut['DEST']?>" method="POST" name="myform1">
	<table border=0 width="380">
<!--	<tbody>
		<td colspan="2"></p></br></td>
	</tbody>-->
	
	<?
	if ( isset ( $arrOut['EMAIL_MISMATCH']) and $arrOut['EMAIL_MISMATCH'] == 1 ) { ?>
		<tr><td colspan="2"><p><?=$TXTForg_Email?></p></td></tr>
	<?
	} 
	if ( isset ( $arrOut['FRIEND']) and $arrOut['FRIEND'] == -1 ) { ?>
		<tr><td colspan="2"><p><?=$TXTorg_Friend?></p></td></tr>
	<? 
	} 
	?>


    <?php 
	//Fuga
	if (in_array("Title",$USERFORMFIELDSVISIBILITY)) {

		$TITLEMUST = ''; 
		if ( isset ( $arrOut['TITLEMUST'] ) and  $arrOut['TITLEMUST'] == 1 ) { $TITLEMUST=$TXT_Field_obli; } 
		if ( isset ( $arrOut['TITLE_MISMATCH']) and  $arrOut['TITLE_MISMATCH'] == 1 ) { 
	?>
		<tr><td colspan="2"><p><sub>Title mismatch</sub><?=$TXTForg_Anrede?></p></td></tr>
    <?php 
		} 
	?>

	<tr>
	<td width = "150px"><p><?=$TXTUser_TitlePers?><?=$TITLEMUST?></p></td>
	<td>
			<select name="personal[title]" size="1">
				<? foreach($TXTUser_TitlesArray as $value) {
             echo '<option';
             if ( isset( $arrOut['personal']['title'] ) and ($arrOut['personal']['title'] == $value) )
	 				     {echo ' selected="selected"';}
					   echo '>'.$value; 
					   echo '</option>';
				   }
				?>			
			</select>
	</td>
    </tr>
	<?
	//Fuga
	}
	?>

    <?php if ( isset ( $arrOut['NAME_MISMATCH']) and  $arrOut['NAME_MISMATCH'] == 1 ) { ?>
    <tr><td colspan="2"><p><?=$TXTForg_Name?></p></td></tr>
    <?php } ?>
    <tr>
      <td><p><?=$TXTUser_FirstName?></p></td>
      <td><input type="text" name="personal[firstname]" value="<?=$arrOut['personal']['firstname']?>" size="33" style="width:200" /></td>
    </tr>
    <tr>
      <td><p><?=$TXTUser_LastName?></p></td>
      <td><input type="text" name="personal[lastname]" value="<?=$arrOut['personal']['lastname']?>" size="33" style="width:200"/></td>
    </tr>

    <? 
		if ( isset ( $arrOut['EMAIL_MISMATCH_2']) and  $arrOut['EMAIL_MISMATCH_2'] == 1 ) { ?>
		    <tr><td colspan="2"><p><?=$TXTForg_Email2?></p></td></tr>
    <? } ?> 
		<tr>
			<td><p><?=$TXTUser_EMail?></p></td>
      <? 
		if ( ($arrOut['personal']['email'] != '') and (!isset($arrOut['friend'])) and (!isset( $arrOut['EMAIL_MISMATCH_2'])) ) { ?>
			<td><?=strtolower($arrOut['personal']['email'])?>
			<input type="hidden" name="personal[email]" value="<?=strtolower($arrOut['personal']['email'])?>" style="width:200"></td>
    <? 
		} 
		else { 
	?>
			<td><input type="text" name="personal[email]" value="<?=strtolower($arrOut['personal']['email'])?>" size="33" style="width:200" /></td>
    <? 
		} 
	?>
    </tr>


    <?php 

if(!session_is_registered('user_logged')) {

	if (in_array("Password",$USERFORMFIELDSVISIBILITY)) {
		
	if ( isset ( $arrOut['PASSWORD_MISMATCH']) and  $arrOut['PASSWORD_MISMATCH'] == 1 ) { ?>
    <tr><td colspan="2"><p><?=$TXTForg_Pass?></p></td></tr>
    <?php } ?>
    <tr>
      <td><p><?=$TXTUser_Password1?></p></td>
      <td><input type="password" name="password" value="" size="33" style="width:200" /></td>
    </tr>
    <tr>
      <td><p><?=$TXTUser_Password2?></p></td>
      <td><input type="password" name="password2" value="" size="33" style="width:200" /></td>
    </tr>

	<?
	}
	else {
		$random_password = mt_rand(1000000,9999999);
		echo '<input type=\'hidden\' name=\'password\' value=\''.$random_password.'\'  style="width:200" />';
		echo '<input type=\'hidden\' name=\'password2\' value=\''.$random_password.'\' style="width:200"/>';	
	}
}

	//street
	if (in_array("Street",$USERFORMFIELDSVISIBILITY)) {

		$STREETMUST = '';
		if ( isset ( $arrOut['STREETMUST'] ) and  $arrOut['STREETMUST'] == 1 ) $STREETMUST=$TXT_Field_obli;
		if ( isset ( $arrOut['STREET_MISMATCH']) and  $arrOut['STREET_MISMATCH'] == 1 ) echo '<tr><td colspan="2"><p>'.$TXTForg_Street.'</p></td></tr>';

	?>
		<tr><td><p><?=$TXTUser_Address;?>&nbsp;<?=$STREETMUST;?></p></td>
		<td><input type="text" name="personal[street]" value="<?=$arrOut['personal']['street'];?>" size="33"  style="width:200"/></td></tr>
	<?php
	}


	//zip
	if (in_array("Zip",$USERFORMFIELDSVISIBILITY) or in_array("City",$USERFORMFIELDSVISIBILITY)) {

		$errstr = '';
		$namestr = '';
		
		$ZIPMUST = '';
		if ( isset ( $arrOut['ZIPMUST'] ) and  $arrOut['ZIPMUST'] == 1 ) $ZIPMUST=$TXT_Field_obli;
		if ( isset ( $arrOut['ZIP_MISMATCH']) and  $arrOut['ZIP_MISMATCH'] == 1 ) $errstr .= $TXTForg_Zip; //echo '<tr><td colspan="2"><p>'.$TXTForg_Street.'</p></td></tr>';

		$CITYMUST = '';
		if ( isset ( $arrOut['CITYMUST'] ) and  $arrOut['CITYMUST'] == 1 ) $CITYMUST=$TXT_Field_obli;
		if ( isset ( $arrOut['CITY_MISMATCH']) and  $arrOut['CITY_MISMATCH'] == 1 ) {
			if($errstr<>'') $errstr .= '. ';
			$errstr .= $TXTForg_City; 
		}

		if($errstr<>'') echo '<tr><td colspan="2"><p>'.$errstr.'</p></td></tr>';

		if (in_array("Zip",$USERFORMFIELDSVISIBILITY)) $namestr .= $TXTUser_ZIP.'&nbsp;'.$ZIPMUST;
		if (in_array("City",$USERFORMFIELDSVISIBILITY)) {
			if ($namestr<>'') $namestr .= ', ';
			$namestr .= $TXTUser_City.'&nbsp;'.$CITYMUST;
		}

	?>
    <tr>
      <td><p><?=$namestr;?></p></td>
      <td>

	  <?php
		if (in_array("Zip",$USERFORMFIELDSVISIBILITY)) {
		?>
		<input type="text" name="personal[zip]" value="<?=$arrOut['personal']['zip']?>" size="6"  style="width:50" />&nbsp;
		<?php
		}

		if (in_array("City",$USERFORMFIELDSVISIBILITY)) {
		?>
		<input type="text" name="personal[town]" value="<?=$arrOut['personal']['town']?>" size="20"  style="width:142"/>
		<?php
		}
		?>

      </td>
    </tr>
	<?php
	}





	if (in_array("Country",$USERFORMFIELDSVISIBILITY)) {

		$COUNTRYMUST = '';
		if ( isset ( $arrOut['COUNTRYMUST'] ) and  $arrOut['COUNTRYMUST'] == 1 ) $COUNTRYMUST=$TXT_Field_obli;
		if ( isset ( $arrOut['COUNTRY_MISMATCH']) and  $arrOut['COUNTRY_MISMATCH'] == 1 ) echo '<tr><td colspan="2"><p>'.$TXTForg_Country.'</p></td></tr>';

	?>
    <tr>
        <td><p><?=$TXTUser_Country?>&nbsp;<?=$COUNTRYMUST?></p></td>
        <td>
            <select name="personal[country]"  style="width:200">
            
                 <?php #sort( $COUNTRIES );#CC: Nicht sortieren, Kunden wünschen D,A,CH zu Beginn
                      foreach( $COUNTRIES  as $country ) { ?>
                        <option value="<?=$country?>"
                 <?php if ( ! isset ( $arrOut['personal']['country'] ) and $country == $PRESELECTED_COUNTRY )
                       {  print ' selected="selected"'; } ?>                        
                 <?php
                       if ( isset( $arrOut['personal']['country'] ) and $arrOut['personal']['country'] == $country )
                         { print ' selected="selected"';?><?php } ?>
                 ><?=$country?></option>
                 <?php } ?>
            </select>
        </td>
    </tr>

    <?php 
	//Fuga
	}

if (in_array("Birthday",$USERFORMFIELDSVISIBILITY)) {

	if ( isset ( $arrOut['BIRTHDATEMUST'] ) and  $arrOut['BIRTHDATEMUST'] == 1 ) { $BIRTHDATEMUST=$TXT_Field_obli; } else {$BIRTHDATEMUST="";} ?>
    <?php if ( isset ( $arrOut['BIRTHDATE_MISMATCH']) and  $arrOut['BIRTHDATE_MISMATCH'] == 1 ) { ?>
       <tr><td colspan="2"><p><?=$TXTForg_Birthdate?></p></td></tr>
    <?php } ?>
    <tr>
        <td><p><?=$TXTUser_Birthdate?>&nbsp;<?=$BIRTHDATEMUST?></p></td>
        <td>
        <?php # Tag ?>
         <select name="personal[birth_day]">
         <option value="0">---</option>
         <?php for ( $i=1; $i<=31;$i++ ) {
                 print "<option value=\"$i\"";
                 if ( isset( $arrOut['personal']['birth_day']) and $arrOut['personal']['birth_day'] == $i ) {
                   print ' selected="selected"';
                 }
                 print ">$i</option>";
               }
         ?></select>
         <b>.</b>
        <?php # Monat  ?>
         <select name="personal[birth_month]">
         <option value="0">---</option>
         <?php for ( $i=1; $i<=12;$i++ ) {
                 print "<option value=\"$i\"";
                 if ( isset( $arrOut['personal']['birth_month']) and $arrOut['personal']['birth_month'] == $i ) {
                   print ' selected="selected"';
                 }
                 print ">$i</option>";
               }
         ?></select>
         <b>.</b>
        <?php # Jahr ?>
         <select name="personal[birth_year]">
         <option value="0">----</option>
         <?php for ( $i=1900; $i<=2000;$i++ ) {
                 print "<option value=\"$i\"";
                 if ( isset( $arrOut['personal']['birth_year']) and $arrOut['personal']['birth_year'] == $i ) {
                   print ' selected="selected"';
                 }
                 print ">$i</option>";
               }	
         ?></select>
				 
        </td>
    </tr>

<?
//Fuga
}
?>

<!-- Hier die benutzerdefinierten Felder -->
    <?php

         # Array USERFIELDS durchlaufen und alle Felder, die einen Namen haben besitzen ausgeben
         $i = 0;
         foreach ( $arrOut['userfield']['name'] as $field ) {
           if ( $field != '' ) {
    ?>
             <?php $USERFIELDSMUST = ''; if ( isset ( $arrOut['USERFIELDSMUST'][$i] ) and  $arrOut['USERFIELDSMUST'][$i] == 1 ) { $USERFIELDSMUST=$TXT_Field_obli; } ?>
             <?php if ( isset ( $arrOut['USERFIELD_MISMATCH'][$i]) and  $arrOut['USERFIELD_MISMATCH'][$i] == 1 ) { ?>
               <tr><td colspan="2"><p><?=$TXTForg_Userfield?></p></td></tr>
               <?php } ?>
             <tr>
               <td valign='top'><?=$field?>&nbsp;<?=$USERFIELDSMUST?></td>
               <td><input type='text' size='33' name="userfields[<?=$i?>]"
                           value="<?= $arrOut['userfield']['value'][$i] ?>" ></td>
             </tr>
    <?php
         }
         $i++;
    }
?>

    <tr>
      <td valign=''></td>
      <td></td>
    </tr>


<?php
	//Fuga	

//remove comment symbols for disable userfields in minimode
//if ($MINI_MODE_FLAG==0) {

	//print all unlimited userfields in sortorder
	foreach($arrOut['USERFIELDS2_SORTORDER'] as $val)
	{
		$field = $arrOut['userfield2_type'.$val[0]][$val[1]];
		if(empty($field)) continue;

		if($field['visibility']==1) 
		{
			if($field['missing']==1) echo '<tr><td colspan=2><p>'.$field['error_message'].'</p></td></tr>';
			echo '<tr><td><p>'.$field['description'];
			if($field['obligatory']==1) echo '&nbsp;'.$TXT_Field_obli;
			echo '</p></td><td>';

			switch ($val[0]) {
				case 1:
					echo '<input type=text size=33 name=\'userfields2['.$field['name'].']\' value=\''.$field['value'].' \'>';
					break;
				case 2:
					echo '<input type=checkbox name=\'userfields3['.$field['name'].'] \''; 
					if($field['value']==1) echo ' checked';
					echo '>';
					break;
				case 3:
					echo '<select name=\'userfields4['.$field['name'].']\'>';
					foreach($field['set'] as $field2) { 
						echo '<option value=\''.$field2.'\'';
						if ($field2==$field['value']) echo ' selected';
						echo '>'.$field2.'</option>';
					}
					echo '</select>';
					break;
				case 4:
					foreach($field['set'] as $field2) {
						echo '<input type=\'radio\' name=\'userfields5['.$field['name'].']\' value=\''.$field2.' \''; 
						if ($field2==$field['value']) echo ' checked';
						echo '>&nbsp;'.$field2.'<br>';
					}
					break;
			}

			echo '</td></tr>';
		} // if visible 
	} // foreach
//} // if minimode




if(!session_is_registered('user_logged')) {

	// Åñëè òîëüêî îäèí âàðèàíò, òî âûâîäèì ïðîñòî òåêñò,
	$newsletters = $arrOut['newsletters'];
	$abo = $arrOut['personal']['abo'];

	echo '<tr><td colspan=2><br>';
	if(count($newsletters)>1) {
		echo '<p>'.$TXTSubscriptions_Text_future.'&nbsp;'.$TXT_Field_obli.'</p>';
		echo '</td></tr><tr><td></td><td>';
		if($arrOut['LETTER_MISMATCH']==1) echo '<p>'.$TXTForg_Newsletter.'</p>';

		foreach($newsletters as $letter ) {
      echo '<p class=\'p_1\'><input type=\'checkbox\' name=\'abo['.$letter['no'].']\' value=\'1\''.( (($abo[$letter['no']] == 1) or ($arrOut['new']==1))?' checked':''); 
			echo ' />'.$letter['name'].'</p>';
			if($letter['description'] != '') echo '<div class=\'letter_description\'>'.$letter['description'].'</div>';
		}
	}
	elseif (count($newsletters)==1) {
		$keyname = array_keys($newsletters);
		//echo '<p>'.$TXTSubscriptions_only_one_variant_text_future.'</p>';
		//echo '<p>"'.$newsletters[$keyname[0]]['name'].'"</p>';
		//echo '<div class=\'letter_description\'>'.$newsletters[$keyname[0]]['description'].'</div>';
		echo '<input type=\'hidden\' name=\'abo['.$newsletters[$keyname[0]]['no'].']\' value=\'1\' >';
	}
	else {
		echo '<p>'.$TXTSubscriptions_nothing.'</p>';
	}
	echo '</td></tr>';



	echo '<tr><td colspan="2">';

	$delivery_method_count = count(array_intersect( array("email_form_html","email_form_text","email_form_post","email_form_fax","email_form_sms"), $USERFORMFIELDSVISIBILITY));
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
			if(($_SESSION['info']['personal']['email_form'] == 'post') and (count($checkarr)==0)) $checkarr['post'] = 	true;
		}
		if (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) { 
			if(($_SESSION['info']['personal']['email_form'] == 'fax') and (count($checkarr)==0)) $checkarr['fax'] = true;
		}
		if (in_array("email_form_sms",$USERFORMFIELDSVISIBILITY)) { 
			if(isset($_SESSION['info']['personal']['also_sms']) and ($_SESSION['info']['personal']['also_sms']=='on')) 	$checkarr['sms'] = true;
		}
	
		if(count($checkarr)==0) {
			if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) {$checkarr['html'] = true;}
			elseif (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) {$checkarr['text'] = true;}
			elseif (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) {$checkarr['post'] = true;}
			elseif (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) {$checkarr['fax'] = true;}
			elseif (in_array("email_form_sms",$USERFORMFIELDSVISIBILITY)) {$checkarr['sms'] = true;}
		}
		echo '</td></tr>';
		if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) {
		  echo '<tr><td></td><td>';
			echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'html\''.(($checkarr['html'])?' checked':'').' >'.$TXTUser_EMailHTML.'</p>';
  		echo '</td></tr>';
		}
		if (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) {
		  echo '<tr><td></td><td>';
			echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'text\''.(($checkarr['text'])?' checked':'').' >'.$TXTUser_EMailText.'</p>';
  		echo '</td></tr>';
		}
		if (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) {
		  echo '<tr><td></td><td>';
			echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'post\''.(($checkarr['post'])?' checked':'').' >'.$TXTUser_EMailPost.'</p>';
  		echo '</td></tr>';
		}
		if (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) {
		  echo '<tr><td></td><td>';
			echo '<p class=\'p_1\'><input type=\'radio\' name=\'personal[email_form]\' value=\'fax\''.(($checkarr['fax'])?' checked':'').' >'.$TXTUser_EMailFax.'</p>';
			if ( isset ( $arrOut['FAX_NUMBER_MISMATCH']) and  $arrOut['FAX_NUMBER_MISMATCH'] == 1 ) 
				echo $TXTForg_Fax;
		  echo '<p class=\'p_1\'><input type=\'text\' name=\'personal[fax_number]\' value=\''.$_SESSION['info']['personal']['fax_number'].'\' ></p>';
		  echo '</td></tr>';
		}
		if (in_array("email_form_sms",$USERFORMFIELDSVISIBILITY)) {
		  echo '<tr><td></td><td>';
			echo '<p class=\'p_1\'><input type=\'checkbox\' name=\'personal[also_sms]\''.(($checkarr['sms'])?' checked':'').' >'.$TXTUser_EMailSms.'</p>';
			if ( isset ( $arrOut['SMS_NUMBER_MISMATCH']) and  $arrOut['SMS_NUMBER_MISMATCH'] == 1 ) 
				echo $TXTForg_Sms.'<br>';
			echo '<p class=\'p_1\'><input type=\'text\' name=\'personal[sms_number]\' value=\''.$_SESSION['info']['personal']['sms_number'].'\' ></p>';
		  echo '</td></tr>';
		}
	}
	else {
		// if = 1 & it's FAX then show input field for fax number.
		if (($delivery_method_count=1) and (in_array("email_form_fax",$USERFORMFIELDSVISIBILITY)) ) {
			echo '<tr><td colspan=2><p>'.$TXTUser_EMailFormat.'</p></td></tr>';
			echo '<tr><td></td><td>';
			echo '<p class=\'p_1\'><input type=\'hidden\' name=\'personal[email_form]\' value=\'fax\' >'.$TXTUser_EMailFax.'</p>';
			if ( isset ( $arrOut['FAX_NUMBER_MISMATCH']) and  $arrOut['FAX_NUMBER_MISMATCH'] == 1 ) 
				echo $TXTForg_Fax;
			echo '<p class=\'p_1\'><input type=\'text\' name=\'personal[fax_number]\' value=\''.$_SESSION['info']['personal']['fax_number'].'\'></p>';
			echo '</td></tr>';
		}
		elseif ($delivery_method_count=1) {
			if (in_array("email_form_html",$USERFORMFIELDSVISIBILITY)) {$method = 'html';}
			elseif (in_array("email_form_text",$USERFORMFIELDSVISIBILITY)) {$method = 'text';}
			elseif (in_array("email_form_post",$USERFORMFIELDSVISIBILITY)) {$method = 'post';}
			echo '<input type=\'hidden\' name=\'personal[email_form]\' value=\''.$method.'\' >';
		}
	}

	//echo '<br /></td></tr>';

}


	//Fuga
	if (in_array("AGB", $USERFORMFIELDSVISIBILITY)) {
		
		if ( !isset( $arrOut['AGB'] ) or $arrOut['AGB'] == 0 ) { 
			if ( isset ( $arrOut['AGB_MISMATCH']) and $arrOut['AGB_MISMATCH'] == 1 ) { ?>
				<tr><td colspan="2"><p><?=$TXTForg_AGB?></p></td></tr>
    <? 
			} 
	?>
			 <tr><td colspan="2"><p><input type="checkbox" name="agb" value="1" >&nbsp;<?=$TXT_AGB?></p></td></tr>
    <?
		} 
		else { 
	?>
			<input type="hidden" name="agb" value="1">
	<?
		}  
	}
	?>
      
    <tr>
      <td colspan=2>
        <input type="image" src='<?=$pic_Ok;?>' onclick="javascript: document.myform1.submit(); return false;">
		&nbsp;
   		<input type="image" src='<?=$pic_Reset;?>' onclick="javascript: document.myform1.reset(); return false;">
      </td>
    </tr>
</table>



<?
	echo '<br />';
	if(array_key_exists('SendToFriendLnk', $arrOut) and $arrOut['SendToFriendLnk']) { 
	    echo '<p class=\'p_1\'><a href=\''.$arrOut['SendToFriendLnk'].'\'>'.$TXTCOMMON_SendToFriend.'</a></p>';
	}
	//if(!isset( $arrOut['new']) and array_key_exists('GlobalRemoveLnk', $arrOut)) { 
	//	echo '<p class=\'p_1\'><a href=\''.$arrOut['GlobalRemoveLnk'].'\'>'.$TXTUser_Unsubscribe.'</a></p>';
	//}
?>


<p><small><?=$TXTUser_Legend?></small></p>
  <?
	if ($arrOut['personal']['timestamp']!='' and $SHOWCREATEINFO==1) {
		echo '<p><small>'.$AccountCreatedChanged.' '.$arrOut['personal']['timestamp']; 
		$ddd = split(':', $arrOut['personal']['ip']);
		echo ' IP '.$ddd[0];
		if ($ddd[1]!='') echo ' Host '.$ddd[1];
		if ($ddd[2]!='') echo ' Proxy '.$ddd[2];	
		echo '</small></p>';
	}
?>


</form>

</div>

</body>
</html>