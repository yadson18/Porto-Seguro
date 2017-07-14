<?php  
	class AverbePortoController extends Controller{
		public function index(){
			$this->serializeData(["Title" => "Início"]);
		}

		public function sendFile(){
			if($this->requestMethodIs("POST")){
	            $file = tmpfile();
	            fwrite($file, file_get_contents($_FILES['file']['name']));
	            rewind($file);
	            $meta = stream_get_meta_data($file);

	           	$result = $this->getWsConnection()->postRequest([
	                'cookie' => $this->getWsConnection()->getCookie(),
	                'file' => '@'.$fileName = $meta['uri'].';type='.mime_content_type($fileName = $meta['uri']),
	                'comp' => 5,
	                'mod' => 'Upload',
	                'path' => 'eguarda/php/',
	                'recipient' => ''
	            ], true);

	            echo "<pre>";
	            var_dump($result);
	            echo "</pre>";

	            fclose($file);
			}
			$this->serializeData(["Title" => "Enviar Arqivo"]);
		}
	}
?>