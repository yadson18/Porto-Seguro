<?php  
	function decode($string){
		return json_decode($string, true);
	}

	function encode($array){
		return json_encode($array);
	}

	function debug($data, $type = ""){
		if(empty($type)){
			echo "<pre>";
			var_dump($data);
			echo "</pre>";
		}
		elseif(!is_array($data) && strcmp($type, "decode") === 0){
			echo "<pre>";
			var_dump(decode($data, true));
			echo "</pre>";
		}
		elseif(is_array($data) && strcmp($type, "encode") === 0){
			echo "<pre>";
			var_dump(encode($data)); 
			echo "</pre>";
		}
	}
?>