<?php
require 'Controller/StudentController.php';
require 'Views/header.html';


$controller = new StudentController();

if(isset($_REQUEST) && !empty($_REQUEST['class'])){
    if(method_exists($_REQUEST['class'], $_REQUEST['method'])){
        $method = $_REQUEST['method'];
        call_user_func(array($controller, $method));
    }
}
$controller->show();

require 'Views/footer.html';
