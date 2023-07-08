<?php

class CreateModel extends Model {

  private $idcv = 0;
  public $ability = ["html_body" => '', "resume" => '', "ok" => false]; 
  public $educations = [];
  public $woks = [];
  public $profile = [];

  public function __construct()
  {
    parent::__construct();
  }  

  private function init(){
    $this->getAbility();
    $this->getEducations();
    $this->getWorks();
    $this->getCv();
  }

  public function setCv($idcv){
    
    $this->idcv = $idcv;

    $this->vl_cv() && $this->init();

  }

  public function getCv(){

    try{

      $select = $this->prepare("SELECT *, id id_curriculum FROM curriculum WHERE id = :idcv");

      $select->bindValue(":idcv", $this->idcv,PDO::PARAM_INT);

      $select->execute();

      $data = $select->fetch(PDO::FETCH_ASSOC);

      $this->profile = $data;

      return $data;

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }

  }

  public function crCv($userDatos){

    try {
      
      $pdo = $this->connect();

      $insert = $pdo->prepare("INSERT INTO curriculum(id_user, name, lastnames, email, phone, country, postalcode, status, street, photo) 
                                               VALUES (:id_user, :name , :lastnames, :email, :phone, :country, '', 1, :street, :photo)");

      $insert->bindValue(":id_user", $userDatos['id'], PDO::PARAM_INT);
      $insert->bindValue(":name" , $userDatos['name'], PDO::PARAM_STR);
      $insert->bindValue(":lastnames", $userDatos['lastname'], PDO::PARAM_STR);
      $insert->bindValue(":email", $userDatos['email'], PDO::PARAM_STR);
      $insert->bindValue(":phone", $userDatos['phone'], PDO::PARAM_STR);
      $insert->bindValue(":country", $userDatos['country'], PDO::PARAM_STR);
      $insert->bindValue(":street", $userDatos['street'], PDO::PARAM_STR);
      $insert->bindValue(":photo", $userDatos['photo'], PDO::PARAM_STR);

      $insert->execute();

      $id = $pdo->lastInsertId();

      return $id;

    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    }

  }

  public function updateStatusCv($id, $status){
    try{

      $update = $this->prepare("UPDATE curriculum SET status = :status WHERE id = :id");
      
      $update->bindValue(":id", $id, PDO::PARAM_INT);
      
      $update->bindValue(":status", $status, PDO::PARAM_INT);

      return $update->execute();

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function updateCv($id, $array){
    try{

      $update = $this->prepare("UPDATE curriculum SET name = :name, lastnames = :lastnames, email = :email, phone = :phone, postalcode = :postalcode, street = :street, city = :city, photo = :photo WHERE id = :id");

      $pathFile = $this->saveFile($array['photo'], 'image');

      if(!$pathFile) $pathFile = $this->getCv()['photo'];

      $update->bindValue(':id', $id, PDO::PARAM_INT);
      $update->bindValue(":name", $array['name'], PDO::PARAM_STR);
      $update->bindValue(":lastnames", $array['lastnames'], PDO::PARAM_STR);
      $update->bindValue(":email", $array['email'], PDO::PARAM_STR);
      $update->bindValue(":phone", $array['phone'], PDO::PARAM_STR);
      $update->bindValue(":postalcode", $array['postalcode'], PDO::PARAM_STR);
      $update->bindValue(":street", $array['street'], PDO::PARAM_STR);
      $update->bindValue(":city", $array['city'], PDO::PARAM_STR);
      $update->bindValue(":photo", $pathFile, PDO::PARAM_STR);

      return $update->execute();

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function deleteCv($id){
    try{
      
      $delete = $this->prepare("DELETE FROM curriculum WHERE id = :id");

      $delete->bindValue(":id", $id, PDO::PARAM_INT);

      return $delete->execute();

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function crAbility($datos)
  {
    try{

      $pdo = $this->connect();

      // Valida 

      if(isset($this->ability["ok"])){

        $insert = $pdo->prepare("INSERT INTO ability(html_body, resume, id_curriculum) VALUES (:html_body, '', :idcv)");
        
        $insert->bindValue(":html_body", $datos['html_body'], PDO::PARAM_STR);
        $insert->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);
  
        return $insert->execute();

      }else{

        $update = $pdo->prepare("UPDATE ability SET html_body = :html_body WHERE id_curriculum = :idcv");

        $update->bindValue(":html_body", $datos['html_body'], PDO::PARAM_STR);
        $update->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);
        
        return $update->execute();

      }


    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function updateResAbility($resume){
    try{

      $update = $this->prepare("UPDATE ability SET resume = :resume WHERE id_curriculum = :idcv");

      $update->bindValue(":resume", $resume, PDO::PARAM_STR);
      $update->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);

      return $update->execute();

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function crEducation($datos){
    try{

      $pdo = $this->connect();

      $insert_uno = $pdo->prepare("INSERT INTO education(education_center, location, title, speciality, graduation_year, description) 
                                      VALUES (:education_center, :location, :title, :speciality, :graduation_year, :description)");
      
      $insert_uno->bindValue(":education_center", $datos['education_center'], PDO::PARAM_STR);
      $insert_uno->bindValue(":location", $datos['location'], PDO::PARAM_STR);
      $insert_uno->bindValue(":title", $datos['title'], PDO::PARAM_STR);
      $insert_uno->bindValue(":speciality", $datos['speciality'], PDO::PARAM_STR);
      $insert_uno->bindValue(":graduation_year", $datos['graduation_year'], PDO::PARAM_STR);
      $insert_uno->bindValue(":description", $datos['description'], PDO::PARAM_STR);
  
      $insert_uno->execute();

      $ided = $pdo->lastInsertId();

      $insert_dos = $pdo->prepare("INSERT INTO curriculum_education(id_curriculum, id_education) VALUES (:idcv, :ided)");

      $insert_dos->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);
      $insert_dos->bindValue(":ided", $ided, PDO::PARAM_INT);

      return $insert_dos->execute();

    }catch(PDOException $e) {
      error_log($e->getMessage());
      return false;
    }
  }

  public function crEducations($arrayEducation)
  {
    try{

      $pdo = $this->connect();

      $insert_uno = $pdo->prepare("INSERT INTO education(education_center, location, title, speciality, graduation_year) 
                                                VALUES (:education_center, :location, :title, :speciality, :graduation_year)");
      
      $idsEducations = [];
      
      foreach($arrayEducation as $val){
        $insert_uno->bindParam(":education_center", $val['education_center'], PDO::PARAM_STR);
        $insert_uno->bindParam(":location", $val['location'], PDO::PARAM_STR);
        $insert_uno->bindParam(":title", $val['title'], PDO::PARAM_STR);
        $insert_uno->bindParam(":title", $val['title'], PDO::PARAM_STR);
        $insert_uno->bindParam(":speciality", $val['speciality'], PDO::PARAM_STR);
        $insert_uno->bindParam(":graduation_year", $val['graduaction_year'], PDO::PARAM_STR);
        $insert_uno->execute();
        array_push($idsEducations, $insert_uno->lastInsertId());
      }

      $insert_dos = $pdo->prepare("INSERT INTO curriculum_education(id_curriculum, id_education) VALUES (:idcv, :ided)");

      foreach ($idsEducations as $value) {
        $insert_dos->bindParam(":idcv", $this->idcv, PDO::PARAM_INT);
        $insert_dos->bindParam(":ided", $value, PDO::PARAM_INT);
        $insert_dos->execute();
      }

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function crWork($datos){
    try{

      $pdo = $this->connect();

      $insert_uno = $pdo->prepare("INSERT INTO works(position, company, city, start_date, description, finish_date, continue_work) 
                                      VALUES (:position, :company, :city, :start_date, :description, :finish_date, :continue_work)");
      
      $insert_uno->bindValue(":position", $datos['position'], PDO::PARAM_STR);
      $insert_uno->bindValue(":company", $datos['company'], PDO::PARAM_STR);
      $insert_uno->bindValue(":city", $datos['city'], PDO::PARAM_STR);
      $insert_uno->bindValue(":start_date", $datos['start_date'], PDO::PARAM_STR);
      $insert_uno->bindValue(":description", $datos['description'], PDO::PARAM_STR);
      $insert_uno->bindValue(":finish_date", $datos['finish_date'], PDO::PARAM_STR);
      $insert_uno->bindValue(":continue_work", $datos['continue_work'], PDO::PARAM_INT);
      $insert_uno->execute();

      $idwork = $pdo->lastInsertId();

      $insert_dos = $pdo->prepare("INSERT INTO curriculum_works(id_curriculum, id_work) VALUES (:idcv, :idwo)");

      $insert_dos->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);
      $insert_dos->bindValue(":idwo", $idwork, PDO::PARAM_INT);

      return $insert_dos->execute();

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function crWorks($arrayWorks)
  {
    try{

      $pdo = $this->connect();

      $insert_uno = $pdo->prepare("INSERT INTO works(position, company, city, start_date, description, finish_date, continue_work) 
                                      VALUES (:position, :company, :city, :start_date, :description, :finish_date, :continue_work)");

      $idsWorks = [];
      
      foreach($arrayWorks as $val){
        $insert_uno->bindParam(":position", $val['position'], PDO::PARAM_STR);
        $insert_uno->bindParam(":company", $val['company'], PDO::PARAM_STR);
        $insert_uno->bindParam(":city", $val['city'], PDO::PARAM_STR);
        $insert_uno->bindParam(":start_date", $val['start_date'], PDO::PARAM_STR);
        $insert_uno->bindParam(":description", $val['description'], PDO::PARAM_STR);
        $insert_uno->bindParam(":finish_date", $val['finish_date'], PDO::PARAM_STR);
        $insert_uno->bindParam(":continue_work", $val['continue_work'], PDO::PARAM_INT);
        $insert_uno->execute();
        array_push($idsWorks, $insert_uno->lastInsertId());
      }

      $insert_dos = $pdo->prepare("INSERT INTO curriculum_works(id_curriculum, id_works) VALUES (:idcv, :idwo)");

      foreach ($idsWorks as $value) {
        $insert_dos->bindParam(":idcv", $this->idcv, PDO::PARAM_INT);
        $insert_dos->bindParam(":idwo", $value, PDO::PARAM_INT);
        $insert_dos->execute();
      }

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  private function getAbility()
  {
    try{
      
      $select = $this->prepare("SELECT * FROM ability a WHERE a.id_curriculum = :idcv");

      $select->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);

      $select->execute();

      $data = $select->fetch(PDO::FETCH_ASSOC);

      if(isset($data['id'])) $this->ability = $data;

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  private function getEducations()
  {
    try{
      
      $select = $this->prepare("SELECT e.* FROM curriculum_education ce INNER JOIN education e ON ce.id_education = e.id WHERE ce.id_curriculum = :idcv");

      $select->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);

      $select->execute();

      $data = $select->fetchAll(PDO::FETCH_ASSOC);

      $this->educations = $data;


    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function getWork($id){

    try{

      $select = $this->prepare("SELECT * FROM works WHERE id = :id");

      $select->bindValue(":id", $id, PDO::PARAM_INT);

      $select->execute();

      $data = $select->fetch(PDO::FETCH_ASSOC);

      if(!isset($data['id'])) return false;

      return $data;

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;      
    }


  }

  public function editWork($id, $datos){
    try {
      
      $update = $this->prepare("UPDATE works SET position = :position, company = :company, city = :city, start_date = :start_date, 
                            description = :description, finish_date = :finish_date, continue_work = :continue_work WHERE id = :id");

      $update->bindValue(":position", $datos['position'], PDO::PARAM_STR);
      $update->bindValue(":company", $datos['company'], PDO::PARAM_STR);
      $update->bindValue(":city", $datos['city'], PDO::PARAM_STR);
      $update->bindValue(":start_date", $datos['start_date'], PDO::PARAM_STR);
      $update->bindValue(":description", $datos['description'], PDO::PARAM_STR);
      $update->bindValue(":finish_date", $datos['finish_date'], PDO::PARAM_STR);
      $update->bindValue(":continue_work", $datos['continue_work'], PDO::PARAM_INT);
      $update->bindValue(":id", $id, PDO::PARAM_INT);
      $update->execute();

      return $update->rowCount() == 1;

    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    }
  }

  private function getWorks(){
    try{

      $select = $this->prepare("SELECT w.*, YEAR(w.start_date) start_year, YEAR(w.finish_date) finish_year FROM curriculum_works cw INNER JOIN works w ON cw.id_work = w.id WHERE cw.id_curriculum = :idcv");

      $select->bindValue(":idcv", $this->idcv, PDO::PARAM_INT);

      $select->execute();

      $data = $select->fetchAll(PDO::FETCH_ASSOC);

      $this->woks = $data;

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }


  public function deleteWork($id){
    try{


      $delete = $this->prepare("DELETE FROM curriculum_works WHERE id_work = :id");

      $delete->bindValue(":id", $id, PDO::PARAM_INT);

      return $delete->execute();

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }


  public function deleteEducation($id){

    try{
      $delete = $this->prepare("DELETE FROM curriculum_education WHERE id_education = :id");
      $delete->bindValue(":id", $id, PDO::PARAM_INT);
      return $delete->execute();
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }

  }

  // Comprobaciones 

  public function vl_cv()
  {
    try{

      $select = $this->prepare("SELECT * FROM curriculum WHERE id = :id");

      $select->bindValue(":id", $this->idcv, PDO::PARAM_INT);

      $select->execute();

      $data = $select->fetch(PDO::FETCH_ASSOC);

      return isset($data['id']);

    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }
}

?>