<?php

class Create extends SessionController
{

    private $idcv = '' ; // Referencia al id del cv creado 

    function __construct()
    {
        parent::__construct();

    }

    public function init(){
        
        if(!$this->existGET(['status'])) return new Errores();

        $status = $this->getGet('status');

        if($status != 1 ) return new Errores();

        $dataUser = $this->getUserSessionData();

        $idcv = $this->model->crCv($dataUser);

        if(!$idcv) return new Errores();

        $this->redirect("create/profile/1?idcv=$idcv");
        
    }

    function render()
    {
        $this->start();
    }

    function start()
    {
        $this->view->render('createcv');
    }


    function profile($params = ["1"])
    {
        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder procegir');

        if(!is_array($params)) return new Errores();
        
        if(sizeof($params) > 1 ) return new Errores();

        switch ($params[0]) {
            case '1':

                $dataPage = $this->model->getCv();

                $this->view->render('personalinfo1', ['id_curriculum' => $this->idcv, 'dataPage' => $dataPage]);

                break;

            case '2':

                $this->view->render('personalinfo2', ['id_curriculum' => $this->idcv]);

                break;

            default:

                return new Errores();
                
                break;
        }
    
    }

    function works($params = ["1"])
    {

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder procegir');
        
        if(!is_array($params)) return new Errores();
        
        if(sizeof($params) > 1 ) return new Errores();

        switch ($params[0]) {
            case '1':

                if(isset($_GET['idwork'])) {

                    $data = $this->model->getWork($_GET['idwork']);

                    if(!$data) return new Errores(500, 'No se puede editar ese trabajo');

                    $this->view->render('workexp1', ['id_curriculum' => $this->idcv, 'dataWork' => $data]);

                }else{

                    $this->view->render('workexp1', ['id_curriculum' => $this->idcv]);

                }
                
                break;
            case '2':

                $dataWorks = $this->model->woks;

                $this->view->render('workexp2', ['id_curriculum' => $this->idcv, 'dataWorks' => $dataWorks]);
                
                break;
            case '3':
                $this->view->render('workexp3', ['id_curriculum' => $this->idcv]);
                break;
            default:
                return new Errores();
                break;
        }
    }
    
    function vocations($params = ["1"])
    {

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder procegir');
        
        if(!is_array($params)) return new Errores();
        
        if(sizeof($params) > 1 ) return new Errores();

        switch ($params[0]) {
            case '1':
                $this->view->render('vocationaltrain1', ['id_curriculum' => $this->idcv]);
                break;
            case '2':

                $dataEducation = $this->model->educations;

                $this->view->render('vocationaltrain2', ['id_curriculum' => $this->idcv, 'dataEducation' => $dataEducation]);

                break;

            case '3':

                $this->view->render('vocationaltrain3', ['id_curriculum' => $this->idcv]);
                
                break;

            default:
            
                return new Errores();
                break;
        }
    }

    function aptitudes($params = ["1"])
    {

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder procegir');
        
        if(!is_array($params)) return new Errores();
        
        if(sizeof($params) > 1 ) return new Errores();

        switch ($params[0]) {
            case '1':
                $htmlBody = $this->model->ability['html_body'];
                $this->view->render('aptitudes1', ['id_curriculum' => $this->idcv, 'html_body' => $htmlBody]);
                break;
            case '2':
                $this->view->render('aptitudes2', ['id_curriculum' => $this->idcv]);
                break;
            case '3':
                $resume = $this->model->ability['resume'];
                $this->view->render('aptitudes3', ['id_curriculum' => $this->idcv, 'resume' => $resume]);
                break;
            case '4': 
                $this->view->render('aptitudes4', ['id_curriculum' => $this->idcv]);
                break;
            default:
                return new Errores();
                break;
        }
    }
    function final()
    {
        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder procegir');

        $this->view->render("finalcv", ["id_curriculum" => $this->idcv]);
    }
    
    private function validate_idcv(){
       
        if(!$this->existGET(['idcv'])) return false;

        $idcv = $this->getGet('idcv');

        $this->model->setCv($idcv);

        // error_log("EL ID DEL CURRICULUM ES ->".  $this->model->vl_cv());

        if(!$this->model->vl_cv()) return false;

        $this->idcv = $idcv;

        return true;

    }


    /**
     * 
     * FUNCIONES PARA LOS FORMULARIOS  y algo mas 
     * 
     */


     public function updatecv(){
         
        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder procegir');
        
        if(!$this->existPOST(['name', 'lastnames', 'email', 'phone', 'postalcode', 'street', 'city'])) 
            return new Errores(400, "Parametros incorrectos");

        // print_r($_FILES);

        if(!$this->existFile(['user_img'])) 
            return new Errores(400, "Falta el parametro para la foto");

        $_POST['photo'] = $this->getFile('user_img');

        // print_r($_POST);
        
        if($this->model->updatecv($this->idcv, $_POST)){

            $this->redirect('create/profile/2?idcv=' . $_GET['idcv']);

        }else{
            $this->redirect('create/profile/1?idcv=' . $_GET['idcv']);
        } 

     }

    public function createWork(){

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder continuar...');

        if(!$this->existPOST(['position', 'company', 'city', 'start_date', 'description', 'finish_date'])) 
            return new Errores(400, "Parametro post incorrectos");

        $_POST['continue_work'] = $_POST['continue_work'] ??  0; 

        if($this->model->crWork($_POST)){
            $this->redirect('create/works/2?idcv=' . $_GET['idcv']);
        }else{
            $this->redirect('create/works/1?idcv=' . $_GET['idcv']);
        }

    }

    
    public function editWork(){

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder continuar...');

        if(!$this->existPOST(['position', 'company', 'city', 'start_date', 'description', 'finish_date'])) 
            return new Errores(400, "Parametro post incorrectos");

        if(!isset($_GET['idwork'])) return new Errores();

        $_POST['continue_work'] = $_POST['continue_work'] ??  0; 

        if($this->model->editWork($_GET['idwork'], $_POST)){
            $this->redirect('create/works/2?idcv=' . $_GET['idcv']);
        }else{
            return new Errores(500, 'Lo sentimos no se puede actualizar el recurso, intentalo mas tarde');
        }

    }

    public function createEducation(){

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder continuar...');

        if(!$this->existPOST(['education_center', 'location', 'title', 'speciality', 'graduation_year', 'description'])) 
            return new Errores(400, "Parametro post incorrectos");

        if($this->model->crEducation($_POST)){
            $this->redirect('create/vocations/2?idcv=' . $_GET['idcv']);
        }else{
            $this->redirect('create/vocations/1?idcv=' . $_GET['idcv']);
        }

    }

    public function insertApUno(){

        $session = new Session();

        $this->initialJson();

        $err = [];

        if(!$session->exists()){

            $this->setCodeJson(401);

            array_push($err, "No autorizado");

            $this->setOutputJson(["error" => $err]);

        }else{

            if(!$this->validate_idcv()) $this->setCodeJson(400); array_push($err, "No especificaron el id del curriculum"); $this->setOutputJson(["error" => $err]);

            if(!$this->existJson(['html_body'])) {

                $this->setCodeJson(400);
                array_push($err, "Error en el json, falta el attr html_body");
                $this->setOutputJson(["error" => $err]);
                
            }else{

                if($this->model->crAbility($this->inputJson)){

                    $this->setCodeJson(200);
                    $this->setOutputJson(["msg" => "Todo ok mi loco"]);

                    
                }else{
                    
                    $this->setCodeJson(500);
                    array_push($err, "Hubo un error en el servidor");
                    $this->setOutputJson(["error" => $err]);
                }
                
            }
        }
        $this->createJson();
        
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

            // if(!$this->validate_idcv()) $this->setCodeJson(400); array_push($err, "No especificaron el id del curriculum"); $this->setOutputJson(["error" => $err]);

            if($this->model->deletecv($_GET['id'])){

                $this->setCodeJson(200);
                $this->setOutputJson(["msg" => "Se elimino el recurso con exito"]);

                
            }else{
                
                $this->setCodeJson(500);
                array_push($err, "Hubo un error en el servidor");
                $this->setOutputJson(["error" => $err]);
            }
    
        }
        $this->createJson();
        
    }


    public function deleteWork(){

        $session = new Session();

        $this->initialJson();

        $err = [];

        if(!$session->exists()){

            $this->setCodeJson(401);

            array_push($err, "No autorizado");

            $this->setOutputJson(["error" => $err]);

        }else{

            if(!$this->validate_idcv()) $this->setCodeJson(400); array_push($err, "No especificaron el id del curriculum"); $this->setOutputJson(["error" => $err]);

            if($this->model->deleteWork($_GET['id'])){

                $this->setCodeJson(200);
                $this->setOutputJson(["msg" => "Se elimino el recurso con exito"]);

                
            }else{
                
                $this->setCodeJson(500);
                array_push($err, "Hubo un error en el servidor");
                $this->setOutputJson(["error" => $err]);
            }
    
        }
        $this->createJson();
        
    }

    public function deleteEducation(){

        $session = new Session();

        $this->initialJson();

        $err = [];

        if(!$session->exists()){

            $this->setCodeJson(401);

            array_push($err, "No autorizado");

            $this->setOutputJson(["error" => $err]);

        }else{

            if(!$this->validate_idcv()) $this->setCodeJson(400); array_push($err, "No especificaron el id del curriculum"); $this->setOutputJson(["error" => $err]);

            if($this->model->deleteEducation($_GET['id'])){

                $this->setCodeJson(200);
                $this->setOutputJson(["msg" => "Se elimino el recurso con exito"]);

                
            }else{
                
                $this->setCodeJson(500);
                array_push($err, "Hubo un error en el servidor");
                $this->setOutputJson(["error" => $err]);
            }
    
        }
        $this->createJson();
        
    }

    public function updateReAb(){

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id de cv para poder continuar...');

        if(!$this->existPOST(['resume'])) 
            return new Errores(400, "Parametro post faltantes");

        $resume = $this->getPost('resume');

        if($this->model->updateResAbility($resume)){
            $this->redirect('create/aptitudes/4?idcv=' . $_GET['idcv']);
        }else{
            $this->redirect('create/aptitudes/3?idcv=' . $_GET['idcv']);
        }    
        
    }

    // Function para la generacion de pdf 


    public function downloadPdf(){

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id cv para poder continuar...');

        ob_start();

        $data = [
            "profile" => $this->model->profile,
            "works" => $this->model->woks,  
            "educations" => $this->model->educations,
            "ability" => $this->model->ability
        ];

        $this->view->render('pdf/template', $data);

        $html = ob_get_clean();
        
        $options = new Dompdf\Options();
        // $options->set('isRemoteEnabled',TRUE);
        $options->setIsRemoteEnabled(true);
        

        $pdf = new Dompdf\Dompdf();
        // $pdf->set_paper('A4', 'portrait');
        $pdf->setOptions($options);
        $pdf->setpaper('A4', 'vertical');
        $pdf->loadHtml($html);

        $pdf->render();
        // $pdf->stream("report.pdf", ["Attachment" => false]);
        $pdf->stream("pdf_filename_". uniqid() .".pdf", array("Attachment" => true));

    }

    public function viewPdf(){

        if(!$this->validate_idcv()) return new Errores(400, 'Se necesita un id cv para poder continuar...');

        ob_start();

        $data = [
            "profile" => $this->model->profile,
            "works" => $this->model->woks,  
            "educations" => $this->model->educations,
            "ability" => $this->model->ability
        ];

        $this->view->render('pdf/template', $data);

        $html = ob_get_clean();
        $options = new Dompdf\Options();
        // $options->set('isRemoteEnabled',TRUE);
        $options->setIsRemoteEnabled(true);

        $pdf = new Dompdf\Dompdf();
        // $pdf->set_paper('A4', 'portrait');
        $pdf->setOptions($options);
        $pdf->setpaper('A4', 'vertical');
        $pdf->loadHtml($html);

        $pdf->render();
        $pdf->stream("report.pdf", ["Attachment" => false]);
        // $pdf->stream("pdf_filename_".rand(10,1000).".pdf", array("Attachment" => true));

    }
}   