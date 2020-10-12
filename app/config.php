<?php 

//Capturador de Controladores
function controllers_autoload($classname){
    include 'controllers/'.$classname.'.php';
  }
  spl_autoload_register('controllers_autoload');
  
  //Conectamos a la base de datos
  class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'db_incidencias');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
  }
  
  //Parametros por Defecto
  define("base_url", "http://localhost/IncidenciasPHP/app/");
  define("controller_default", "usuarioController");
  define("action_default", "login");
  
  //Utilidades  
  class Utils {
    public static function deleteSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
  
    public static function isAdministrador() {
        if (!isset($_SESSION['administrador'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }
  }

?>