<?php

    if ( file_exists ( 'includes/mail2date.cfg.php'  )) {
    $SUFFIX='php';
  } elseif ( file_exists ( 'includes/mail2date.cfg.php3' ) ) {
    $SUFFIX='php3';
  } elseif ( file_exists ( 'includes/mail2date.cfg.php4' ) ) {
    $SUFFIX='php4';
  } elseif ( file_exists ( 'includes/mail2date.cfg.php5' ) ) {
    $SUFFIX='php5';
  } else {
    exit( 0 );
  }


include( 'includes/functions.'.$SUFFIX );
include( 'includes/mail2date.cfg.'.$SUFFIX );
$LOG_FILE = 'logs/'.$REDIRECT_LOG_FILE;

$url = $_GET['url'];
$q = '';

if ( isset( $_GET['q'] )) {
  $q = $_GET['q'];
}
if ( $url == '' ) {
  echo 0;
  exit( 0 );
}
# Hier noch prüfen, ob url mit http:// anfängt. Ansonsten dranbauen

$timestamp = date("d.m.Y H:i:s", time());
# $log = $timestamp." ".$_GET['log'];

unlock_file( $REDIRECT_LOG_FILE, 10 );
$count = 0;
while ( test_lock_file( $REDIRECT_LOG_FILE ) and $count < 10 ) {
  sleep( 1 );
  $count++;
}

# Falls count == 10, dann ohne Logging weitermachen
if ( $count < 10 ) {
  lock_file( $REDIRECT_LOG_FILE );

  $fp = fopen( $LOG_FILE, "a" );
  $count2 = 0;
  while ( ! $fp and $count2 <= 10 ) {
    $fp = fopen( $LOG_FILE, "a" );
    $count2++;
  }
  my_fputcsv( $fp, array($timestamp, $url, $q) );
  #fwrite( $fp, $log." ".$url." ".$q."\n" );
  fclose( $fp );
}

header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$url);
        
        
if ( $count < 10 ) { unlock_file( $REDIRECT_LOG_FILE, 0 ); }

exit();

?>
