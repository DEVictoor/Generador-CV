<?php

class InicioModel extends Model{

  public function __construct()
  { 
    parent::__construct();
  }

  public function get(){
    try{

      $pdo = $this->connect();

      //Table business 
      $select = $pdo->prepare
      ('SELECT bs.name name, bs.email email, bs.country country, 
              bs.city city, bs.phones phones,
              bs.favicon favicon, bs.logo_header logo_header,
              bs.logo_footer logo_footer,
              bs.img_background img_background, 
              bs.img_front img_front,
              bs.img_contact img_contact,
              bs.description_back description_back,
              bs.descrip_site_google descrip_site_google,
              bs.keywoord keywoord, bs.principal_color principal_color,
              bs.header_foot_color header_foot_color, 
              bs.background_color background_color,
              bs.contrast_color contrast_color,
              bs.product_cant product_cant, bs.product_columns product_columns
        FROM business bs
        WHERE bs.id = :id'
      );

      $select->bindValue(":id", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $DataBasica = $select->fetch(PDO::FETCH_OBJ);

      $select = $pdo->prepare("SELECT title, description, img, link FROM module_vertical WHERE id_business = :id ORDER BY id DESC");
      $select->bindValue(":id", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $modulesVert = $select->fetchAll(PDO::FETCH_OBJ);
    
      $select = $pdo->prepare("SELECT title, description, img FROM module_horizontal WHERE id_business = :id ORDER BY id DESC");
      $select->bindValue(":id", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $modulesHori = $select->fetchAll(PDO::FETCH_OBJ);

      $select = $pdo->prepare("SELECT id, name, description, img FROM product WHERE business_id = :IdBuss ORDER BY id ASC LIMIT :product_cant ");
      $select->bindValue(":product_cant", $DataBasica->product_cant, PDO::PARAM_INT);
      $select->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_INT);
      $select->execute();
      $Productos = $select->fetchAll(PDO::FETCH_OBJ);

      $output = ["DataBasica" => $DataBasica, "ModulosVerticales" => $modulesVert, "ModulosHorizontales" => $modulesHori, "Productos" => $Productos];

      return $output;

    }catch(PDOException $e)
    {
      error_log($e->getMessage());
      return false;
    }
  }

}


?>