<?php

$url = !empty($_GET['url']) ? $_GET['url'] : 'default/index';/** catching url */
$urlParts = explode("/",$url); /** url parts */
$controller = ucfirst($urlParts[0]).'Controller';/** controller */
$method = !empty($urlParts[1]) ? $urlParts[1] : 'index' ; /** verify that method exists in url*/
$params = !empty($urlParts[2]) ? $urlParts[2] : '';/** params */

/** import controller error */
$errorController = 'controller/ErrorController.php';
require_once($errorController);
$errorController = new ErrorController();

$fileController = 'controller/'.$controller.'.php';
if(file_exists($fileController)){
    require_once($fileController);
    $controller = new $controller(); /** controller instance */
    /** check controller method */
    if(method_exists($controller,$method)){
        $controller->{$method}($params);
    }
    else{
        $errorController->error404();
    }
}
else{
    $errorController->error404();
}
