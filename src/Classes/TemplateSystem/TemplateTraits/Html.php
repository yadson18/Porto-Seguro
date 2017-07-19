<?php  
	trait Html{
		public function script($scriptName){
      		echo "<script type='text/javascript' src='/webroot/js/$scriptName'></script>";
    	}

    	public function css($cssName){
      		echo "<link rel='stylesheet' type='text/css' href='/webroot/css/$cssName'>";
    	}

        public function daniedAccess($message){
            ob_start();
            include "src/View/FlashMessageTemplates/daniedAccess.php";
            echo ob_get_clean();
        }
	}
?>