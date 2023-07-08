<?php

class SessionController extends Controller{
    
    private $userSession;
    private $username;
    private $userid;

    private $session;

    private $user;
 
    function __construct(){
        parent::__construct();

        $this->init();
    }

    public function getUserSession(){
        return $this->userSession;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getUserId(){
        return $this->userid;
    }

    private function init(){

        $this->session = new Session();  

        $this->validateSession();
    }
 
    /**
     * Implementa el flujo de autorización
     * para entrar a las páginas
     */

    function validateSession(){

        // error_log('SessionController::validateSession()');

        if($this->existsSession()){ 
            
            error_log("SessionController::validateSession() is true");

            if($this->getCurrentPage() === 'signup') $this->redirect('general');

        }else{

            error_log("SessionController::validateSession() is false");
            
            if($this->getCurrentPage() !== 'register' && $this->getCurrentPage() !== 'general') {
                
                error_log('SessionController::validateSession() redirect al general');

                $this->redirect('general');

            }
        }
    }

    /**
     * Valida si existe sesión, 
     * si es verdadero regresa el usuario actual
     */

    function existsSession(){

        if(!$this->session->exists()) return false;

        if($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();

        error_log("Identificacion del usuario actual -> $userid");

        if($userid) return true;

        return false;
    }

    function getUserSessionData(){

        error_log("SessionController::getUserSessionData() is started");

        $id = $this->session->getCurrentUser();

        $this->user = new UserModel();

        $userData = $this->user->get($id);

        // error_log($this->user->id);

        return $userData;

    }

    public function initialize($userid){

        error_log("sessionController::initialize(): user: " . $userid);
        
        $this->session->setCurrentUser($userid);

    }

    private function getCurrentPage(){
        
        $url = explode('/', trim($_GET['url'] ?? ''));
        
        return $url[0];

    }

    function logout(){

        $this->session->closeSession();
        
    }
}


?>