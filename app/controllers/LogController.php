<?php 
require_once 'models/usuario.php';
require_once 'models/incidencia.php';
require_once 'models/mensaje.php';
require_once 'models/log.php';

class logController {    

    public function logs()
    {
        Utils::isAdministrador('administrador');

        $log = new Log();
        $total_registro = $log->getLogsTotales();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_logs = $log->getLogs($desde, $por_pagina);

        require_once 'views/logs.php';
    }

    public function generarPDF()
    {
        header("Location:" . base_url . 'generarPDF/generarPDF.php');
    }
    
}
