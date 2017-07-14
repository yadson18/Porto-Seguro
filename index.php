<?php
	require_once "functions.php";
	require_once "src/Classes/AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();

	$this_ = new TemplateSystem();
	$this_->loadTemplate("Users/login");
?>