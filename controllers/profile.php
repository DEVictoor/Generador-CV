
<?php

class Profile extends SessionController{

    private $user = '';

    function __construct(){
        
        
        parent::__construct();

        $this->user = $this->getUserSessionData();

        // error_log("user " . $this->user->getName());

    }
    
    function render(){
        
        
    
        $this->view->render("user/profile", ["dataUser" => $this->user]);

    }

    public function cvs(){

        $data = $this->model->getcvs($this->user['id']);

        $this->view->render('user/mycvs', ["cvs" => $data]);

    }


    public function updateUser(){

        if(!$this->existPOST(['name', 'lastname', 'city', 'email', 'street', 'phone'])) return new Errores(500, 'Por favor no editaste el archivo HTML :)');

        if(!$_POST['name']) 

        if(!$this->existFile(['photo'])) return new Errores(500, 'No se invio correctamente el formulario');

        $_POST["photo"] = $this->getFile('photo');

        if(!$this->model->fullUpdate($this->user['id'], $_POST)) return new Errores(500, 'Error del servidor, intentelo más tarde');

        $this->redirect('user');

    }


    public function deletecv(){

        $session = new Session();

        $this->initialJson();

        $err = [];

        if(!$session->exists()){

            $this->setCodeJson(401);

            array_push($err, "No autorizado");

            $this->setOutputJson(["error" => $err]);

        }else{

        
            if($this->model->deletecv($_GET['idcv'])){

                $this->setCodeJson(200);
        
                $this->setOutputJson(["msg" => "Se ilimino con exito el cv"]);
        
            }else{
                
                $this->setCodeJson(500);
                array_push($err, "Hubo un error en el servidor");
                $this->setOutputJson(["error" => $err]);
            }    
            
        }
        $this->createJson();
        
    }


}

?>