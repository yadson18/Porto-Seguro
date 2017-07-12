<?php 
	session_start();

	require_once "../functions.php";
	require_once "../classes/WebService.php";

	$ws = WebService::getInstance(["cookie" => true]);
	$values = [
		"user" => $_POST["userName"],
		"pass" => $_POST["userPassword"],
		"path" => ""
	];
	$result = decode($ws->request($values));

	if(isset($result["success"])){
		if(isset($result["logout"]) && $result["logout"]){
			header("Location: ../index.php");
		}
		elseif(isset($result["C"]["userName"]) && $result["C"]["userName"]){
			$_SESSION["loggedUser"] = $values;
			header("Location: ../home.php");
		}
		else{
			echo "Ocorreu um erro";
		}
	}
?>