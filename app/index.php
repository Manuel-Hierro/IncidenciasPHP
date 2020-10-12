<?php
session_start();
require_once 'config.php';

/************************************************** CONTENIDO **************************************************/

/* Si no se consigue cargar nigun controlador saldra el 'error' */
function show_error() {
  $error = new errorController();
  $error->index();
}

/* Si existe llama al controlador */
if (isset($_GET['controller'])) {
  $nombre_controlador = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
  $nombre_controlador = controller_default;
} else {
  show_error();
  exit();
}

/* Carga la funcion contenida en el controlador */
if (class_exists($nombre_controlador)) {
  $controlador = new $nombre_controlador();

  if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
      $action = $_GET['action'];
      $controlador->$action();
  } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
      $action_default = action_default;
      $controlador->$action_default();
  } else {
      show_error();
  }
} else {
  show_error();
}
/************************************************** CONTENIDO **************************************************/

//Importamos el controlador 'controlador' para poder crear objetos suyos
//require_once 'controllers/controlador.php';

//Definimos un objeto controlador
//$controlador = new controlador();

//if ($_GET && $_GET["accion"]) :

  //Limpia los datos que recibamos mediante el GET
  //$accion = filter_input(INPUT_GET, "accion", FILTER_SANITIZE_STRING);

  /* 
  Comprobamos que en el objeto controlador que hemos creado 
  existe el metodo hemos pasado por GET
  */
 // if (method_exists($controlador, $accion)) :
     // $controlador->$accion(); //Ejecutamos el metodo indicado en $accion
  //else :
     // $controlador->index();   //Si falla ejecutamos el metodo por defecto 
  //endif;

//else :
  //$controlador->index(); //Si no existe GET ejecutamos el metodo por defecto 
//endif;
?>