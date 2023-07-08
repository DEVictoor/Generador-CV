<?php

class GeneralModel extends UserModel{

    public function __construct(){
        parent::__construct();
    }    

    public function getUser($id){
        try{
           // Code here  
        }   
        catch(PDOException $e){
            error_log("GENERALMODEL::MENSAJE DB -> " . $e->getMessage());
            error_log("GENERALMODEL::NO SE PUDO OBTENER LOS DATOS");
        }
    }


}

?>