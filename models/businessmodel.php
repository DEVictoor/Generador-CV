<?php

class BusinessModel extends Model{

  private $Title; 
  private $Description;

  //Modulo 
  private $IdModule;
  private $ModuleTitle;
  private $ModuleDescription;
  private $ModuleImage;

  //Galeria de Fotos
  private $IdGalleryPhoto;
  private $GalleryPhoto;

  public function __construct()
  {
    parent::__construct();
  }

  public function get(){
    try{
      $pdo = $this->connect();

      $select = $pdo->prepare("SELECT eslogan, desc_eslogan FROM business WHERE id = :IdBuss");
      $select->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $DataBasica = $select->fetch(PDO::FETCH_OBJ);

      $select = $pdo->prepare("SELECT id, title, description, img FROM module_buss WHERE id_business = :IdBuss ORDER BY id DESC");
      $select->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $Modulos = $select->fetchAll(PDO::FETCH_OBJ);

      $select = $pdo->prepare("SELECT id,img FROM gallery_photos WHERE id_business = :IdBuss ORDER BY id DESC");
      $select->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $Gallery = $select->fetchAll(PDO::FETCH_OBJ);

      $output = [
        "DataBasica" => $DataBasica,
        "Modulos" => $Modulos,
        "Gallery" => $Gallery
      ];

      return $output;
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function update(){
    try{
      error_log("BUSINESS::MODEL is invoked");
      $update = $this->prepare("UPDATE business SET eslogan = :Title, desc_eslogan = :Description WHERE id = :id");
      $update->bindValue(":Title", $this->Title, PDO::PARAM_STR);
      $update->bindValue(":Description", $this->Description, PDO::PARAM_STR);
      $update->bindValue(":id", $this->IdBuss, PDO::PARAM_INT);
      if($update->execute()){
        error_log("BUSINESS::MODEL updated"); 
        return true;
      }
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function createModule(){
    try{
        $pdo = $this->connect();
        $create = $pdo->prepare("INSERT INTO module_buss(title, description, img, id_business) VALUE (:ModuleTitle, :ModuleDescription, :ModuleImage, :IdBuss)");
        $create->bindValue(":ModuleTitle", $this->ModuleTitle, PDO::PARAM_STR);
        $create->bindValue(":ModuleDescription", $this->ModuleDescription, PDO::PARAM_STR);
        $create->bindValue(":ModuleImage", $this->ModuleImage, PDO::PARAM_STR);
        $create->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_INT);
        
        if($create->execute()){
          
          $output = [
            "id" => $pdo->lastInsertId(),
            "title" => $this->ModuleTitle,
            "description" => $this->ModuleDescription,
            "img" => $this->ModuleImage
          ];

          return $output;
        }
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function createPhoto(){
    try{
      error_log("BUSSSMODEL :: createPhoto invoked");
      $pdo = $this->connect();
      $insert = $pdo->prepare("INSERT INTO gallery_photos(img, id_business) VALUE (:GalleryPhoto, :IdBuss)");
      $insert->bindValue(":GalleryPhoto", $this->GalleryPhoto, PDO::PARAM_STR);
      $insert->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_STR);
      if($insert->execute()){
        error_log("BUSSMODEL::createPhot created");

        $output = [
          "id" => $pdo->lastInsertId(),
          "img" => $this->GalleryPhoto
        ];

        return $output;
      }
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  public function deleteModule(){
    try{
      $pdo = $this->connect();

      error_log("BUSSMODEL :: deleteModule is invoked");

      $select = $pdo->prepare("SELECT img FROM module_buss WHERE id = :IdModule");
      $select->bindValue(":IdModule", $this->IdModule, PDO::PARAM_INT);
      $select->execute();
      $path = $select->fetch(PDO::FETCH_OBJ)->img;

      $delete = $pdo->prepare("DELETE FROM module_buss WHERE id = :IdModule");
      $delete->bindValue(":IdModule", $this->IdModule, PDO::PARAM_INT);
      if($delete->execute()){
        return $this->deleteFile($path, 'image');
      }
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

  
  public function deleteGalleyPhoto(){
    try{

      $pdo = $this->connect();
      error_log("BUSSMODEL :: deleteModule is invoked");

      $select = $pdo->prepare("SELECT img FROM gallery_photos WHERE id = :IdGalleryPhoto");
      $select->bindValue(":IdGalleryPhoto", $this->IdGalleryPhoto, PDO::PARAM_INT);
      $select->execute();
      $path = $select->fetch(PDO::FETCH_OBJ)->img;

      $delete = $pdo->prepare("DELETE FROM gallery_photos WHERE id = :IdGalleryPhoto");
      $delete->bindValue(":IdGalleryPhoto", $this->IdGalleryPhoto, PDO::PARAM_INT);
      if($delete->execute()){
        return $this->deleteFile($path, 'image');
      }
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }


  public function setTitle($value) {$this->Title = $value;}
  public function setDescription($value) {$this->Description = $value;}

  public function setModuleTitle($value) {$this->ModuleTitle = $value;}
  public function setModuleDescription($value) {$this->ModuleDescription = $value;}

  public function setIdModule($value) {$this->IdModule = $value;}
  public function setModuleImage($value) {$this->ModuleImage = $this->saveFile($value, 'image');}
  
  public function setIdGalleryPhoto($value){$this->IdGalleryPhoto = $value;}
  public function setGalleryPhoto($value) {$this->GalleryPhoto = $this->saveFile($value, 'image');}


  
  
  public function getTitle() {return $this->Title;}
  public function getDescription() {return $this->Description;}
  public function getModuleTitle() {return $this->ModuleTitle;}
  public function getModuleDescription() {return $this->ModuleDescription;}

  public function getIdModule() {return $this->IdModule;}
  public function getIdGalleryPhoto() {return $this->IdGalleryPhoto;}
  public function getModuleImage() {return $this->ModuleImage;}
  public function getGalleryPhoto() {return $this->GalleryPhoto;}


}

?>