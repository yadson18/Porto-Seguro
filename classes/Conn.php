<?php  
	class Conn{
		public $ws;

		public function __construct(){
			$this->ws = [
				'comp' => 5,
				'conn' => 'http://averbeporto.com.br/websys/php/conn.php',
			    'cookie' => tempnam(sys_get_temp_dir(), 'eg_')
			];
		}

		public function getConnection($refer = '', $useCookie = false){
			if($useCookie){
				if(file_exists($useCookie)){
					if(!is_writable($useCookie)){
						return "Can't write on file.";
					}
				}
				else{
					if($useCookie === true){
						$useCookie = $_SERVER['DOCUMENT_ROOT'].'/files/cookie.txt';
					}
					if(!touch($useCookie)){
						return "Can't write on file.";
					}
				}
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->ws['conn']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)');
			if($useCookie){
				curl_setopt($ch, CURLOPT_COOKIEJAR, $useCookie);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $useCookie);
			}
			if($refer != ''){
				curl_setopt($ch, CURLOPT_REFERER, $refer);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			return $ch;
		}

		public function request($post, $module = 'login'){
			if(!isset($post['comp'])){
				$post['comp'] = $this->ws['comp'];
			}
			if(!isset($post['path'])){
				$post['path'] = $this->ws['path'];
			}
			elseif($post['path'] === ''){
				unset($post['path']);
			}
			$post['mod'] = $module;

			$ch = $this->getConnection('', $this->ws['cookie']);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

			$resonse = curl_exec($ch);
			curl_close($ch);

			return $resonse;
		}

		public function sendFile($fileContent, $user, $recipient = ''){
			$fileTypes = ["/xml", "/zip"];

			$file = tmpfile();
		    fwrite($file, $fileContent);
		    rewind($file);
		    $meta = stream_get_meta_data($file);

		    $post = [
		        'file' => '@'.$fileName = $meta['uri'].';type='.mime_content_type($fileName = $meta['uri']),
		        'path' => 'eguarda/php/'
		    ];

		    if($recipient){
		    	$post['recipient'] = $recipient;
		    }

  			$type = strrchr(mime_content_type($meta['uri']), '/');
		    fclose($file);
		    if(in_array($type, $fileTypes) === true){
			    $user = decode($this->request($user));

			    if(isset($user["C"]["userName"]) && $user["C"]["userName"]){
			    	$response = decode($this->request($post, "Upload"), true);
			    	
			    	return $response;
			    }
			    return false;
		    }
		    else{
		    	header("Location: ../home.php");
		    }	    
		}	
	}
?>