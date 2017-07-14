<?php  
	class AverbePortoController extends Controller{
		public function index(){
			$this->serializeData(["Title" => "Início"]);
		}

		public function sendFile(){
			if($this->requestMethodIs("POST")){
				var_dump($_FILES);
	            /*$file = tmpfile();
	            fwrite($file, file_get_contents($_FILES['file']['name']));
	            rewind($file);
	            $meta = stream_get_meta_data($file);

	            $upload = [
	                'cookie' => getCookie(),
	                'file' => '@'.$fileName = $meta['uri'].';type='.mime_content_type($fileName = $meta['uri']),
	                'comp' => 5,
	                'mod' => 'Upload',
	                'path' => 'eguarda/php/',
	                'recipient' => ''
	            ];

	            echo "<pre>";
	            var_dump($upload);
	            var_dump(postRequest($upload, true));
	            echo "</pre>";

	            fclose($file);*/
            	//unlink('cookie.txt');	
			}
			$this->serializeData(["Title" => "Enviar Arqivo"]);
		}
	}
?>