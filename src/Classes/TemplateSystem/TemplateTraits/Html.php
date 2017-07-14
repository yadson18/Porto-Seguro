<?php  
	trait Html{
		public function script($scriptName){
      		echo "<script type='text/javascript' src='/webroot/js/$scriptName'></script>";
    	}

    	public function css($cssName){
      		echo "<link rel='stylesheet' type='text/css' href='/webroot/css/$cssName'>";
    	}

    	/*public function input($type, $options){
    		$inputTypes = ["date"];

    		foreach($inputTypes as $types){
    			if(strcmp($types, $type) === 0){
    				$input = "<input type='{$type}' ";
    				foreach($options as $option){
    					$input .= "{$option} ";
    				}
    				return $input;
    			}
    			else{
    				return false;
    			}
    		}
    	}*/
	}
?>