<?php

  function gen_DOpt_email( $receiver, $sendername, $newsletterlist, $anmeldungslink, $url, $passwort ){

    global $SEND_CONFIRM_EMAILS_AS_HTML;
    
    if ( $SEND_CONFIRM_EMAILS_AS_HTML == 1 ) {
       $car_return = '<br>';
       $car_absatz = '<p>';
    } else {
      $car_return = "\n";
      $car_absatz = "\n\n";
    }
    $message = $DOUBLEOPTIN_MSG0.$receiver.$car_return;
    $message .= $DOUBLEOPTIN_MSG1.$sendername.'.';
    $message .= $car_absatz.$DOUBLEOPTIN_MSG2.$car_return;
    $message .= $newsletterlist.$car_absatz;
    $message .= $DOUBLEOPTIN_MSG3;
    $message .= $car_return.$anmeldungslink.$car_absatz;
    $message .= $DOUBLEOPTIN_MSG4.$url.$DOUBLEOPTIN_MSG5.$car_return;
    $message .= $DOUBLEOPTIN_MSG6.$passwort.$DOUBLEOPTIN_MSG7.$car_absatz;
    $message .= $DOUBLEOPTIN_MSG8.$car_absatz;
    $message .= $DOUBLEOPTIN_MSG9.$sendername;

    return $message;
  }

?>
