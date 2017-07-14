<?php
  function replace($value){
    return str_replace([".", "/", "-"], "", $value);
  } 

  function toInteger($value){
    return (int) $value;
  }

  function formatMoney($money){
    $str = str_replace(['.', 'R$', ' '], "", $money);
    
    return (float) number_format(str_replace(',', '.', $str), 1, '.', '');
  }

  function formatDate($stringDate){
    return date('d.m.Y', strtotime($stringDate));
  }

  /*function get_include_contents($filename) {
      if (is_file($filename)) {
          ob_start();
          include $filename;
          return ob_get_clean();
      }
      return false;
  }*/
 /* function redirect($toRedirect){
    header("Location: " . $toRedirect);
  }

  function insertHeader(){
    include "src/View/Default/default.php";
  }

  function actionLink($actionDir, $action){
    return "../../Actions/{$actionDir}/{$action}.php";
  }
*/
  /*session_start();

  function debug($wat) {
    file_put_contents("php://stdout", $wat);
  }
  function url() {
    $args = func_get_args();
    if (count($args) == 0) {
      return '/';
    }
    return '/' . implode('/', $args);
  }

  function setPage($controller, $view){
    $_SESSION['page'] = $controller . "/" . $view;
  }
  function display() {
    ob_start();

    if(!isset($_SESSION['page'])){
      $_SESSION['page'] = "";
    }
    else{
      return "include 'src/View/" . $_SESSION['page'] . "'";
      
    }
  }
  function json($data) {
    echo json_encode($data);
  }
  function redirect() {
    $url = call_user_func_array('url', func_get_args());
    header('Location: ' . $url);
    exit();
  }
  class Utils
  {
    static function trainerPower(Trainer $trainer) {
      return array_reduce($trainer->getMonsters(),
        function($input, $monster) {
          return $input + $monster->poderTotal();
        },
        0
      );
    }
  }*/
?>