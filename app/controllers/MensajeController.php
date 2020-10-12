<?php
require_once 'models/usuario.php';
require_once 'models/incidencia.php';
require_once 'models/mensaje.php';
require_once 'models/log.php';

class mensajeController
{

    public function mensajes()
    {
        Utils::isAdministrador('administrador');

        $mensaje = new Mensaje();
        $total_registro = $mensaje->getMensajesTotales();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_mensajes = $mensaje->getMensajes($desde, $por_pagina);

        require_once 'views/mensajes.php';
    }
    /* PROFESOR */
    public function mensajes_profesor()
    {
        $id = $_SESSION['identity']->id;

        $mensaje = new Mensaje();
        $total_registro = $mensaje->getMensajesTotales_Profesor($id);

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_mensajes = $mensaje->getMensajes_Profesor($id, $desde, $por_pagina);

        require_once 'views/mensajes_profesor.php';
    }
    /* PROFESOR */
    public function generarPDF()
    {
        header("Location:" . base_url . 'generarPDF/generarPDF.php');
    }
}
