<?php
####################################
$DEBUG = 0;
$PASSWORD = '%�$(/&HZUFHSHOPhjghjewreuigt43vgs';

$SUPPRESS_HEADER_PIC = 1;
$WebToDateAddress = '';
$CSS_FILE = 'styles.css';

$pic_name_array = array(
	"w2dpluginmailtodate3button0.gif",// = Login
  "w2dpluginmailtodate3button1.gif",// = PasswordForgotten
	"w2dpluginmailtodate3button2.gif",// = Imprint
  "w2dpluginmailtodate3button3.gif",// = Regsitration
  "w2dpluginmailtodate3button4.gif",// = DeleteAccount
  "w2dpluginmailtodate3button5.gif",// = Subscriptions
  "w2dpluginmailtodate3button6.gif",// = PasswordChange
  "w2dpluginmailtodate3button7.gif",// = TermsConditions
  "w2dpluginmailtodate3button8.gif",// = Logout
  "w2dpluginmailtodate3button9.gif",// = OK (used to send data to Service Center)
  "w2dpluginmailtodate3button10.gif",// = Cancel (used for delete Account)
  "w2dpluginmailtodate3button11.gif", // = Reset (used for resetting data in users form)
  "w2dpluginmailtodate3button12.gif" // = Reset (used for resetting data in users form)
);

//check that all button image exists on remote server
$check_result = TRUE;
foreach($pic_name_array as $pic_name)
	if(!@fopen($WebToDateAddress.'/images/'.$pic_name,'r')) {
	$check_result = FALSE;
		break;
	}

	
$MenuVertical	= FALSE;
	
if($check_result)
	$pic_dir = $WebToDateAddress.'images/';
else
	$pic_dir = 'pictures/';


	
	
$pic_login				= $pic_dir.$pic_name_array[0];
$pic_remember_password	= $pic_dir.$pic_name_array[1];
$pic_imprint			= $pic_dir.$pic_name_array[2];
$pic_registration		= $pic_dir.$pic_name_array[3];
$pic_del_account		= $pic_dir.$pic_name_array[4];
$pic_subscriptions		= $pic_dir.$pic_name_array[5];
$pic_change_password	= $pic_dir.$pic_name_array[6];
$pic_terms				= $pic_dir.$pic_name_array[7];
$pic_logout				= $pic_dir.$pic_name_array[8];
$pic_Ok					= $pic_dir.$pic_name_array[9];
$pic_Cancel				= $pic_dir.$pic_name_array[10];
$pic_Reset				= $pic_dir.$pic_name_array[11];
$pic_profile			= $pic_dir.$pic_name_array[12];

$HEADER_IMAGE                           = 'http://www.mallorca-finca-reisen.de/servicecenter/header.jpg';
$HEADER_LINK                            = 'http://';
$HeadlineTagOn = '<h1>';
$HeadlineTagOff = '</h1>';

$SMSOKReturnCode = 'OK';
$DEFAULT_EMAIL_FORM = '';
########################
# Best�tigungsemail


###########################################
# CONFIRM_EMAIL = 0 - Single Opt-In
# CONFIRM_EMAIL = 1 - Double Opt-In
# CONFIRM_EMAIL = 2 - Confirmed Opt-In
$CONFIRM_EMAIL													   = 1;	
$SEND_CONFIRM_EMAILS_AS_HTML            = 0;



# Sender der Email
$SENDMAIL_SENDER                        = 'newsletter@estrenc-ferien.de';
$SENDMAIL_SENDER_NAME                   = 'Life & Art GmbH';

$EMAIL_FOOTER                           = '[EMAIL_FOOTER]';

# Betreffzeile der Best�tigungsemail
$SENDMAIL_CONFIRMATION_SUBJECT          = '[SENDMAIL_CONFIRMATION_SUBJECT]';

# Newsletter Text
$SENDMAIL_NEWSLETTER_TEXT               = 'Sie abonnieren folgende Newsletter:';

# Confirmation before LinkText
$SENDMAIL_CONFIRMATION_BEFORE_LINK      = '[SENDMAIL_CONFIRMATION_BEFORE_LINK]';
# Confirmation LinkText
$SENDMAIL_CONFIRMATION_LINKTEXT         = '[SENDMAIL_CONFIRMATION_LINKTEXT]';
# Confirmation after LinkText
$SENDMAIL_CONFIRMATION_AFTER_LINK       = '[SENDMAIL_CONFIRMATION_AFTER_LINK]';


####################
# �nderungen
$CHANGES_NEW							= '[CHANGES_NEW]';
$CHANGES_OLD								= '[CHANGES_OLD]';


//Added by Fuga A.V.
//=========================================================================================================
$USERFORMFIELDSVISIBILITY = array(
"Title","Password","AGB",
);















//if =1 then create account information will be displayed in footer of user registration form (when changing existent account, not for new)
$SHOWCREATEINFO = 1;

//value for fifth parameter of mail function
$MAIL_PARAMETER5 = '';

// 1- mini-mode on, 0-mini-mode off
$MINI_MODE_FLAG = 0;


//if($MINI_MODE_FLAG==1) {
	//$USERFORMFIELDSVISIBILITY=array();
//}

//hide "back to login" link for mini-mode
$HIDE_BACKTOLOGIN_LINK = $MINI_MODE_FLAG;

//show unsubscribe link in mail send to user (DoubleOptIn, ConfirmedOptIn)
// now only in mini-mode
$SHOW_UNSUBSCRIBELINK_IN_EMAIL = 1;

//edit fields
// sortorder, fullname, obligatory, visibility, default value, error message
$USERFIELDS2_TYPE1=array();

//checkbox
//sortorder, fullname, obligatory, visibility, default value, error message
$USERFIELDS2_TYPE2=array();

//combobox
//sortorder, fullname, obligatory, visibility, default value, set of values, error message
$USERFIELDS2_TYPE3=array();

//radiobuttons
//sortorder, fullname, obligatory, visibility, default value, set of values, error message
$USERFIELDS2_TYPE4=array("Neues Feld 2"=>array(1,"Neues Feld 2",0, 0,"", array(),"<font color=red><b>Die Angaben in diesem Feld stimmen nicht</b></font>"),);

//
//=======================================================================================================




























###########################################
# 10 freie Felder, die im Userdata-Template angezeigt werden sollen
# -> auch mitspeichern
$USERFIELDS = array( );
$USERFIELDSMUST = array(); 
	
//Added by Fuga
//if($MINI_MODE_FLAG==1) {
//	$USERFIELDS=array();
//	$USERFIELDSMUST=array();
//}

#######################################
# Must-Flags
$TITLEMUST              = '1';
$BIRTHDATEMUST           = '0';
//$ADDRESSMUST			= '[AddressMust]';
$COUNTRYMUST			= '0';
$STREETMUST				= '0';
$ZIPMUST							= '0';
$CITYMUST						= '0';

#######################################
# Log Dateien
$REDIRECT_LOG_FILE      = 'redirect.log';
$COUNT_LOG_FILE         = 'count.log';
$INVITATION_LOG_FILE    ='invitation.log';

#######################################
# Send To Friend Mailtext
$SENDTOFRIEND_HEADER    = 'Newsletter-Einladung';
$SENDTOFRIEND_INTRO     = 'Sehr geehrte/r';
$SENDTOFRIEND_INTRO_P2  = 'Diese Nachricht kommt von ';
$SENDTOFRIEND_INTRO_P3  = 'Die folgenden Newsletter wurden Ihnen empfohlen:';
$SENDTOFRIEND_INTRO_P4  = 'Klicken Sie auf den untenstehenden Link, um sich ebenfalls f�r diesen interessanten Newsletter anzumelden:';
$SENDTOFRIEND_LINK      = 'Wollen Sie mehr erfahren, klicken Sie hier, um sich ebenfalls f�r den oder die Newsletter anzumelden.';
$SENDTOFRIEND_END       = 'Dieser Service ist kostenfrei und kann auch nach Anmeldung jederzeit wieder von Ihnen gek�ndigt werden.';
$SENDTOFRIEND_END_2     = 'Verantwortlich f�r diesen Newsletter-Service ist';
                        
#######################################
# Send Password Mailtext
$SENDPASS_HEADER        = 'Ihr Passwort vom ServiceCenter';
$SENDPASS_ANREDE        = 'Sehr geehrte/r';      
$SENDPASS_INTRO         = 'wie gew�nscht senden wir Ihnen Ihr Passwort zu.';       
$SENDPASS_STARTPASS     = 'Ihr Passwort lautet:';  
$SENDPASS_BEFORE_LINK   = 'Hier kommen Sie wieder auf Ihre Login-Seite: '; 
                        
#######################################
# Common texts
$TXTCOMMON_Startpage    = 'Zur�ck zur Anmeldung';  
$TXTCOMMON_EMail        = 'E-Mail:';       
$TXTCOMMON_Password     = 'Passwort:';    
$TXTCOMMON_SendToFriend = 'An einen Freund weiterempfehlen';
$TXTCOMMON_Salutation   = 'Hallo';  
$TXTCOMMON_Submit       = 'Ausf�hren';      
$TXTCOMMON_Reset        = 'Zur�cksetzen';       
                        
# Login texts
$TXTLOGIN_Title         = 'Anmelden';         
$TXTLOGIN_Text          = 'Bitte geben Sie die Ihre E-Mail-Adresse und Ihr Passwort ein:';          
$TXTLOGIN_WrongPassword = 'Ihre Eingaben sind nicht korrekt. Entweder ist die EMail-Adresse falsch geschrieben oder Sie haben ein falsches Passwort eingegeben! Bitte versuchen Sie es erneut.'; 
$TXTLOGIN_ForgotPassword= 'Haben Sie Ihr Passwort vergessen? Dann klicken Sie bitte hier.';
$TXTLOGIN_NewUser       = 'M�chten Sie sich neu eintragen? Dann klicken Sie bitte hier.';       
$TXTLOGIN_SendButton    = 'Abschicken!';    
                        
# Forgotten Pasword texts
$TXTForg_Title          = 'Passwort vergessen';
$TXTForg_Text           = 'Bitte geben Sie Ihre E-Mail-Adresse ein. Sofern Sie in diesem System eingetragen sind, wird Ihnen eine E-Mail mit dem Passwort zugeschickt.'; 
                
###JN->
$TXTForg_Newsletter     = '<font color="#FF0000"><b>Bitte w�hlen Sie mindestens einen Newsletter aus</b></font>';     
$TXTForg_Email          = '<font color="#FF0000"><b>Ihre E-Mail-Adresse ist bereits in unserem System eingetragen.</b></font>';          
$TXTorg_Friend          = '<b>Danke, dass Sie die Einladung angenommen haben.</b>';          
$TXTForg_Email2         = '<font color="#FF0000"><b>Bitte geben Sie Ihre Email-Adresse an</b></font>';         
$TXTForg_Pass           = '<font color="#FF0000"><b>Bitte geben Sie Ihr Passwort an, achten Sie darauf, dass es in beiden Feldern gleich geschrieben wird.</b></font>';           
$TXTForg_Address        = '<font color="#FF0000"><b>Bitte geben Sie Ihre Adressdaten an.</b></font>';   

$TXTForg_Country			= '<font color="#FF0000"><b>Bitte geben Sie Ihr Land ein.</b></font>'; 
$TXTForg_Street				= '<font color="#FF0000"><b>Bitte geben Sie Ihre Stra�e und Hausnummer ein.</b></font>';
$TXTForg_Zip					= '<font color="#FF0000"><b>Bitte geben Sie Ihre Postleitzahl ein.</b></font>';
$TXTForg_City					= '<font color="#FF0000"><b>Bitte geben Sie den Ort ein.</b></font>';
     
$TXTForg_Fax					= '<font color="#FF0000"><b>Bitte geben Sie eine korrekte Faxnummer ein.</b></font>'; 
$TXTForg_Sms				= '<font color="#FF0000"><b>Bitte geben Sie eine korrekte SMS-Handynummer ein. </b></font>';
		 
$TXTForg_Name           = '<font color="#FF0000"><b>Bitte geben Sie Ihren Vor- und Zunamen an.</b></font>';           
$TXTForg_Anrede         = '<font color="#FF0000"><b>Bitte geben Sie eine Anrede an.</b></font>';         
$TXTForg_Userfield      = '<font color="#FF0000"><b>Bitte f�llen sie das folgende Feld aus.</b></font>';      
$TXTForg_Birthdate      = '<font color="#FF0000"><b>Bitte geben Sie Ihr Geburtsdatum an.</b></font>';      
$TXTForg_AGB            = '<font color="#FF0000"><b>Bitte AGBs anerkennen!</b></font>';            
                          
$TXT_Field_obli         = '*';         
$TXT_User_Friend_prefill= 'Schau mal, dieser Newsletter d�rfte auch Dich interessieren.';
$TXT_AGB_1              = 'AGBs: Mit dem Absenden dieses Formulars erkl�ren Sie sich mit unseren AGBs und den Nutzungsbedingungen einverstanden.<br>Sie k�nnen Ihr Abonnement jederzeit unter ';              
$TXT_AGB_2              = ' oder �ber den Abbestelllink, den Sie in jeder Mail finden, wieder k�ndigen.<br><br>Verantwortlich f�r den Inhalt und Versand der Newsletter ist';              
                        
##################
# some more text JN 11.12.2005 ->
$TXTUserdata_title              = '[TXTUserdata_title]';           
$TXTPassword_forgotten_title    = 'Passwort vergessen'; 
$TXTRemoved_from_all_title      = 'Abmeldung';
$TXTSend_to_friend_title        = 'Empfehlen';     
$TXTThanks_invitation_title     = 'Danke';  
$TXTThanks_sent_pass            = 'Passwort versendet';         
                                  
$TXTThanks_userdata_confirm     = 'Danke f�r das Abonnement';  
$TXTThanks_userdata             = 'Danke';          
                               
$TXTThanks_change_email_form_title = 'Changed!';  //MISSING
$TXTThanks_change_email_form_header = 'Changed!'; //MISSING
$TXTThanks_change_email_form_text = 'Email form changed'; //MISSING

# <- JN 11.12.2005


# User Data texts
//$TXTUser_Title 			= 'Daten eintragen/�ndern';
$TXTUser_Title_new_users = 'Daten eintragen';
$TXTUser_Title_logged_users = 'Profil �ndern';
$TXTUser_Text 			= "Bitte tragen Sie in die Felder Ihre Daten ein. Die mit Stern (*) gekennzeichneten Felder m�ssen ausgef�llt werden, damit Ihre Daten aufgenommen werden k�nnen. ";
$TXTUser_Legend 		= "$TXT_Field_obli) Eingabe obligatorisch";

########################################
# Replace values for mini-mode (Alecsey Fuga)








$TXTUser_TitlesArray = array('Herr','Frau','Herr Dr.','Frau Dr.','Herr Prof.','Frau Prof.','Firma');  

$TXTUser_TitlePers 	        = 'Anrede:&nbsp;';
$TXTUser_FirstName 	        = 'Vorname:&nbsp;'.$TXT_Field_obli;
$TXTUser_LastName 	        = 'Nachname:&nbsp;'.$TXT_Field_obli;
$TXTUser_EMail 			= 'E-Mail:&nbsp;'.$TXT_Field_obli;
$TXTUser_Password1 	        = 'Passwort:&nbsp;*';
$TXTUser_Password2 	        = 'Passwort (Wiederh.)&nbsp;*';
$TXTUser_Address 		= 'Stra�e und Hausnr.:';
$TXTUser_ZIP						= 'PLZ';
$TXTUser_City					= 'Ort';
$TXTUser_Country 		= 'Land:';
$TXTUser_Birthdate              = 'Geburtstag:';
$TXTUser_Newsletters            = 'Newsletter:***';
$TXTUser_EMailFormat            = 'Sie bevorzugen:';
$TXTUser_EMailHTML 	        = 'HTML-E-Mails';
$TXTUser_EMailText 	        = 'Text-E-Mails';
$TXTUser_EMailPost 	        = 'Zusendung per Post';
$TXTUser_EMailFax			= 'Fax-Zusendung';
$TXTUser_EMailSms			= 'SMS-Zusendung';
$TXTUser_Unsubscribe            = 'Von allen Newslettern abmelden';
$TXTUser_Send_To_Friend_Intro_1 = 'Sehr geehrte/r';
$TXTDearReader = 'Lieber Leser';
$TXTUser_Send_To_Friend_Intro_2 = 'willkommen beim Newsletter-Service von';
$TXTUser_Send_To_Friend_Intro_3 = '<br>Wollen Sie mehr erfahren und regelm��ig von uns informiert werden? Dann melden Sie sich doch einfach unverbindlich an!<br>Unsere aktuellen Mailings finden sie weiter unten, die empfohlenen Mailings sind voreingestellt.';
$TXTUser_Send_To_Friend_Intro_4 = '[TXTUser_Send_To_Friend_Intro_4]';

# Send to A Friend
$TXTFriend_TextTitle            = 'Weiterempfehlen';
$TXTFriend_Text                 = 'Sie m�chten unsere Newsletter einem Freund weiterempfehlen? Vielen Dank schon einmal daf�r! Tragen Sie unten den Namen und die E-Mail-Adresse ihres Freundes ein und w�hlen Sie die Newsletter aus. Zus�tzlich k�nnen Sie eine kleine Nachricht Ihrem Freund zukommen lassen.';
$TXTFriend_FirstName            = 'Vorname:';
$TXTFriend_LastName             = 'Nachname:';
$TXTFriend_EMail                = 'E-Mail:';
$TXTFriend_Newsletters          = 'Newsletter:';
$TXTFriend_Message              = 'Nachricht:';

# Confirmations
$TXTConfirm_UnsubscribeTitle    = 'Abmeldung erfolgreich';
$TXTConfirm_Unsubscribe         = 'Sie haben sich von allen Newslettern abgemeldet. Wenn Sie wieder Newsletter empfangen m�chten, m�ssen Sie sich neu anmelden.'; 
$TXTConfirm_SendPasswordTitle   = 'Passwort zugesandt';
$TXTConfirm_SendPassword        = 'Ihr Passwort wurde an die angegeben E-Mail-Adresse versandt, sofern uns die angegebene E-Mail-Adresse bekannt ist. Sollten Sie in den n�chsten Minuten keine E-Mail von uns erhalten, haben Sie sich vermutlich verschrieben. Probieren Sie es in diesem Fall bitte noch einmal.';
$TXTConfirm_Friend              = 'Vielen Dank, die Empfehlung wurde abgesendet.';
$TXTConfirm_Friend              = 'Vielen Dank, die Empfehlung wurde abgesendet.';
$TXTConfirm_UserdataMailTitle   = 'Anmeldung zugesandt';
$TXTConfirm_UserdataMail        = 'Danke, dass Sie sich angemeldet haben. <br> Es wurde eine E-Mail verschickt, in der sich ein Link befindet. <b>Erst nachdem Sie diesen angeklickt haben, sind Sie tats�chlich f�r die Newsletter eingetragen.</b> <br>Diese Ma�nahme dient zu Ihrer Sicherheit.';
$TXTConfirm_UserdataNoMailTitle = 'Anmeldung/�nderung erfolgreich';
$TXTConfirm_UserdataNoMail      = 'Vielen Dank, Ihre Anmeldung oder �nderung wurde entgegengenommen. ';
$TXTConfirm_UserdataYouSubscribedTo = 'Sie haben sich f�r folgende Newsletter eingetragen:'; 
$TXTConfirm_InvitationTitle     = 'Einladung eingetragen';
$TXTConfirm_Invitation          = 'Vielen Dank, dass Sie uns bez�glich der Einladung informiert haben. Ihr Eintrag wurde gespeichert.';
                                                                 
                                                                
$DOUBLEOPTIN_MSG0  = 'Sehr geehrte/r';
$DOUBLEOPTIN_MSG1  = 'willkommen beim Newsletter-Dienst von';
$DOUBLEOPTIN_MSG2  = 'Sie haben folgende Newsletter unseres Services abonniert:';
$DOUBLEOPTIN_MSG3  = 'Bevor Sie unsere Newsletter erhalten, m�ssen Sie aus Sicherheitsgr�nden Ihr Abonnement best�tigen, indem Sie auf untenstehenden Link klicken.';
$DOUBLEOPTIN_MSG4  = 'Ihr Abonnement k�nnen Sie jederzeit unter ';
$DOUBLEOPTIN_MSG5  = ' anpassen oder k�ndigen.';
$DOUBLEOPTIN_MSG6  = 'Loggen Sie sich dazu einfach mit Ihrer Email-Adresse und Ihrem Passwort ';
$DOUBLEOPTIN_MSG7  = ' ein.';
$DOUBLEOPTIN_MSG8  = 'Wir w�nschen Ihnen viel Spa� mit unseren Newslettern.';
$DOUBLEOPTIN_MSG9  = 'Verantwortlich f�r diesen Newsletter-Service ist';
//subscribe link
$DOUBLEOPTIN_MSG10  = 'Abonnement best�tigen';
//unsubscribe link
$DOUBLEOPTIN_MSG11  = 'Abonnement k�ndigen';

#$TXTDOpt_6 = 'Ihr Abonnement k�nnen Sie jederzeit unter';
#$TXTDOpt_7 = 'anpassen oder k�ndigen.<br>Loggen Sie sich dazu einfach mit Ihrer Email-Adresse und Ihrem Passwort';
#$TXTDOpt_8 = 'ein.<br><br>Wir w�nschen Ihnen viel Spa� mit unseren Newslettern.<br><br>Verantwortlich f�r diesen Newsletter-Service ist';
$TXTDOpt_Subject                = 'Anmeldebest�tigung erbeten';
# <-


############################################################
#change variable values used in DOpt if ConfirmedOpt active
if ($CONFIRM_EMAIL==2) {
	$DOUBLEOPTIN_MSG0  ='Sehr geehrte/r';
	$DOUBLEOPTIN_MSG1  ='willkommen beim Newsletter-Dienst von';
	$DOUBLEOPTIN_MSG2  ='Sie haben folgende Newsletter unseres Services abonniert:';
	$DOUBLEOPTIN_MSG3  ='Bevor Sie unsere Newsletter erhalten, m�ssen Sie aus Sicherheitsgr�nden Ihr Abonnement best�tigen, indem Sie auf untenstehenden Link klicken.';
	$DOUBLEOPTIN_MSG4  ='Ihr Abonnement k�nnen Sie jederzeit unter ';
	$DOUBLEOPTIN_MSG5  =' anpassen oder k�ndigen.';
	$DOUBLEOPTIN_MSG6  ='Loggen Sie sich dazu einfach mit Ihrer Email-Adresse und Ihrem Passwort ';
	$DOUBLEOPTIN_MSG7  =' ein.';
	$DOUBLEOPTIN_MSG8  ='Wir w�nschen Ihnen viel Spa� mit unseren Newslettern.';
	$DOUBLEOPTIN_MSG9  ='Verantwortlich f�r diesen Newsletter-Service ist';
  //subscribe link
  $DOUBLEOPTIN_MSG10  = 'Abonnement best�tigen';
  //unsubscribe link
  $DOUBLEOPTIN_MSG11  = 'Abonnement k�ndigen';

	$TXTDOpt_Subject = 'Vielen Dank f�r Ihre Newsletter-Anmeldung';
}


/*$CONFIRMEDOPTIN_MSG0 = 'Hi/r';
$CONFIRMEDOPTIN_MSG1 = 'Welcome to our system';
$CONFIRMEDOPTIN_MSG2 = 'You are subscribed on next newsletters:';
$CONFIRMEDOPTIN_MSG3 = '';
$CONFIRMEDOPTIN_MSG4 = 'If you want to unsubscribe click this link ';
$CONFIRMEDOPTIN_MSG5 = '';
$CONFIRMEDOPTIN_MSG6 = '';
$CONFIRMEDOPTIN_MSG7 = '';
$CONFIRMEDOPTIN_MSG8 = '';
$CONFIRMEDOPTIN_MSG9 = 'With best regards, ';

$TXTConfirmedOpt_5						 = 'Unsubscribe from all';
$TXTConfirmedOpt_Subject         = 'Newsletter subscription';
*/


########################################################
# Countries
$NO_COUNTRY_SYMBOL = '---';
$PRESELECTED_COUNTRY = "Deutschland";

$COUNTRIES = array("Deutschland","�sterreich","Schweiz",$NO_COUNTRY_SYMBOL,"Afghanistan","�gypten","Albanien","Algerien","Angola","Antigua Barbuda","�quatorial Guinea","Argentinien","Armenien","Aserbaidschan","�thiopien","Australien","Azoren (zu Portugal)","Bahamas","Bahrain","Balearen (zu Spanien)","Bali (zu Indonesien)","Bangladesh","Barbados","Belgien","Belize","Benin","Bermuda","Bhutan","Bolivien","Bosnien-Herzegowina","Botswana","Brasilien","Brunei Darussalam","Bulgarien","Burkina Faso","Burma (Myanmar)","Burundi","Cape Verde","Cayman Inseln","Chile","China","Cook-Inseln","Costa Rica","Cote d�Ivoire","Djibouti","Dominica","Dominikanische Republik","Ecuador","Elfenbeink�ste","El Salvador","Eritrea","Estland","Fidschi-Inseln","Franz�sisch Guyana","Franz�sisch Polynesien","Gabun","Gambia","Georgien","Ghana","Grenada","Griechenland","Griechische Inseln (zu GR)","Guadeloupe","Guam","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Hawaii (zu USA)","Honduras","Hong Kong (zu China)","Indien","Indonesien","Irak","Iran","Isla Margarita (zu Venezuela)","Israel","Italien","Jamaika","Japan","Java (zu Indonesien)","Jemen","Jordanien","Jungferninseln (brit. USA)","Kambodscha","Kamerun","Kanada","Kanarische Inseln  (zu Spanien)","Kap Verde","Kasachstan","Kenia","Kirgisistan","Kiribati","Kolumbien","Komoren","Kongo, Rep. (Brazzaville)","Kongo, Dem. Rep. (Zaire)","Korea, Nord-","Korea, S�d-","Korsika (zu F)","Kreta (zu GR)","Kroatien","Kuba","Kuwait","Laos","Lesotho","Lettland","Libanon","Liberia","Libyen","Litauen","Macao","Madagaskar","Madeira (zu Portugal)","Malawi","Malaysia","Malediven","Mali","Malta","Marokko","Martinique","Mauretanien","Mauritius","Mayotte (zu F)","Mazedonien","Mexico","Mikronesien","Moldawien","Mongolei","Montenegro (zu YU)","Montserrat","Mozambique","Myanmar (Burma)","Namibia","Nauru","Nepal","Neu Caledonien","Neuseeland","Nicaragua","Niederlande","Niederl. Antillen","Niger","Nigeria","Niue","Nord-Korea","Nord-Marianen","Oman","Oster-Insel (zu Chile)","Pakistan","Pal�stinensische Gebiete","Palau","Panama","Papua-Neu Guinea","Paraguay","Peru","Philippinen","Pitcairn","Polen","Portugal","Puerto Rico (zu USA)","Qatar","Reunion (zu F)","Ruanda","Rum�nien","Ru�land","Samoa","San Andres (zu Kolumbien)","San Marino (s. Italien)","Sao Tom� Principe","Sardinien (zu I)","Saudi-Arabien","Schweden","Senegal","Serbien (zu YU)","Seychellen","Sierra Leone","Simbabwe","Singapur","Sizilien (zu I)","Slowakei","Slowenien","Solomon Inseln","Somalia","Spanien","Sri Lanka","St. Helena (zu GB)","St. Kitts Nevis","St. Lucia","St. Vincent Grenadinen","S�dafrika","Sudan","S�d-Korea","Sulawesi (zu Indonesien)","Sumatra (zu Indonesien)","Surinam","Swaziland","Syrien","Tadschikistan","Taiwan","Tanzania","Thailand","Tibet (zu China)","Togo","Tokelau-Inseln (zu Neuseeland)","Tonga","Trinidad Tobago","Tschad","Tschechische Republik","Tunesien","T�rkei","Turkmenistan","Tuvalu","Uganda","Ukraine","Ungarn","Uruguay","USA","Usbekistan","Vanuatu","Venezuela","Vereinigte Arabische Emirate","Vietnam","Wake Island","Weihnachts-Insel (zu AUS)","Wei�ru�land","Zaire (Kongo, Dem. Rep.)","Zambia","Zanzibar Pemba (zu Tanzania)","Zentralafrikanische Republik","Zimbabwe","Zypern");  //MISSING
$WebServerAddress = 'www.mallorca-finca-reisen.de';

// added by Fuga A.V. 15-07-07
$TXTTopMenu_Login = 'Anmelden';
$TXTTopMenu_RememberPassword = 'Passwort vergessen';
$TXTTopMenu_Registration = 'Registrieren';
$TXTTopMenu_ChangeProfile = 'Profil �ndern';
$TXTTopMenu_ChangePassword = 'Passwort �ndern';
$TXTTopMenu_Subscriptions = 'Newsletter-Anmeldungen';
$TXTTopMenu_DeleteAccount = 'Profil l�schen';
$TXTTopMenu_Logout = 'Abmelden';
$TXTTopMenu_Imprint = 'AGBs';
$TXTTopMenu_Terms = 'Nutzungsbedingungen';

//Pages titles
$TXTTerms_page_title = 'Nutzungsbedingungen';
$TXTImprint_page_title = 'AGBs';
$TXTLogin_page_title = 'Anmelden';
$TXTThanks_sendtofriend_title = 'Weiterempfehlen';
$TXTSubscriptions_page_title = 'Newsletter-Anmeldung';
$TXTConfirm_delete_title = 'Newsletter abmelden'; 
$TXTChange_password_page_title = 'Passwort �ndern';
$TXTThanks_change_password_form_title = 'Passwort �ndern';

$TXTTerms_Title = 'Nutzungsbedingungen';
$TXTTerms_Text = 'Hier haben Sie Platz zur Darstellung Ihrer Nutzungsbedingungen.<br><br>
Wenn Sie diese Seite nicht mehr anzeigen m�chten, gehen Sie in mail to date unter <i>Verwaltung -> Einstellungen Service Center</i> in das Men�  <i>Inhalte</i> und deaktivieren Sie den Schalter <i>Nutzungsbedingungen</i>  .<br><br>
Um Ihre Nutzungsbedingungen oder einen anderen Text einzugeben, gehen Sie in mail to date unter <i>Verwaltung -> Einstellungen Service Center</i> in das Men� <i>Texte</i>. <br><br>
W�hlen Sie hier den Eintrag <i>Nutzungebedingungen (ausf�hrlicher Text)</i> zur Eingabe des Seiteninhalts und  <i>Nutzungsbedingungen (Titel)</i>  zur Eingabe der �berschrift.<br>';

$TXTImprint_Title = 'AGBs';
$TXTImprint_Text = '<b>1. Buchung/Umbuchung: </b> Sie erhalten die schriftliche Buchungsbest�tigung die f�r ihre Wirksamkeit von Ihnen unterschrieben zur�ckgesendet wird. Der Unterzeichnende verpflichtet sich durch seine Unterschrift auch im Namen aller Teilnehmer, f�r s�mtliche Vertragsverpflichtungen gem�� der Mietbedingungen einzustehen. Grundlage des Vertrages sind ausschlie�lich die am Buchungstag und f�r den Reisezeitraum g�ltigen Angaben der Hausbeschreibung. Die Unterk�nfte d�rfen nicht von mehr Personen als angemeldet bewohnt werden. Ist eine Umbuchung aufgrund Reisetermin, Domizil und/oder Anzahl der Teilnehmer notwendig, kann eine Umbuchungsgeb�hr von � 40.-  
f�llig werden. Ist die Umbuchung nicht mehr m�glich, muss eine Neuanmeldung zu den o.g. Konditionen erfolgen. Die Angaben in der Buchungsbest�tigung sind Umfang der vertraglichen Leistungen. Nebenabreden sind nur in schriftlicher Form und mit ausdr�cklicher schriftlicher Best�tigung g�ltig. Der Newsletter ist ein exklusiver Service f�r die Kunden, der Firma Life & Art GmbH. Er informiert �ber die aktuellsten Angebote aus unserem Finca-Programm. Der Newsletter wird automatisch mit der Buchung abboniert. Wenn Sie den Newsletter-Service abmelden m�chten, k�nnen Sie dies �ber den Abmelde-Link mit dem n�chsten Newsletter tun. <br><br>
<b>2. Bezahlung: </b> Falls in der Buchungsbest�tigung nicht anders vereinbart: 25% der Gesamtsumme f�llig binnen 10 Tagen nach Erhalt der Buchungsbest�tigung. �ber die geleistete Anzahlung erhalten Sie keine gesonderte Best�tigung.
Die Restzahlung erfolgt bis sp�testens 4 Wochen vor Anreise, ohne weitere Aufforderung. Die abschlie�ende Reisebest�tigung erhalten Sie ca. 1 Woche vor Anreisedatum. Nichtzahlungen oder versp�tete Zahlungen gelten als R�cktritt und berechtigen Life & Art GmbH die Unterkunft anderweitig zu vermieten. <br><br>
<b>3. R�cktritt/Storno: </b> R�cktritts- bzw Stornogeb�hren werden in H�he von 25% bis 90 Tage vor Anreisedatum, 35% zwischen 90 und 60 Tagen und 50% von 60 - 30 Tagen vor Anreise/Mietbeginn f�llig. Ab dem 30. Tag vor Anreise/Mietbeginn wird der Gesamtbetrag f�llig. Bitte beachten Sie, dass auch eine unverschuldete Absage als R�cktritt gilt. R�cktrittskosten werden abh�ngig vom Tage des Posteingangs berechnet. <br><br>
<b>4. Leistungen: </b> Bei den von Life & Art GmbH angebotenen Leistungen handelt es sich ausschlie�lich um die Vermittlung von Fremdleistungen zwischen dem Unterzeichnenden, den Mitreisenden und der jeweiligen Vertragspartei. Alle Schadensersatzanspr�che des Unterzeichners -nachfolgend Mieter genannt-  sind an den jeweiligen Eigent�mer zu stellen. Der Vertrag wird im Namen und f�r Rechnung des Leistungstr�gers: Eigent�mer, Vermieter oder Verwalter - nachfolgend Eigent�mer genannt - abgeschlossen. Er gilt f�r den angemeldeten Zeitraum und die angemeldete Zahl von Personen und Haustieren. Wir empfehlen den Abschluss eines Versicherungspakets (Reiser�cktritts- , Reisegep�ck- und Reiseunfallversicherung). <br><br>
<b>5. Haftung: </b> Die Ausschreibung wurde nach bestem Wissen und nach den Angaben des Eigent�mers erstellt. F�r eine Beeinflussung des Mietobjektes durch h�here Gewalt, wie z.B. Streik, Krieg, Erdbeben, landes�bliche Strom- und Wasserausf�lle, Unwetterlagen wird nicht gehaftet. Ebenfalls haften wir nicht f�r eine st�ndige Bereitschaft von Installationen wie Zentralheizung, Pool etc., sowie f�r L�rmbel�stigung durch Baut�tigkeiten auf Nachbargrundst�cken ohne zeitliche Begrenzung. Ist die Nutzung des Mietobjektes auf Grund h�herer Gewalt nicht m�glich und kein Ersatzobjekt vermittelbar, so wird die Haftung auf maximal die H�he der vereinbarten Restzahlung beschr�nkt. Eine Haftung f�r vor�bergehende St�rungen in der Wasser/ - Stromversorgung oder St�rungen durch naturbedingte oder �rtliche Begebenheiten wird ausgeschlossen. <br><br>
<b>6. Mitwirkungspflicht: </b> Bei eventuell auftretenden Leistungsst�rungen ist der Kunde verpflichtet, im Rahmen der gesetzlichen Bestimmungen alles zu tun, um zu einer Behebung der St�rung beizutragen und den eventuell entstandenen Schaden gering zu halten. Der Mieter ist aufgefordert bei Ankunft das Inventar des Mietobjektes zu �berpr�fen und innerhalb von 24 Stunden dem Eigent�mer M�ngel zu melden, damit Abhilfe geleistet werden kann. Auch alle sonstigen Beanstandungen an der Mietsache m�ssen unverz�glich dem Eigent�mer gemeldet werden. Der Mieter hat alle w�hrend seiner Aufenthaltsdauer verursachten Sch�den dem Eigent�mer zu melden und die Unterkunft nebst Inventar pfleglich zu behandeln
Die gemietete Unterkunft ist sauber, d.h. besen- und schrankrein zu hinterlassen. <br><br> 
<b>7. Anreise/Abreise: </b> Das Mietobjekt kann  am Anreisetag ab ca. 14:00 Uhr bezogen werden; am Abreisetag verl�sst der Mieter das Haus bis sp�testens 10:00 Uhr. Sollte der Mieter das Objekt am Abreisetag l�nger bewohnen wollen, muss er dies vor Ort mit dem Vermieter bzw. dessen Vertreter vereinbaren. <br><br>
<b>8. Haustiere: </b>Das Mitbringen von Haustieren bedarf der schriftlichen Genehmigung des Eigent�mers. Der Mieter haftet f�r s�mtliche vom Tier verursachten Sch�den. In jedem Fall wird eine Kautionshinterlegung von � 150,- bei der Vermittlerin vereinbart, die nach dem Aufenthalt zur�ckerstattet werden. <br><br>
<b>9. Gerichtsstand: </b> Alle Schadensersatzanspr�che des Reisenden sind an den jeweiligen Eigent�mer, Vermieter oder Verwalter zu stellen. Erf�llungsort und Gerichtsstand ist der jeweilige Ort der Liegenschaft bzw. der Wohnort des Eigent�mers, Vermieters oder Verwalters. <br><br>
<b>10. Sonstiges: </b> S�mtliche Erkl�rungen des Kunden hinsichtlich Umbuchung, Termin�nderung oder R�cktritt haben schriftlich zu erfolgen und bed�rfen zu ihrer Wirksamkeit der schriftlichen Best�tigung durch Life & Art GmbH.	
';

$TXTSubscriptions_Title = 'Newsletter-Anmeldung';
$TXTSubscriptions_Text = 'Sie haben sich f�r die folgenden Newsletter angemeldet: ';
$TXTSubscriptions_Text_future = 'Sie melden sich f�r folgene Newsletter an:';
$TXTSubscriptions_only_one_variant_text = 'Sie haben sich f�r den folgenden Newsletter angemeldet: ';
$TXTSubscriptions_only_one_variant_text_future = 'Sie melden sich f�r folgende(n) Newsletter an: ';
$TXTSubscriptions_nothing = 'Sie haben sich f�r keinen Newsletter angemeldet.';

$TXTConfirm_DeleteTitle =  'Newsletter abmelden'; 
$TXTConfirm_Delete = 'M�chten Sie  Ihren Account wirklich l�schen?';
$Confirm_delete_yes_button_caption = 'Ja, bitte l�schen';
$Confirm_delete_no_button_caption = 'Nein, bitte nicht l�schen';

$TXTChange_password_Title = 'Passwort �ndern';
$TXTChange_password_Text = 'Sie k�nnen hier Ihr derzeitiges Passwort ab�ndern, indem sie das derzeitige und anschlie�end zwei mal das neue Passwort eintragen: ';
$TXTOld_password = 'Altes Passwort:';
$TXTNew_password = 'Neues Passwort:';
$TXTNew_password_confirm = 'Neues Passwort wiederholen:';
$Confirm_password_button_text = '�nderung durchf�hren';
$TXTChange_password_error1 = '<h3 style=\'color: red;\'>Sie haben das alte Passwort ist falsch eingetragen!</h3>';
$TXTChange_password_error2 = '<h3 style=\'color: red;\'>Sie m�ssen ein neues Passwort angeben!</h3>';
$TXTChange_password_error3 = '<h3 style=\'color: red;\'>Die beiden neuen Passwort-Eingaben stimmen nicht �berein. </h3>';

$TXTThanks_change_password_form_header = 'Passwort ge�ndert';
$TXTThanks_change_password_form_text = 'Das Passwort wurde erfolgreich abge�ndert. ';
$AccountCreatedChanged = 'Profil zuletzt ge�ndert:';
$BackToStartpageText = 'zum Startmen�';


?>
