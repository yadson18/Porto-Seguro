<?php  
	class UsersController extends Controller{
		public function login(){
			if($this->requestMethodIs("POST")){
				$result = $this->getWsConnection()->postRequest([
					"mod" => "login",
					"comp" => 5,
					"user" => $_POST["usuario"],
					"pass" => $_POST["senha"]
				], true);

				if(isset($result["success"]) && isset($result["C"])){
					if($result["success"] == 1 && !empty($result["C"])){
						$this->isAuthorized();
						$this->serializeData(["User" => $result["C"]]);
						return $this->redirectTo(["controller" => "AverbePorto"]);
					}
				}
				$this->flashError("Usuário ou senha incorreto, tente novamente.");
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}

			$this->serializeData(["Title" => "Login"]);
		}

		public function logout(){
			if($this->requestMethodIs("GET")){
				$this->isNotAuthorized();
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}
		}

		public function isAuthorized(){
			$this->serializeData(["Logged" => true]);
		}


		public function isNotAuthorized(){
			$this->sessionDestroy();
		}

		public static function checkLoggedUser(){
			if(isset($_SESSION["logged"])){
				if($_SESSION["logged"] === false){
					self::isNotAuthorized();
				}
			}
			else{
				self::isNotAuthorized();
			}
		}
	}
?>