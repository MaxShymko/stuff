<?php 
define(ROOT, $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT.'/sys/core.php');
require_once(ROOT.'/sys/coreapi.php');

$request = explode("/", $_SERVER["REQUEST_URI"]);

// Проверяем существует ли вызываемая функция в coreapi
$func = clearStr('API_'.$_GET['func']);
if(function_exists($func)){
    echo $func($_POST);
}else{
    echo 'Function '.$_GET['func'].' not found';
}
?>