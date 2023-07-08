<?php

class Controller
{

  function __construct()
  {
    $this->view = new View();
  }

  function loadModel($model)
  {
    $url = 'models/' . $model . 'model.php';

    if (file_exists($url)) {
      require_once $url;

      $modelName = $model . 'Model';
      $this->model = new $modelName();
    }
  }

  //Validar datos por metodo POST

  function existPOST($params)
  {
    foreach ($params as $param) {
      if (!isset($_POST[$param])) {
        error_log("ExistPOST: No existe el parametro $param");
        return false;
      }
    }
    error_log("ExistPOST: Existen parametros");
    return true;
  }

  //Validar si existe un archivo en un formulario 

  function existFile($params)
  {
    foreach ($params as $param) {
      if (!isset($_FILES[$param])) {
        error_log("ExistFile: No existe el parametro $param");
        return false;
      }
    }
    error_log("ExistFile: Existem parametros");
    return true;
  }

  //Validar datos por metodo GET 

  function existGET($params)
  {
    foreach ($params as $param) {
      if (!isset($_GET[$param])) {
        return false;
      }
    }
    return true;
  }

  //Validar datos por metodo JSON 

  function existJson($params)
  {
    foreach ($params as $param) {
      if (!isset($this->inputJson[$param])) {
        error_log("ExistJson: No existe el parametro $param");
        return false;
      }
    }
    error_log("ExistJson: Existen parametros");
    return true;
  }

  function getValueJson($name)
  {
    return $this->inputJson[$name];
  }

  function getFile($name)
  {
    return $_FILES[$name];
  }

  function getGet($name)
  {
    return $_GET[$name];
  }

  function getPost($name)
  {
    return $_POST[$name];
  }

  //Redirige a alguna otra pagina dentro de la aplicacion, si se desea se puede enviar mensajes hasheados
  //ver las librerias

  function redirect($url, $mensajes = [])
  {
    $data = [];
    $params = '';

    foreach ($mensajes as $key => $value) {
      array_push($data, $key . '=' . $value);
    }
    $params = join('&', $data);

    if ($params != '') {
      $params = '?' . $params;
    }

    ob_start();

    header('location: ' . constant('URL') . $url . $params);

    ob_end_flush();
  }


  //Creacion de cabecera para que el navegador entienda que es un Json, es decir configuracion 
  //de las CORS con algunas cabeceras

  function initialJson()
  {

    header("Content-Type: application/json");
    header('Access-Control-Allow-Origin: ' . constant('URLCORS')); //Cambiar por el dominio 
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    $this->inputJson = json_decode(file_get_contents('php://input'), true);
  }

  //Salida de Json, parse del json 

  function createJson()
  {
    http_response_code($this->codeJson);
    echo json_encode($this->outputJson);
  }

  //Set valores json 

  function setCodeJson($code)
  {
    $this->codeJson = $code;
  }
  function setOutputJson($output)
  {
    $this->outputJson = $output;
  }
}
