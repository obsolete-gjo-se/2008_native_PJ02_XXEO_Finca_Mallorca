<html>
<head>
  <title>Formular</title>
</head>
<body>

<?php 
	$kartenzahlok = true;
	
	if (isset ($_GET ['submit']))  {
	  $ausgabe = '';
	  $fehler = '';
	  if (isset ($_GET['anzahl']) && !is_array($_GET['anzahl']) && $_GET['anzahl'] != '')  {
	    $ausgabe .= 'Anzahl Karten: ' . htmlspecialchars ($_GET['anzahl']) . "\n";
	  } else {
	    $fehler .= 'Keine Karten ausgew&auml;hlt ! <br />';
		$kartenzahlok = false;
	  }
	  if (isset ($_GET['sitztyp']) && !is_array($_GET['sitztyp']) && $_GET['sitztyp'] != '')  {
	    $ausgabe .= 'Art des Platzes: ' . htmlspecialchars ($_GET['sitztyp']) . "\n";
	  } else {
	    $fehler .= 'Kein Platz ausgew&auml;hlt ! <br />';
	  }
	  if (isset ($_GET['posi']) && is_array($_GET['posi']) && count($_GET['posi']) > 0)  {
	    $ausgabe .= 'Ort des Platzes: ' . htmlspecialchars (implode(' ', $_GET['posi'])) . "\n";
	  } else {
	    $fehler .= 'Kein Ort ausgew&auml;hlt ! <br />';
	  }
	  if (isset ($_GET['zahlung']) && !is_array($_GET['zahlung']) && $_GET['zahlung'] != '')  {
	    $ausgabe .= 'Art Zahlung: ' . htmlspecialchars ($_GET['zahlung']) . "\n";
	  } else {
	    $fehler .= 'Keine Zahlart ausgew&auml;hlt ! <br />';
	  }
	  if (isset ($_GET['agb']) && !is_array($_GET['agb']) && $_GET['agb'] == 'ok')  {
	    $ausgabe .= 'AGB ok: ' . htmlspecialchars ($_GET['agb']) . "\n";
	  } else {
	    $fehler .= 'AGB´s nicht akzeptiert ! <br />';
	  }
	  if ($fehler == '') {
	  	mail('info@n-28.com', 'Daten aus Web', $ausgabe);
	    echo '<b>Vielen Dank f&uuml;r Ihre Angaben</b>' . '<br />' . '</body></html>';
		exit();
	  } else {
	  	echo "<b>$fehler</b>";
	  }
	}
	
?>

  <h2>Welche Tickets?</h2>
<form action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']);?>" method="get">
  <input type="text" name="anzahl" size="2" value=
  "<?php 
	  if (isset ($_GET['anzahl']) && !is_array($_GET['anzahl']) && $_GET['anzahl'] != '')  {
	    echo htmlspecialchars ($_GET ['anzahl']);
		}
  ?>"/>Zahl der Karten
  <?php 
  	if (!$kartenzahlok){
    echo '<span style="color:red">*</span>';
	}
  ?>
  <br />
  <input type="radio" name="sitztyp" value="sitzpl"
  <?php 
  	if (isset ($_GET ['sitztyp']) && $_GET['sitztyp'] == 'sitzpl') {
	  echo 'checked="checked" ';
	}
  ?>/>Sitzplatz oder
  <input type="radio" name="sitztyp" value="stehpl"
  <?php 
  	if (isset ($_GET ['sitztyp']) && $_GET['sitztyp'] == 'stehpl') {
	  echo 'checked="checked" ';
	}
  ?>  />Stehplatz<br />
  Bevorzugte Position
  <select name="posi[]" multiple="multiple" size="3">
    <option value="nord"
    <?php 
  	if (isset ($_GET ['posi']) && is_array($_GET['posi']) && in_array('nord',$_GET['posi'])) {
	  echo 'selected="selected" ';
	}
	?>
    >Nordkurve</option>
    <option value="trib"
    <?php 
  	if (isset ($_GET ['posi']) && is_array($_GET['posi']) && in_array('trib',$_GET['posi'])) {
	  echo 'selected="selected" ';
	}
	?>
    >Trib&uuml;ne</option>
    <option value="sued"
    <?php 
  	if (isset ($_GET ['posi']) && is_array($_GET['posi']) && in_array('sued',$_GET['posi'])) {
	  echo 'selected="selected" ';
	}
	?>
    >S&uuml;dkurve</option>
  </select><br />
  Zahlungsart
  <select name="zahlung">
    <option value="">--bitte Ausw&auml;hlen--</option>
    <option value="cc"
    <?php 
  	if (isset ($_GET ['zahlung']) && $_GET['zahlung'] == 'cc') {
	  echo 'selected="selected" ';
	}
	?>
    >Kreditkarte</option>
    <option value="bar"
    <?php 
  	if (isset ($_GET ['zahlung']) && $_GET['zahlung'] == 'bar') {
	  echo 'selected="selected" ';
	}
	?>
    >bar bei Abholung</option>
    <option value="teller"
    <?php 
  	if (isset ($_GET ['zahlung']) && $_GET['zahlung'] == 'teller') {
	  echo 'selected="selected" ';
	}
	?>
    >Tellerw&auml;sche</option>
  </select><br />
  <input type="checkbox" name="agb" value="ok"
  <?php 
  	if (isset ($_GET ['agb']) && $_GET['agb'] == 'ok') {
	  echo 'checked="checked"';
	}
  ?>
  />Ich akzeptiere die AGB!<br />
  <input type="submit" name="submit" value="Versenden" />
</form>
</body>
</html>
