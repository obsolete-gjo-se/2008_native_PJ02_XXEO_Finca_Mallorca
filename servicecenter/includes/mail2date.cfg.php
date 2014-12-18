<?php
####################################
$DEBUG = 0;
$PASSWORD = '%§$(/&HZUFHSHOPhjghjewreuigt43vgs';

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
# Bestätigungsemail


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

# Betreffzeile der Bestätigungsemail
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
# Änderungen
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
$SENDTOFRIEND_INTRO_P4  = 'Klicken Sie auf den untenstehenden Link, um sich ebenfalls für diesen interessanten Newsletter anzumelden:';
$SENDTOFRIEND_LINK      = 'Wollen Sie mehr erfahren, klicken Sie hier, um sich ebenfalls für den oder die Newsletter anzumelden.';
$SENDTOFRIEND_END       = 'Dieser Service ist kostenfrei und kann auch nach Anmeldung jederzeit wieder von Ihnen gekündigt werden.';
$SENDTOFRIEND_END_2     = 'Verantwortlich für diesen Newsletter-Service ist';
                        
#######################################
# Send Password Mailtext
$SENDPASS_HEADER        = 'Ihr Passwort vom ServiceCenter';
$SENDPASS_ANREDE        = 'Sehr geehrte/r';      
$SENDPASS_INTRO         = 'wie gewünscht senden wir Ihnen Ihr Passwort zu.';       
$SENDPASS_STARTPASS     = 'Ihr Passwort lautet:';  
$SENDPASS_BEFORE_LINK   = 'Hier kommen Sie wieder auf Ihre Login-Seite: '; 
                        
#######################################
# Common texts
$TXTCOMMON_Startpage    = 'Zurück zur Anmeldung';  
$TXTCOMMON_EMail        = 'E-Mail:';       
$TXTCOMMON_Password     = 'Passwort:';    
$TXTCOMMON_SendToFriend = 'An einen Freund weiterempfehlen';
$TXTCOMMON_Salutation   = 'Hallo';  
$TXTCOMMON_Submit       = 'Ausführen';      
$TXTCOMMON_Reset        = 'Zurücksetzen';       
                        
# Login texts
$TXTLOGIN_Title         = 'Anmelden';         
$TXTLOGIN_Text          = 'Bitte geben Sie die Ihre E-Mail-Adresse und Ihr Passwort ein:';          
$TXTLOGIN_WrongPassword = 'Ihre Eingaben sind nicht korrekt. Entweder ist die EMail-Adresse falsch geschrieben oder Sie haben ein falsches Passwort eingegeben! Bitte versuchen Sie es erneut.'; 
$TXTLOGIN_ForgotPassword= 'Haben Sie Ihr Passwort vergessen? Dann klicken Sie bitte hier.';
$TXTLOGIN_NewUser       = 'Möchten Sie sich neu eintragen? Dann klicken Sie bitte hier.';       
$TXTLOGIN_SendButton    = 'Abschicken!';    
                        
# Forgotten Pasword texts
$TXTForg_Title          = 'Passwort vergessen';
$TXTForg_Text           = 'Bitte geben Sie Ihre E-Mail-Adresse ein. Sofern Sie in diesem System eingetragen sind, wird Ihnen eine E-Mail mit dem Passwort zugeschickt.'; 
                
###JN->
$TXTForg_Newsletter     = '<font color="#FF0000"><b>Bitte wählen Sie mindestens einen Newsletter aus</b></font>';     
$TXTForg_Email          = '<font color="#FF0000"><b>Ihre E-Mail-Adresse ist bereits in unserem System eingetragen.</b></font>';          
$TXTorg_Friend          = '<b>Danke, dass Sie die Einladung angenommen haben.</b>';          
$TXTForg_Email2         = '<font color="#FF0000"><b>Bitte geben Sie Ihre Email-Adresse an</b></font>';         
$TXTForg_Pass           = '<font color="#FF0000"><b>Bitte geben Sie Ihr Passwort an, achten Sie darauf, dass es in beiden Feldern gleich geschrieben wird.</b></font>';           
$TXTForg_Address        = '<font color="#FF0000"><b>Bitte geben Sie Ihre Adressdaten an.</b></font>';   

$TXTForg_Country			= '<font color="#FF0000"><b>Bitte geben Sie Ihr Land ein.</b></font>'; 
$TXTForg_Street				= '<font color="#FF0000"><b>Bitte geben Sie Ihre Straße und Hausnummer ein.</b></font>';
$TXTForg_Zip					= '<font color="#FF0000"><b>Bitte geben Sie Ihre Postleitzahl ein.</b></font>';
$TXTForg_City					= '<font color="#FF0000"><b>Bitte geben Sie den Ort ein.</b></font>';
     
$TXTForg_Fax					= '<font color="#FF0000"><b>Bitte geben Sie eine korrekte Faxnummer ein.</b></font>'; 
$TXTForg_Sms				= '<font color="#FF0000"><b>Bitte geben Sie eine korrekte SMS-Handynummer ein. </b></font>';
		 
$TXTForg_Name           = '<font color="#FF0000"><b>Bitte geben Sie Ihren Vor- und Zunamen an.</b></font>';           
$TXTForg_Anrede         = '<font color="#FF0000"><b>Bitte geben Sie eine Anrede an.</b></font>';         
$TXTForg_Userfield      = '<font color="#FF0000"><b>Bitte füllen sie das folgende Feld aus.</b></font>';      
$TXTForg_Birthdate      = '<font color="#FF0000"><b>Bitte geben Sie Ihr Geburtsdatum an.</b></font>';      
$TXTForg_AGB            = '<font color="#FF0000"><b>Bitte AGBs anerkennen!</b></font>';            
                          
$TXT_Field_obli         = '*';         
$TXT_User_Friend_prefill= 'Schau mal, dieser Newsletter dürfte auch Dich interessieren.';
$TXT_AGB_1              = 'AGBs: Mit dem Absenden dieses Formulars erklären Sie sich mit unseren AGBs und den Nutzungsbedingungen einverstanden.<br>Sie können Ihr Abonnement jederzeit unter ';              
$TXT_AGB_2              = ' oder über den Abbestelllink, den Sie in jeder Mail finden, wieder kündigen.<br><br>Verantwortlich für den Inhalt und Versand der Newsletter ist';              
                        
##################
# some more text JN 11.12.2005 ->
$TXTUserdata_title              = '[TXTUserdata_title]';           
$TXTPassword_forgotten_title    = 'Passwort vergessen'; 
$TXTRemoved_from_all_title      = 'Abmeldung';
$TXTSend_to_friend_title        = 'Empfehlen';     
$TXTThanks_invitation_title     = 'Danke';  
$TXTThanks_sent_pass            = 'Passwort versendet';         
                                  
$TXTThanks_userdata_confirm     = 'Danke für das Abonnement';  
$TXTThanks_userdata             = 'Danke';          
                               
$TXTThanks_change_email_form_title = 'Changed!';  //MISSING
$TXTThanks_change_email_form_header = 'Changed!'; //MISSING
$TXTThanks_change_email_form_text = 'Email form changed'; //MISSING

# <- JN 11.12.2005


# User Data texts
//$TXTUser_Title 			= 'Daten eintragen/ändern';
$TXTUser_Title_new_users = 'Daten eintragen';
$TXTUser_Title_logged_users = 'Profil ändern';
$TXTUser_Text 			= "Bitte tragen Sie in die Felder Ihre Daten ein. Die mit Stern (*) gekennzeichneten Felder müssen ausgefüllt werden, damit Ihre Daten aufgenommen werden können. ";
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
$TXTUser_Address 		= 'Straße und Hausnr.:';
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
$TXTUser_Send_To_Friend_Intro_3 = '<br>Wollen Sie mehr erfahren und regelmäßig von uns informiert werden? Dann melden Sie sich doch einfach unverbindlich an!<br>Unsere aktuellen Mailings finden sie weiter unten, die empfohlenen Mailings sind voreingestellt.';
$TXTUser_Send_To_Friend_Intro_4 = '[TXTUser_Send_To_Friend_Intro_4]';

# Send to A Friend
$TXTFriend_TextTitle            = 'Weiterempfehlen';
$TXTFriend_Text                 = 'Sie möchten unsere Newsletter einem Freund weiterempfehlen? Vielen Dank schon einmal dafür! Tragen Sie unten den Namen und die E-Mail-Adresse ihres Freundes ein und wählen Sie die Newsletter aus. Zusätzlich können Sie eine kleine Nachricht Ihrem Freund zukommen lassen.';
$TXTFriend_FirstName            = 'Vorname:';
$TXTFriend_LastName             = 'Nachname:';
$TXTFriend_EMail                = 'E-Mail:';
$TXTFriend_Newsletters          = 'Newsletter:';
$TXTFriend_Message              = 'Nachricht:';

# Confirmations
$TXTConfirm_UnsubscribeTitle    = 'Abmeldung erfolgreich';
$TXTConfirm_Unsubscribe         = 'Sie haben sich von allen Newslettern abgemeldet. Wenn Sie wieder Newsletter empfangen möchten, müssen Sie sich neu anmelden.'; 
$TXTConfirm_SendPasswordTitle   = 'Passwort zugesandt';
$TXTConfirm_SendPassword        = 'Ihr Passwort wurde an die angegeben E-Mail-Adresse versandt, sofern uns die angegebene E-Mail-Adresse bekannt ist. Sollten Sie in den nächsten Minuten keine E-Mail von uns erhalten, haben Sie sich vermutlich verschrieben. Probieren Sie es in diesem Fall bitte noch einmal.';
$TXTConfirm_Friend              = 'Vielen Dank, die Empfehlung wurde abgesendet.';
$TXTConfirm_Friend              = 'Vielen Dank, die Empfehlung wurde abgesendet.';
$TXTConfirm_UserdataMailTitle   = 'Anmeldung zugesandt';
$TXTConfirm_UserdataMail        = 'Danke, dass Sie sich angemeldet haben. <br> Es wurde eine E-Mail verschickt, in der sich ein Link befindet. <b>Erst nachdem Sie diesen angeklickt haben, sind Sie tatsächlich für die Newsletter eingetragen.</b> <br>Diese Maßnahme dient zu Ihrer Sicherheit.';
$TXTConfirm_UserdataNoMailTitle = 'Anmeldung/Änderung erfolgreich';
$TXTConfirm_UserdataNoMail      = 'Vielen Dank, Ihre Anmeldung oder Änderung wurde entgegengenommen. ';
$TXTConfirm_UserdataYouSubscribedTo = 'Sie haben sich für folgende Newsletter eingetragen:'; 
$TXTConfirm_InvitationTitle     = 'Einladung eingetragen';
$TXTConfirm_Invitation          = 'Vielen Dank, dass Sie uns bezüglich der Einladung informiert haben. Ihr Eintrag wurde gespeichert.';
                                                                 
                                                                
$DOUBLEOPTIN_MSG0  = 'Sehr geehrte/r';
$DOUBLEOPTIN_MSG1  = 'willkommen beim Newsletter-Dienst von';
$DOUBLEOPTIN_MSG2  = 'Sie haben folgende Newsletter unseres Services abonniert:';
$DOUBLEOPTIN_MSG3  = 'Bevor Sie unsere Newsletter erhalten, müssen Sie aus Sicherheitsgründen Ihr Abonnement bestätigen, indem Sie auf untenstehenden Link klicken.';
$DOUBLEOPTIN_MSG4  = 'Ihr Abonnement können Sie jederzeit unter ';
$DOUBLEOPTIN_MSG5  = ' anpassen oder kündigen.';
$DOUBLEOPTIN_MSG6  = 'Loggen Sie sich dazu einfach mit Ihrer Email-Adresse und Ihrem Passwort ';
$DOUBLEOPTIN_MSG7  = ' ein.';
$DOUBLEOPTIN_MSG8  = 'Wir wünschen Ihnen viel Spaß mit unseren Newslettern.';
$DOUBLEOPTIN_MSG9  = 'Verantwortlich für diesen Newsletter-Service ist';
//subscribe link
$DOUBLEOPTIN_MSG10  = 'Abonnement bestätigen';
//unsubscribe link
$DOUBLEOPTIN_MSG11  = 'Abonnement kündigen';

#$TXTDOpt_6 = 'Ihr Abonnement können Sie jederzeit unter';
#$TXTDOpt_7 = 'anpassen oder kündigen.<br>Loggen Sie sich dazu einfach mit Ihrer Email-Adresse und Ihrem Passwort';
#$TXTDOpt_8 = 'ein.<br><br>Wir wünschen Ihnen viel Spaß mit unseren Newslettern.<br><br>Verantwortlich für diesen Newsletter-Service ist';
$TXTDOpt_Subject                = 'Anmeldebestätigung erbeten';
# <-


############################################################
#change variable values used in DOpt if ConfirmedOpt active
if ($CONFIRM_EMAIL==2) {
	$DOUBLEOPTIN_MSG0  ='Sehr geehrte/r';
	$DOUBLEOPTIN_MSG1  ='willkommen beim Newsletter-Dienst von';
	$DOUBLEOPTIN_MSG2  ='Sie haben folgende Newsletter unseres Services abonniert:';
	$DOUBLEOPTIN_MSG3  ='Bevor Sie unsere Newsletter erhalten, müssen Sie aus Sicherheitsgründen Ihr Abonnement bestätigen, indem Sie auf untenstehenden Link klicken.';
	$DOUBLEOPTIN_MSG4  ='Ihr Abonnement können Sie jederzeit unter ';
	$DOUBLEOPTIN_MSG5  =' anpassen oder kündigen.';
	$DOUBLEOPTIN_MSG6  ='Loggen Sie sich dazu einfach mit Ihrer Email-Adresse und Ihrem Passwort ';
	$DOUBLEOPTIN_MSG7  =' ein.';
	$DOUBLEOPTIN_MSG8  ='Wir wünschen Ihnen viel Spaß mit unseren Newslettern.';
	$DOUBLEOPTIN_MSG9  ='Verantwortlich für diesen Newsletter-Service ist';
  //subscribe link
  $DOUBLEOPTIN_MSG10  = 'Abonnement bestätigen';
  //unsubscribe link
  $DOUBLEOPTIN_MSG11  = 'Abonnement kündigen';

	$TXTDOpt_Subject = 'Vielen Dank für Ihre Newsletter-Anmeldung';
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

$COUNTRIES = array("Deutschland","Österreich","Schweiz",$NO_COUNTRY_SYMBOL,"Afghanistan","Ägypten","Albanien","Algerien","Angola","Antigua Barbuda","Äquatorial Guinea","Argentinien","Armenien","Aserbaidschan","Äthiopien","Australien","Azoren (zu Portugal)","Bahamas","Bahrain","Balearen (zu Spanien)","Bali (zu Indonesien)","Bangladesh","Barbados","Belgien","Belize","Benin","Bermuda","Bhutan","Bolivien","Bosnien-Herzegowina","Botswana","Brasilien","Brunei Darussalam","Bulgarien","Burkina Faso","Burma (Myanmar)","Burundi","Cape Verde","Cayman Inseln","Chile","China","Cook-Inseln","Costa Rica","Cote d´Ivoire","Djibouti","Dominica","Dominikanische Republik","Ecuador","Elfenbeinküste","El Salvador","Eritrea","Estland","Fidschi-Inseln","Französisch Guyana","Französisch Polynesien","Gabun","Gambia","Georgien","Ghana","Grenada","Griechenland","Griechische Inseln (zu GR)","Guadeloupe","Guam","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Hawaii (zu USA)","Honduras","Hong Kong (zu China)","Indien","Indonesien","Irak","Iran","Isla Margarita (zu Venezuela)","Israel","Italien","Jamaika","Japan","Java (zu Indonesien)","Jemen","Jordanien","Jungferninseln (brit. USA)","Kambodscha","Kamerun","Kanada","Kanarische Inseln  (zu Spanien)","Kap Verde","Kasachstan","Kenia","Kirgisistan","Kiribati","Kolumbien","Komoren","Kongo, Rep. (Brazzaville)","Kongo, Dem. Rep. (Zaire)","Korea, Nord-","Korea, Süd-","Korsika (zu F)","Kreta (zu GR)","Kroatien","Kuba","Kuwait","Laos","Lesotho","Lettland","Libanon","Liberia","Libyen","Litauen","Macao","Madagaskar","Madeira (zu Portugal)","Malawi","Malaysia","Malediven","Mali","Malta","Marokko","Martinique","Mauretanien","Mauritius","Mayotte (zu F)","Mazedonien","Mexico","Mikronesien","Moldawien","Mongolei","Montenegro (zu YU)","Montserrat","Mozambique","Myanmar (Burma)","Namibia","Nauru","Nepal","Neu Caledonien","Neuseeland","Nicaragua","Niederlande","Niederl. Antillen","Niger","Nigeria","Niue","Nord-Korea","Nord-Marianen","Oman","Oster-Insel (zu Chile)","Pakistan","Palästinensische Gebiete","Palau","Panama","Papua-Neu Guinea","Paraguay","Peru","Philippinen","Pitcairn","Polen","Portugal","Puerto Rico (zu USA)","Qatar","Reunion (zu F)","Ruanda","Rumänien","Rußland","Samoa","San Andres (zu Kolumbien)","San Marino (s. Italien)","Sao Tomé Principe","Sardinien (zu I)","Saudi-Arabien","Schweden","Senegal","Serbien (zu YU)","Seychellen","Sierra Leone","Simbabwe","Singapur","Sizilien (zu I)","Slowakei","Slowenien","Solomon Inseln","Somalia","Spanien","Sri Lanka","St. Helena (zu GB)","St. Kitts Nevis","St. Lucia","St. Vincent Grenadinen","Südafrika","Sudan","Süd-Korea","Sulawesi (zu Indonesien)","Sumatra (zu Indonesien)","Surinam","Swaziland","Syrien","Tadschikistan","Taiwan","Tanzania","Thailand","Tibet (zu China)","Togo","Tokelau-Inseln (zu Neuseeland)","Tonga","Trinidad Tobago","Tschad","Tschechische Republik","Tunesien","Türkei","Turkmenistan","Tuvalu","Uganda","Ukraine","Ungarn","Uruguay","USA","Usbekistan","Vanuatu","Venezuela","Vereinigte Arabische Emirate","Vietnam","Wake Island","Weihnachts-Insel (zu AUS)","Weißrußland","Zaire (Kongo, Dem. Rep.)","Zambia","Zanzibar Pemba (zu Tanzania)","Zentralafrikanische Republik","Zimbabwe","Zypern");  //MISSING
$WebServerAddress = 'www.mallorca-finca-reisen.de';

// added by Fuga A.V. 15-07-07
$TXTTopMenu_Login = 'Anmelden';
$TXTTopMenu_RememberPassword = 'Passwort vergessen';
$TXTTopMenu_Registration = 'Registrieren';
$TXTTopMenu_ChangeProfile = 'Profil ändern';
$TXTTopMenu_ChangePassword = 'Passwort ändern';
$TXTTopMenu_Subscriptions = 'Newsletter-Anmeldungen';
$TXTTopMenu_DeleteAccount = 'Profil löschen';
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
$TXTChange_password_page_title = 'Passwort ändern';
$TXTThanks_change_password_form_title = 'Passwort ändern';

$TXTTerms_Title = 'Nutzungsbedingungen';
$TXTTerms_Text = 'Hier haben Sie Platz zur Darstellung Ihrer Nutzungsbedingungen.<br><br>
Wenn Sie diese Seite nicht mehr anzeigen möchten, gehen Sie in mail to date unter <i>Verwaltung -> Einstellungen Service Center</i> in das Menü  <i>Inhalte</i> und deaktivieren Sie den Schalter <i>Nutzungsbedingungen</i>  .<br><br>
Um Ihre Nutzungsbedingungen oder einen anderen Text einzugeben, gehen Sie in mail to date unter <i>Verwaltung -> Einstellungen Service Center</i> in das Menü <i>Texte</i>. <br><br>
Wählen Sie hier den Eintrag <i>Nutzungebedingungen (ausführlicher Text)</i> zur Eingabe des Seiteninhalts und  <i>Nutzungsbedingungen (Titel)</i>  zur Eingabe der Überschrift.<br>';

$TXTImprint_Title = 'AGBs';
$TXTImprint_Text = '<b>1. Buchung/Umbuchung: </b> Sie erhalten die schriftliche Buchungsbestätigung die für ihre Wirksamkeit von Ihnen unterschrieben zurückgesendet wird. Der Unterzeichnende verpflichtet sich durch seine Unterschrift auch im Namen aller Teilnehmer, für sämtliche Vertragsverpflichtungen gemäß der Mietbedingungen einzustehen. Grundlage des Vertrages sind ausschließlich die am Buchungstag und für den Reisezeitraum gültigen Angaben der Hausbeschreibung. Die Unterkünfte dürfen nicht von mehr Personen als angemeldet bewohnt werden. Ist eine Umbuchung aufgrund Reisetermin, Domizil und/oder Anzahl der Teilnehmer notwendig, kann eine Umbuchungsgebühr von € 40.-  
fällig werden. Ist die Umbuchung nicht mehr möglich, muss eine Neuanmeldung zu den o.g. Konditionen erfolgen. Die Angaben in der Buchungsbestätigung sind Umfang der vertraglichen Leistungen. Nebenabreden sind nur in schriftlicher Form und mit ausdrücklicher schriftlicher Bestätigung gültig. Der Newsletter ist ein exklusiver Service für die Kunden, der Firma Life & Art GmbH. Er informiert über die aktuellsten Angebote aus unserem Finca-Programm. Der Newsletter wird automatisch mit der Buchung abboniert. Wenn Sie den Newsletter-Service abmelden möchten, können Sie dies über den Abmelde-Link mit dem nächsten Newsletter tun. <br><br>
<b>2. Bezahlung: </b> Falls in der Buchungsbestätigung nicht anders vereinbart: 25% der Gesamtsumme fällig binnen 10 Tagen nach Erhalt der Buchungsbestätigung. Über die geleistete Anzahlung erhalten Sie keine gesonderte Bestätigung.
Die Restzahlung erfolgt bis spätestens 4 Wochen vor Anreise, ohne weitere Aufforderung. Die abschließende Reisebestätigung erhalten Sie ca. 1 Woche vor Anreisedatum. Nichtzahlungen oder verspätete Zahlungen gelten als Rücktritt und berechtigen Life & Art GmbH die Unterkunft anderweitig zu vermieten. <br><br>
<b>3. Rücktritt/Storno: </b> Rücktritts- bzw Stornogebühren werden in Höhe von 25% bis 90 Tage vor Anreisedatum, 35% zwischen 90 und 60 Tagen und 50% von 60 - 30 Tagen vor Anreise/Mietbeginn fällig. Ab dem 30. Tag vor Anreise/Mietbeginn wird der Gesamtbetrag fällig. Bitte beachten Sie, dass auch eine unverschuldete Absage als Rücktritt gilt. Rücktrittskosten werden abhängig vom Tage des Posteingangs berechnet. <br><br>
<b>4. Leistungen: </b> Bei den von Life & Art GmbH angebotenen Leistungen handelt es sich ausschließlich um die Vermittlung von Fremdleistungen zwischen dem Unterzeichnenden, den Mitreisenden und der jeweiligen Vertragspartei. Alle Schadensersatzansprüche des Unterzeichners -nachfolgend Mieter genannt-  sind an den jeweiligen Eigentümer zu stellen. Der Vertrag wird im Namen und für Rechnung des Leistungsträgers: Eigentümer, Vermieter oder Verwalter - nachfolgend Eigentümer genannt - abgeschlossen. Er gilt für den angemeldeten Zeitraum und die angemeldete Zahl von Personen und Haustieren. Wir empfehlen den Abschluss eines Versicherungspakets (Reiserücktritts- , Reisegepäck- und Reiseunfallversicherung). <br><br>
<b>5. Haftung: </b> Die Ausschreibung wurde nach bestem Wissen und nach den Angaben des Eigentümers erstellt. Für eine Beeinflussung des Mietobjektes durch höhere Gewalt, wie z.B. Streik, Krieg, Erdbeben, landesübliche Strom- und Wasserausfälle, Unwetterlagen wird nicht gehaftet. Ebenfalls haften wir nicht für eine ständige Bereitschaft von Installationen wie Zentralheizung, Pool etc., sowie für Lärmbelästigung durch Bautätigkeiten auf Nachbargrundstücken ohne zeitliche Begrenzung. Ist die Nutzung des Mietobjektes auf Grund höherer Gewalt nicht möglich und kein Ersatzobjekt vermittelbar, so wird die Haftung auf maximal die Höhe der vereinbarten Restzahlung beschränkt. Eine Haftung für vorübergehende Störungen in der Wasser/ - Stromversorgung oder Störungen durch naturbedingte oder örtliche Begebenheiten wird ausgeschlossen. <br><br>
<b>6. Mitwirkungspflicht: </b> Bei eventuell auftretenden Leistungsstörungen ist der Kunde verpflichtet, im Rahmen der gesetzlichen Bestimmungen alles zu tun, um zu einer Behebung der Störung beizutragen und den eventuell entstandenen Schaden gering zu halten. Der Mieter ist aufgefordert bei Ankunft das Inventar des Mietobjektes zu überprüfen und innerhalb von 24 Stunden dem Eigentümer Mängel zu melden, damit Abhilfe geleistet werden kann. Auch alle sonstigen Beanstandungen an der Mietsache müssen unverzüglich dem Eigentümer gemeldet werden. Der Mieter hat alle während seiner Aufenthaltsdauer verursachten Schäden dem Eigentümer zu melden und die Unterkunft nebst Inventar pfleglich zu behandeln
Die gemietete Unterkunft ist sauber, d.h. besen- und schrankrein zu hinterlassen. <br><br> 
<b>7. Anreise/Abreise: </b> Das Mietobjekt kann  am Anreisetag ab ca. 14:00 Uhr bezogen werden; am Abreisetag verlässt der Mieter das Haus bis spätestens 10:00 Uhr. Sollte der Mieter das Objekt am Abreisetag länger bewohnen wollen, muss er dies vor Ort mit dem Vermieter bzw. dessen Vertreter vereinbaren. <br><br>
<b>8. Haustiere: </b>Das Mitbringen von Haustieren bedarf der schriftlichen Genehmigung des Eigentümers. Der Mieter haftet für sämtliche vom Tier verursachten Schäden. In jedem Fall wird eine Kautionshinterlegung von € 150,- bei der Vermittlerin vereinbart, die nach dem Aufenthalt zurückerstattet werden. <br><br>
<b>9. Gerichtsstand: </b> Alle Schadensersatzansprüche des Reisenden sind an den jeweiligen Eigentümer, Vermieter oder Verwalter zu stellen. Erfüllungsort und Gerichtsstand ist der jeweilige Ort der Liegenschaft bzw. der Wohnort des Eigentümers, Vermieters oder Verwalters. <br><br>
<b>10. Sonstiges: </b> Sämtliche Erklärungen des Kunden hinsichtlich Umbuchung, Terminänderung oder Rücktritt haben schriftlich zu erfolgen und bedürfen zu ihrer Wirksamkeit der schriftlichen Bestätigung durch Life & Art GmbH.	
';

$TXTSubscriptions_Title = 'Newsletter-Anmeldung';
$TXTSubscriptions_Text = 'Sie haben sich für die folgenden Newsletter angemeldet: ';
$TXTSubscriptions_Text_future = 'Sie melden sich für folgene Newsletter an:';
$TXTSubscriptions_only_one_variant_text = 'Sie haben sich für den folgenden Newsletter angemeldet: ';
$TXTSubscriptions_only_one_variant_text_future = 'Sie melden sich für folgende(n) Newsletter an: ';
$TXTSubscriptions_nothing = 'Sie haben sich für keinen Newsletter angemeldet.';

$TXTConfirm_DeleteTitle =  'Newsletter abmelden'; 
$TXTConfirm_Delete = 'Möchten Sie  Ihren Account wirklich löschen?';
$Confirm_delete_yes_button_caption = 'Ja, bitte löschen';
$Confirm_delete_no_button_caption = 'Nein, bitte nicht löschen';

$TXTChange_password_Title = 'Passwort ändern';
$TXTChange_password_Text = 'Sie können hier Ihr derzeitiges Passwort abändern, indem sie das derzeitige und anschließend zwei mal das neue Passwort eintragen: ';
$TXTOld_password = 'Altes Passwort:';
$TXTNew_password = 'Neues Passwort:';
$TXTNew_password_confirm = 'Neues Passwort wiederholen:';
$Confirm_password_button_text = 'Änderung durchführen';
$TXTChange_password_error1 = '<h3 style=\'color: red;\'>Sie haben das alte Passwort ist falsch eingetragen!</h3>';
$TXTChange_password_error2 = '<h3 style=\'color: red;\'>Sie müssen ein neues Passwort angeben!</h3>';
$TXTChange_password_error3 = '<h3 style=\'color: red;\'>Die beiden neuen Passwort-Eingaben stimmen nicht überein. </h3>';

$TXTThanks_change_password_form_header = 'Passwort geändert';
$TXTThanks_change_password_form_text = 'Das Passwort wurde erfolgreich abgeändert. ';
$AccountCreatedChanged = 'Profil zuletzt geändert:';
$BackToStartpageText = 'zum Startmenü';


?>
