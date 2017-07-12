<?php 
	session_start();

	require_once "../functions.php";
	require_once "../classes/WebService.php";
	 
  	$file = $_FILES['file']['tmp_name']; 
  	$sizeFile = $_FILES['file']['size']; 
  	$typeFile = $_FILES['file']['type']; 
  	$fileName = $_FILES['file']['name']; 


  	$fpFile = fopen($file, "rb");
  	$content = fread($fpFile, $sizeFile);
  	fclose($fpFile);

  	$ws = WebService::getInstance();
	$values = [
		"user" => $_POST["userName"],
		"pass" => $_POST["userPassword"],
		"path" => ""
	];
	$ws->sendFile($content, $_SESSION["loggedUser"]);
?>