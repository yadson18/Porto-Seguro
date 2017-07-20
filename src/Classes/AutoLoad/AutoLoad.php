<?php 
	//A classes AutoLoad serve para carregar classes automaticamente no projeto.
	abstract class AutoLoad{
		/* 
		 * Para este atributo, é necessário um array com os diretórios onde encontram-se todas
		 * as classes do projeto a partir do diretório src. 
		 */
		private static $classPaths = [
			"Classes/Datasource", 
			"Classes/TemplateSystem",
			"Classes/TemplateSystem/TemplateTraits",
			"Classes/Webservice",
			"Controller", 
			"Controller/ControllerTraits"
		];
		private static $rootDir;

		/* 
		 * Este método checa o sistema operacional do usuário e salva o diretório onde 
		 * devem ser buscadas as classes, em uma variável estática. 
		 */
		public static function setRootDir(){
			if(
				(strpos("[".$_SERVER['HTTP_USER_AGENT']."]", "Linux")) ||
				(strpos("[".$_SERVER['HTTP_USER_AGENT']."]", "Android")) ||
				(strpos("[".$_SERVER['HTTP_USER_AGENT']."]", "Windows"))
			){
			    self::$rootDir = $_SERVER['DOCUMENT_ROOT'] . "/src/";
			}
			else{
			    self::$rootDir = $_SERVER['DOCUMENT_ROOT'];
			}
		}

		// Este método retorna o diretório onde devem ser carregadas as classes.
		public static function getRootDir(){
			return self::$rootDir;
		}

		// Este método carrega as classes automaticamente quando for necessário.
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