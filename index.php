<?php

error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE

ini_set('display_errors', TRUE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment

ini_set('log_errors', TRUE); // Error/Exception file logging engine.

ini_set("error_log", "./php-error.log");

error_log( "         " );
error_log( "Start log" );
error_log( "=========" );

// tail -f /tmp/php-error.log     -----------> Comando para ver por consolar el log de los errores 

require_once 'config/config.php';

require_once 'libs/database.php';
require_once 'libs/messages.php';

require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';

require_once 'libs/app.php';

require_once 'classes/session.php';
require_once 'classes/sessionController.php';
require_once 'classes/errors.php';
require_once 'classes/success.php';

include_once 'models/usermodel.php';

// Require para la Libreria de pdf

include_once 'libs/domPDF/autoload.inc.php';

$app = new App();

error_log("Peticion actual -> " . constant('URL') . ($_GET['url'] ?? ''));


?>