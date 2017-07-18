<?php  
	class AverbePortoController extends Controller{
		public static function authorized($method){
			$methods = ["index", "sendFile"];
			
			if(!empty($methods)){
				if(in_array($method, $methods)){
					return true;
				}
			}
			return false;
		}

		public function index(){
			$this->serializeData(["Title" => "Home"]);
		}

		public function sendFile(){
			if($this->requestMethodIs("POST")){
	            $fileName = $_FILES["file"]["name"];
	            $fileType = $_FILES["file"]["type"];
	            $fileSize = $_FILES["file"]["size"];
	            $file = new CURLFile($fileName, $fileType, "file");

	           	$result = $this->getWsConnection()->postRequest([
	                "file" => $file,
	                "fileSize" => $fileSize,
	                "comp" => 5,
	                "mod" => "Upload",
	                "path" => "eguarda/php/",
	                "recipient" => ""
	            ], true);

	            fclose($file);
	            var_dump($result);
	            if(!empty($result)){
	            	if(isset($result["success"]) && $result["success"] === 1){
	            		if(isset($result["S"]) && !empty($result["S"])){
	            			if($result["S"]["P"] === 1){
	            				$this->flashSuccess("O arquivo foi salvo com sucesso.");
	            			}
	            			elseif($result["S"]["D"] === 1){
	            				$this->flashError("Não foi possível salvar, arquivo pré-existente.");
	            			}
		            		elseif($result["S"]["R"] === 1){
	            				$this->flashError("O arquivo enviado não parece ser do tipo certo.");
	            			}
	            			elseif($result["S"]["N"] === 1){
	            				$this->flashError("O arquivo enviado não é um XML ou ZIP válido.");
	            			}
	            			else{
	            				if(isset($result["error"])){
	            					$this->flashError("XML ou ZIP não encontrado.");
	            				}
	            			}
	            		}
		            	return $this->redirectTo([
		            		"controller" => "AverbePorto", 
		            		"view" => "sendFile"
		            	]);
	            	}
	            	$this->flashError("Ocorreu um erro na comunicação com o Web Service.");
	            	return $this->redirectTo([
	            		"controller" => "AverbePorto", 
	            		"view" => "sendFile"
	            	]);
	            }
	            $this->flashError("Por favor, confira se o arquivo selecionado é XML ou ZIP.");
	            return $this->redirectTo([
	            	"controller" => "AverbePorto", 
	            	"view" => "sendFile"
	            ]);
			}
			$this->serializeData(["Title" => "Envio de arquivo"]);
		}
	}
?>