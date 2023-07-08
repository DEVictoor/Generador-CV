<?php

include_once 'libs/imodel.php';

class Model
{

  private $pathFiles;
  protected $IdBuss;
  public $db;

  function __construct()
  {

    $this->db = new Database();
    $this->pathFiles = [
      "image" => "./assets/img/",
      "icon" => './assets/img/icons/'
    ];
  }

  function query($query)
  {
    return $this->db->connect()->query($query);
  }

  function prepare($query)
  {
    return $this->db->connect()->prepare($query);
  }

  function connect()
  {
    return $this->db->connect();
  }

  /**
   * Funcion para el guardadod de imagenes en la ruta /generatorcv/assets/img o /generatorcv/assets/img/icons
   * por otra lado, el output de la funcion es la ruta absluta donde se guardo la imagen
   */

  function saveFile($file, $type)
  {
    error_log("CLASS IMAGES::saveFile");
    $archivo = $file['name'];
    if (isset($archivo) && $archivo != "") {
      $path = $this->pathFiles[$type] | "";
      $tipo = $file['type'];
      error_log($tipo);
      $extension = pathinfo($archivo, PATHINFO_EXTENSION);
      $temp = $file['tmp_name'];
      $uniq = uniqid();
      if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
        error_log("IMG::saveFile type files not permited ");
        return false;
      } else {
        if (move_uploaded_file($temp, $path . $uniq . "." . $extension)) {
          error_log("IMAGE::SAVEIMAGE TRUE file: " . $uniq . "." . $extension);
          return constant('URL') . substr($path, 2)  . $uniq . "." . $extension;
        } else {
          error_log("IMAGE::SAVEIMAGE FALSE");
          return false;
        }
      }
    } else {
      error_log("MODE::SAVEFILE Archivo vacio no se puede guardar");
      return false;
    }
  }

  /**
   * Funcion para eliminar imagenes
   */

  function deleteFile($url, $type)
  {
    $array = explode("/", $url);

    if ($array[count($array) - 1] == "") {
      error_log("DELETEFILE file empty");
      return true;
    }
    $path = $this->pathFiles[$type] . $array[count($array) - 1];
    if (file_exists($path)) {
      error_log("MODEL::DELETEFILE the file exists");
      if (unlink($path)) {
        error_log("Archivo elimindo: " . $path);
        return true;
      } else {
        error_log("Archivo no eliminado");
        return false;
      }
    } else {
      error_log("MODEL::DELETEFILE not found file");
      return false;
    }
    // return true;
  }
}
