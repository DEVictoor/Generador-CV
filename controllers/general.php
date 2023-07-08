<?php

class General extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function render()
    {

        $this->session = new Session();

        // $this->session->closeSession();
// 
        if ($this->session->exists()) {

            $userid = $this->session->getCurrentUser();
            $dataUser = $this->model->get($userid);
            // error_log("Password encriptada actual del usuario -> " . $dataUser['password']);
            $this->view->render('mainpagelog', $dataUser);
            return;

        } else {

            $this->view->render('mainpage');
            return;

        }
    }

    function login()
    {
        if ($this->existPOST(['username', 'password'])) {

            $username = $this->getPost('username');

            $password = $this->getPost('password');

            if ($username == '' || empty($username)   || $password == '' || empty($password)) {

                error_log('general::authenticate() empty');

                $this->redirect('general', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY]);

                return;

            }

            (filter_var($username, FILTER_VALIDATE_EMAIL)) ? $this->model->setEmail($username) : $this->model->setUsername($username);
            
            if(!($this->model->exists())) return $this->redirect('general', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_EXISTS]);

            $iduser = $this->model->getId();

            if(!$this->model->comparePasswords($password, $iduser)) return $this->redirect('general', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_DATA]);

            error_log('GENERAL::AUTHENTICATE passed');

            error_log("Session -> $iduser");

            $this->initialize($iduser);

            $this->redirect('general', ['success' => Success::SUCCESS_USER_LOGIN]);

        } else {

            error_log('Login::authenticate() error with params');

            $this->redirect('general', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE]);

        }
    }

    public function register()
    {
        if($this->existPOST(['email', 'username', 'password']))
        {
            $email = $this->getPost('email');
            $username = $this->getPost('username');

            if($email == '' || empty($email) || $username == '' || empty($username))
            {
                error_log('GENERAL::REGISTER credentials empty');
                
                $this->redirect('general', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]);

                return;
            }
            
            $this->model->from($_POST);

            if($this->model->save())
            {
                error_log('GENERAL::REGISTER true');
                $this->redirect('general', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
            }
            else
            {
                error_log('GENERAL::REGISTER false');
                $this->redirect('general', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
            }

        }
        else
        {
            error_log('GENERAL::REGISTER() error with params');
            $this->redirect('general', ['error' => Errors::ERROR_SIGNUP_NEWUSER_DATA]);
        }
    }

    public function closeSession()
    {	
        $session = new Session();

        if($session->exists()){
            $session->closeSession();
            $this->redirect('general');
        }

    }
} 
