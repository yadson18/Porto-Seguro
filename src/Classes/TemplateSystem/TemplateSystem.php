<?php 
  class TemplateSystem{
    use Html;

    private static $templateToLoad;
    private static $instance;
    private static $sessionData;

    public function getData($index){
      if(Session::getCurrent()){
        if(array_key_exists($index, Session::getCurrent())){
          return $_SESSION[Session::getId()][$index];
        }
      }
      return false;
    }

    public function fetchAll(){ 
      if(is_file(self::getTemplate())){
        ob_start();
        $this_ = $this;
        include self::getTemplate();
        return ob_get_clean();
      }
    } 

    public static function setTemplate($template){
      self::$templateToLoad = "src/View/{$template}.php";
    }

    public static function getTemplate(){
      return self::$templateToLoad;
    }

    public static function classExists($controller, $method, $requestData, $template = null){
        if(class_exists("{$controller}")){
          if(strcmp($controller, "Controller") != 0){
            self::$instance = new $controller($requestData);
            if(is_callable([self::$instance, $method])){
              $value = self::$instance->$method();
              if(!empty($value)){
                if(isset($value["redirectTo"])){
                  header("Location: " . $value["redirectTo"]);
                }
                else{
                  $view = explode("Controller", $controller);
                  self::setTemplate("{$view[0]}/{$method}");
                }
              }
              else{
                $view = explode("Controller", $controller);
                self::setTemplate("{$view[0]}/{$method}");
              }
            }
          }
        else if(
          (strcmp($controller, "Controller") == 0) && 
          (strcmp($method, "index") == 0)
        ){
          $values = explode("/", $template);  
          $controller = "{$values[0]}Controller";
          $method = $values[1];
          self::$instance = new $controller($requestData);
          if(is_callable([self::$instance, $method])){
            self::$instance->$method();
            self::setTemplate($template);
          }

        }
        else{
          self::setTemplate(null);
          echo "Erro, Controller ou View não encontrada.";
          exit();
        }
        return true;
      }
      return false;
    }

    public static function requestMethodIs($requestMethod){
      if(strcmp($_SERVER['REQUEST_METHOD'], $requestMethod) == 0){
        return true;
      }
      return false;
    }

    public function loadTemplate($template){
      if (is_file($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])) {
        include $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
      } 
      else{
        $uri = $_SERVER['REQUEST_URI'];
        $args = explode('/', substr($uri, 1));
        $controller = array_shift($args);
        $method = array_shift($args);
        if(is_null($controller)){
          $controller = '';
        }
        $controller = ucfirst($controller) . 'Controller';
        if(is_null($method) || $method == ''){
          $method = 'index';
        }
        if(self::requestMethodIs("POST")){
          self::$instance = NULL;
          $requestData = (object) $_POST;
          
          if(!self::classExists($controller, $method, $requestData)){
            echo "Erro, método POST, Controller ou View não encontrada.";
          }
        }
        else{
          $requestData = (object) $_GET;
          self::$instance = NULL;
          if(!self::classExists($controller, $method, $requestData, $template)){
            echo "Erro, método GET, Controller ou View não encontrada.";
          }
          $this_ = $this;
          include "src/View/Default/default.php";         
          exit();
          call_user_func_array(array(self::$instance, $method), $args);
        }
      }
    }
  }
?>