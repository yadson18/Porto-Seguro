<?php 
	session_start();

	require_once "../functions.php";
	require_once "../classes/Conn.php";
	 
  $file = $_FILES['file']['tmp_name']; 
  $sizeFile = $_FILES['file']['size']; 

  $fpFile = fopen($file, "r");
  $content = fread($fpFile, $sizeFile);
  fclose($fpFile);

  $ws = new Conn();
  $values = $ws->sendFile($content, $_SESSION["loggedUser"], "a");

  echo "<pre>";
  var_dump($values);
  echo "</pre>";
?>