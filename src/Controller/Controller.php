<?php  
	session_start();
	
	class Controller{
		private $webservice;

		use Session;
		use Flash;

		public function __construct(){
			$this->webservice = new Webservice();
		}

		public function getWsConnection(){
			return $this->webservice;
		}

		public function redirectTo($url){
			if(is_array($url)){
				if(sizeof($url) == 1){
					return ["redirectTo" => "/{$url['controller']}/index"];
				}
				return ["redirectTo" => "/{$url['controller']}/{$url['view']}"];
			}
			return false;
		}

		public function requestMethodIs($requestMethod){
	      if(strcmp($_SERVER['REQUEST_METHOD'], $requestMethod) == 0){
	        return true;
	      }
	      return false;
	    }

	   	public function serializeData($data){
	   		if(is_array($data)){
	   			if($this->saveData($data)){
	   				return true;
	   			}
	   			return false;
	   		}
	   		return false;
	    }

	    public function save($connection, $table, $values){
	    	$columns = array();
	    	$postValues = array();

	    	foreach($values as $index => $value){
	    		array_push($columns, strtoupper($index));
	    		array_push($postValues, replace($_POST[$index]));
	    	}

	    	$saved = $connection->insert($table, $columns, $postValues);

	    	if(!empty($saved)){
	    		return true;
	    	}
	    	return false;
	    }
	}
?>