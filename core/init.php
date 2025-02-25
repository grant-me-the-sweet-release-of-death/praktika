<?php
const CORE_DIR = 'core/';
const APP_DIR = 'app/';
const ADMIN_DIR = APP_DIR . 'admin/';

set_include_path(get_include_path() . PATH_SEPARATOR . CORE_DIR . PATH_SEPARATOR . APP_DIR . PATH_SEPARATOR . ADMIN_DIR);
spl_autoload_extensions('.class.php');
spl_autoload_register();

const ERROR_LOG = ADMIN_DIR . 'error.log';
const ERROR_MSG = 'Please contact an admin! admin@email.info';

function errors_log($msg, $file, $line) {
    $dt = date('d-m-Y H:i:s');
    $message = "$dt - $msg in $file:$line\n";
    error_log($message, 3, ERROR_LOG);
    echo ERROR_MSG;
}

function error_handler($no, $msg, $file, $line) {
    errors_log($msg, $file, $line);
}

set_error_handler('error_handler');

function exception_handler($e) {
    errors_log($e->getMessage(), $e->getFile(), $e->getLine());
}

set_exception_handler('exception_handler');

/* 
    //////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
*/

const DB = [
    'HOST' => 'localhost',
    'USER' => 'root',
    'PASS' => '12345',
    'NAME' => 'eshop',
];

try {
    Eshop::init(DB);
    
    $basket = new Basket();
    $basket->init();

    session_start();

if (!isset($_SESSION['admin'])) {
   header('Location: /enter.php');
   exit();
}

} catch (Exception $e) {
    errors_log("Database initialization error: " . $e->getMessage(), __FILE__, __LINE__);
}
