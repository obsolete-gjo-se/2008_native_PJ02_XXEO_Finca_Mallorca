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
  include 'includes/mail2date.cfg.'.$SUFFIX;
  $LOG_FILE = 'logs/'.$COUNT_LOG_FILE;

  $query = '';
  if ( isset( $_GET['log'] )) {
    $query = $_GET['log'];
  }
  $timestamp = date("d.m.Y H:i:s", time());

  unlock_file( $COUNT_LOG_FILE, 10 );
  $count = 0;
  while ( test_lock_file( $COUNT_LOG_FILE ) and $count < 10 ) {
    sleep( 1 );
    $count++;
  }

  if ( $count < 10 ) {
    lock_file( $COUNT_LOG_FILE );

    $fp = fopen( $LOG_FILE, "a" );
    $count2 = 0;
    while ( ! $fp and $count2 <= 10 ) {
      $fp = fopen( $LOG_FILE, "a" );
      $count2++;
    }
    my_fputcsv( $fp, array( $timestamp, $query ) );
    #my_fwrite( $fp, $log." ".$url." ".$q."\n" );
    fclose( $fp );
  }

  $filename = 'includes/empty.gif';
  $fh = fopen ($filename, "r");
  $contents = fread ($fh, filesize ($filename));
  fclose ($fh);
  
  print $contents;

  if ( $count < 10 ) { unlock_file( $COUNT_LOG_FILE, 0 ); }

  exit();

?>
