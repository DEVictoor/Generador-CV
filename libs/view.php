<?php

class View{

    function __construct(){
    }

    function render($nombre, $data = []){

        $this->d = $data;
        
        is_array($data) && $this->handleMessages();
        
        error_log("VIEW::RENDER alchivo $nombre");
        // print_r($_POST);
        require 'views/' . $nombre . '.php';
        
    }
    
    public function handleMessages(){
        if(isset($_GET['success']) && isset($_GET['error'])){
            // no se muestra nada porque no puede haber un error y success al mismo tiempo
        }else if(isset($_GET['success'])){
            
            $this->handleSuccess();
            
        }else if(isset($_GET['error'])){
            
            $this->handleError();
        }
        
        $this->showMessages();
    }

    public function handleError(){
        if(isset($_GET['error'])){
            $hash = $_GET['error'];
            $errors = new Errors();

            if($errors->existsKey($hash)){
                error_log('View::handleError() existsKey =>' . $errors->get($hash));
                $this->d['error'] = $errors->get($hash);
            }else{
                $this->d['error'] = NULL;
            }
        }
    }


    public function handleSuccess(){
        if(isset($_GET['success'])){
            $hash = $_GET['success'];
            $success = new Success();

            if($success->existsKey($hash)){
                error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
                $this->d['success'] = $success->get($hash);
            }else{
                $this->d['success'] = NULL;
            }
        }
    }

    public function showMessages(){
        $this->showError();
        $this->showSuccess();
    }

    public function showError(){
        if(array_key_exists('error', $this->d)){
            // echo '<div class="error">'.$this->d['error'].'</div>';
        }
    }

    public function showSuccess(){
        if(array_key_exists('success', $this->d)){
            // echo '<div class="success">'.$this->d['success'].'</div>';
        }
    }
}

?>