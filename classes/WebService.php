<?php  
	class WebService{
		private static $ws;
		private static $connection;

		private function __construct(){
			self::$ws = [
				'comp' => 5,
				'conn' => 'http://averbeporto.com.br/websys/php/conn.php',
			    'cookie' => tempnam(sys_get_temp_dir(), 'eg_')
    		];
		}

		public static function getInstance($useCookie){
			if(!isset(self::$connection)){
				self::$connection = new WebService();
				if(is_array($useCookie)){
					if(isset($useCookie["cookie"]) && is_bool($useCookie["cookie"])){
						self::useCookie($useCookie["cookie"]);
					}
				}
			}
			return self::$connection;
		}

		public static function useCookie($cookie){
			if(is_bool($cookie)){
				if($cookie === true){
					$useCookie = $_SERVER["DOCUMENT_ROOT"]."/files/cookie.txt";

					if(file_exists($useCookie)){
						if(!is_writable($useCookie)){
							return "Não é possível escrever no arquivo cookie.txt, mude a permissão para 777 ou remova apenas leitura no Windows";
						}
					}
					else{
						if(!touch($useCookie)){
							return "Não é possível escrever no arquivo cookie.txt, mude a permissão para 777 ou remova apenas leitura no Windows";
						}
						else{
							if(!is_writable($useCookie)){
								return "Não é possível escrever no arquivo cookie.txt, mude a permissão para 777 ou remova apenas leitura no Windows";
							}
						}
					}
					self::$ws["cookie"] = $useCookie;
					return true;
				}
				return false;
			}
		}

		public function getConnection($refer = ""){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, self::$ws['conn']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
			if(self::$ws['cookie'] === $_SERVER["DOCUMENT_ROOT"]."/files/cookie.txt"){
				curl_setopt($ch, CURLOPT_COOKIEJAR, self::$ws['cookie']);
				curl_setopt($ch, CURLOPT_COOKIEFILE, self::$ws['cookie']);
				var_dump(file_get_contents(self::$ws["cookie"]));
			}
			if(self::$ws['cookie'] !== $_SERVER["DOCUMENT_ROOT"]."/files/cookie.txt"){
				curl_setopt($ch, CURLOPT_COOKIEJAR, self::$ws['cookie']);
				curl_setopt($ch, CURLOPT_COOKIEFILE, self::$ws['cookie']);
			}
			if($refer != ""){
				curl_setopt($ch, CURLOPT_REFERER, $refer);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			return $ch;
		}

		public function request($conn, $post, $module = "login"){
			if(!isset($post['comp'])){
				$post['comp'] = self::$ws['comp'];
			}
			if(!isset($post['path'])){
				$post['path'] = self::$ws['path'];
			}
			elseif($post['path'] === ''){
				unset($post['path']);
			}
			$post['mod'] = $module;

			$ch = $this->getConnection('');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

			$res = curl_exec($ch);
			curl_close($ch);

			return $res;
		}

		public function sendFile($fileContent, $user, $recipient = ""){
			$file = tmpfile();
		    fwrite($file, $fileContent);
		    rewind($file);
		    $meta = stream_get_meta_data($file);


		    $post = [
		        'file' => '@'.$fileName = $meta['uri'].';type='.mime_content_type($fileName = $meta['uri']),
		        'path' => 'eguarda/php/',
		        'Cookie' => 'a'
		    ];

		    if($recipient){
		    	$post['recipient'] = $recipient;
		    }

		    $user = decode($this->request($user));

		    if(isset($user["C"]["userName"]) && $user["C"]["userName"]){
		    	$response = decode($this->request($post, "Upload"), true);
		    	
		    	return $response;
		    }
		    fclose($file);
		    
		    return false;
		}	
	}
?>