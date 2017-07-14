<?php  
	abstract class AutoLoad{
		private static $classPaths = [
			"Classes/Datasource", 
			"Classes/TemplateSystem",
			"Classes/TemplateSystem/TemplateTraits",
			"Classes/Webservice",
			"Controller", 
			"Controller/ControllerTraits"
		];
		private static $rootDir;

		public static function setRootDir(){
			if(
				(strpos("[".$_SERVER['HTTP_USER_AGENT']."]", "Linux")) ||
				(strpos("[".$_SERVER['HTTP_USER_AGENT']."]", "Android"))
			){
			    self::$rootDir = $_SERVER['DOCUMENT_ROOT'] . "/src/";
			}
			else{
			    self::$rootDir = $_SERVER['DOCUMENT_ROOT'] . "Job-Project/src/";
			}
		}

		public static function getRootDir(){
			return self::$rootDir;
		}

		public static function loadClasses(){
			self::setRootDir();
			spl_autoload_register(function($class_name){
				foreach(self::$classPaths as $path){
					if(
						is_file(self::getRootDir() . "{$path}/{$class_name}.php") && 
						file_exists(self::getRootDir() . "{$path}/{$class_name}.php")
					){
						require_once self::getRootDir() . "{$path}/{$class_name}.php";
						break;
					}
				}
			});
		}
	}
?>