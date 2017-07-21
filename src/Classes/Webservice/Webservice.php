<?php
    class Webservice{
        public $cookiePath;

        public function __construct(){
            $this->cookiePath = $_SERVER["DOCUMENT_ROOT"] . "/webroot/files/cookie.txt";
        }

        public function cookie(){
            if(is_file($this->cookiePath)){
                if(is_writable($this->cookiePath)){
                    return true;
                }
                return false;
            }
            else{
                if(touch($this->cookiePath)){
                    if(is_writable($this->cookiePath)){
                        return true;
                    }
                    return false;
                }
                return false;
            }
        }

        public function getCookie(){
            return substr(strrchr(file_get_contents($this->cookiePath), "portal[ses]"), 12, 32);
        }

        public function connection($useCookie){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://averbeporto.com.br/websys/php/conn.php");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
            if($useCookie === true){
                if($this->cookie()){
                    curl_setopt($ch, CURLOPT_COOKIEJAR,  $this->cookiePath);
                    curl_setopt($ch, CURLOPT_COOKIEFILE,  $this->cookiePath);
                }
                else{
                    $this->cookiePath = tempnam(sys_get_temp_dir(), "eg_");
                    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiePath);
                    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiePath);
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

            curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($connection, CURLOPT_POST, 1);
            if(isset($post["file"])){
                curl_setopt($connection, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
                curl_setopt($connection, CURLOPT_INFILESIZE, $post["fileSize"]);
            }
            curl_setopt($connection, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($connection);
            curl_close($connection);

            if($post["mod"] === "Upload"){
                $this->deleteCookie();
            }
            return json_decode($response, true);
        }

        public function deleteCookie(){
            if(is_file($this->cookiePath)){
                unlink($this->cookiePath);   
            }
        }
    }
?>