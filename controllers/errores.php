<?php

class Errores extends Controller{

    function __construct($codigo = 400, $mensaje = 'Lo sentimos no hemos encontrar su página'){
       
        parent::__construct();

        if($codigo == 400) $this->view->render('errors/404', $mensaje);

        if($codigo == 500) $this->view->render('errors/500', $mensaje);

    }
}

?>