<?php
    class Webservice{
        public function cookie(){
            $cookie = "webroot/files/cookie.txt";
            
            if(is_file($cookie)){
                if(is_writable($cookie)){
                    return true;
                }
                return false;
            }
            else{
                if(touch($cookie)){
                    if(is_writable($cookie)){
                        return true;
                    }
                    return false;
                }
                return false;
            }
        }

        public function getCookie(){
            return substr(strrchr(file_get_contents("webroot/files/cookie.txt"), 'portal[ses]'), 12, 32);
        }

        public function connection($useCookie){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://averbeporto.com.br/websys/php/conn.php");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
            if($useCookie === true){
                if($this->cookie()){
                    curl_setopt($ch, CURLOPT_COOKIEJAR, "webroot/files/cookie.txt");
                    curl_setopt($ch, CURLOPT_COOKIEFILE, "webroot/files/cookie.txt");
                }
                else{
                    $cookie = tempnam(sys_get_temp_dir(), "eg_");
                    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
                }
            }
            curl_setopt($ch, CURLOPT_REFERER, "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            return $ch;
        }

        public function postRequest($post, $useCookie){
            if(is_bool($useCookie)){
                $connection = $this->connection($useCookie);
            }

            curl_setopt($connection, CURLOPT_POST, 1);
            curl_setopt($connection, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($connection);
            curl_close($connection);

            return json_decode($response, true);
        }

        public static function deleteCookie(){
            unlink("webroot/files/cookie.txt");   
        }
    }
?>