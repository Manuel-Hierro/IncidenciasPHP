<?php 
require_once 'models/usuario.php';
require_once 'models/incidencia.php';
require_once 'models/mensaje.php';
require_once 'models/log.php';

class registroController {    
    
    public function registros()
    {
        Utils::isAdministrador('administrador');

        $usuario = new Usuario();
        $total_registro = $usuario->getUsuariosTotales_inactivos();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_registros = $usuario->getUsuarios_inactivos($desde, $por_pagina);

        require_once 'views/registros.php';
    } 

    public function aceptar()
    {
        Utils::isAdministrador('administrador');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $usuario->aceptar();
        }
        header("Location:" . base_url . 'registro/registros');
    }

    public function rechazar()
    {
        Utils::isAdministrador('administrador');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $usuario->rechazar();

            header("Location:" . base_url . 'registro/registros');
        }
    }
    
    public function generarPDF()
    {
        header("Location:" . base_url . 'generarPDF/generarPDF.php');
    }
}
