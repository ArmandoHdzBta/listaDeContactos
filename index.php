<?php
//se verifica que las variables no esten vacias
if ((!isset($_GET['controller'])) || (!isset($_GET['action']))) {
	echo "Peticion invalida";
}
session_start();
$controller = $_GET['controller']."Controller";
//se incluyen los controladores y se concatena con el nombre pasado por metodo GET .php
require 'app/controller/'.$controller.'.php';
//se recibe la accion por metodo GET
$action = $_GET['action'];
//se crea un objeto del controlador
$objeto = new $controller();
//se accede a la funcion deseada que se recibe por metodo GET
$objeto->{$action}();
//{$variable}() se ponen {} para acceder a una funcion o variable en espesifico
?>