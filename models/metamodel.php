<?php

class MetaModel extends Model{

  private $Description;
  private $Keyword;
  private $MainColor;
  private $ContrastColor;
  private $NavColor;
  private $BackgroundColor;

  public function __construct(){
    parent::__construct();
  }

  public function get(){
    try{
      $select = $this->prepare("SELECT descrip_site_google meta_google, keywoord meta_keywords, principal_color meta_color_main, contrast_color meta_color_contrast, header_foot_color meta_color_navfoot, background_color meta_color_background FROM business WHERE id = :IdBuss");
      $select->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_INT);
      if($select->execute()){
        return $select->fetch(PDO::FETCH_OBJ);
      }
    }catch(PDOException $e){
      error_log($e->getMessage());  
      return false;
    }
  }

  public function update(){
    try{
      $update = $this->prepare("UPDATE business SET descrip_site_google = :Description, keywoord = :Keyword, principal_color = :MainColor, contrast_color = :ContrastColor, header_foot_color = :NavColor, background_color = :BackgroundColor WHERE id = :IdBuss");
      $update->bindValue(":Description", $this->Description, PDO::PARAM_STR);
      $update->bindValue(":Keyword", $this->Keyword, PDO::PARAM_STR);
      $update->bindValue(":MainColor", $this->MainColor, PDO::PARAM_STR);
      $update->bindValue(":ContrastColor", $this->ContrastColor, PDO::PARAM_STR);
      $update->bindValue(":NavColor", $this->NavColor, PDO::PARAM_STR);
      $update->bindValue(":BackgroundColor", $this->BackgroundColor, PDO::PARAM_STR);
      $update->bindValue(":IdBuss", $this->IdBuss, PDO::PARAM_STR);
      if($update->execute()) return true;
    }catch(PDOException $e){
      error_log($e->getMessage());
      return false;
    }
  }

   /**
    * SETTTERS
    */

  public function setDescription($value){ $this->Description = $value; }
  public function setKeyword($value){ $this->Keyword = $value; }
  public function setMainColor($value){ $this->MainColor = $value; }
  public function setContrastColor($value){ $this->ContrastColor = $value; }
  public function setNavColor($value){ $this->NavColor = $value; }
  public function setBackgroundColor($value){ $this->BackgroundColor = $value; }
  // public function set

  public function getDescription(){ return $this->Description; }
  public function getKeyword(){ return $this->Keyword; }
  public function getMainColor(){ return $this->MainColor; }
  public function getContrastColor(){ return $this->ContrastColor; }
  public function getNavColor(){ return $this->NavColor; }
  public function getBackgroundColor(){ return $this->BackgroundColor; }

  /**
   * GETTERS
   */

  
}

?>