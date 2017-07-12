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

		public static function getInstance(){
			if(!isset(self::$connection)){
				self::$connection = new WebService();
			}
			return self::$connection;
		}

		public function getConnection($refer = "", $usecookie = false){
			if($usecookie){
				if(file_exists($usecookie)){
					if(!is_writable($usecookie)){
						return "Can't write";
					}
				}
			}
			else{
				if($usecookie === true){
					$usecookie = "cookie.txt";
					if(!touch($usecookie)){
						return "Can't write";
					}
				}

			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, self::$ws['conn']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
			if($usecookie){
				curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);
			}
			if($refer != ""){
				curl_setopt($ch, CURLOPT_REFERER, $refer);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			return $ch;
		}

		public function request($post, $module = "login"){
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

			$ch = $this->getConnection('', self::$ws['cookie']);
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
		        "mod" => "Upload", 
		        "path" => "eguarda/php/",
		        "file" => "@".$meta['uri'].";type=".mime_content_type($meta['uri'])
		    ];

		    echo $post["file"];

		    if($recipient){
		    	$post['recipient'] = $recipient;
		    }
		    $res = json_decode($this->request($user), true);
		    $res2 = json_decode($this->request($post, "Upload"), true);
		    fclose($file);

		    echo "<pre>";
		    var_dump($res2);
		    echo "</pre>";
		}	
	}
?>