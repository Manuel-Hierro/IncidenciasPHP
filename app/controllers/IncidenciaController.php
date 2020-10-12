<?php
require_once 'models/usuario.php';
require_once 'models/incidencia.php';
require_once 'models/mensaje.php';
require_once 'models/log.php';

class incidenciaController
{

    public function incidencias()
    {
        Utils::isAdministrador('administrador');

        $incidencia = new Incidencia();
        $total_registro = $incidencia->getIncidenciasTotales();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_incidencias = $incidencia->getIncidencias($desde, $por_pagina);

        require_once 'views/incidencias.php';
    }

    public function añadir_incidencia()
    {
        Utils::isAdministrador('administrador');

        require_once 'views/añadir_incidencia.php';
    }

    public function añadir_incidencia_comprobar()
    {
        Utils::isAdministrador('administrador');

        if (isset($_POST)) {

            $prioridad = isset($_POST['prioridad']) ? $_POST['prioridad'] : false;
            $aula = isset($_POST['aula']) ? $_POST['aula'] : false;
            $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar prioridad
            if (!empty($prioridad)) {
                $_SESSION['prioridad'] = "complete";
            } else {
                $_SESSION['prioridad'] = "failed";
                $errores++;
            }
            //Validar aula
            if (!empty($aula)) {
                $_SESSION['aula'] = "complete";
            } else {
                $_SESSION['aula'] = "failed";
                $errores++;
            }
            //Validar asunto
            if (!empty($asunto) && !is_numeric($asunto) && !preg_match("/[0-9]/", $asunto)) {
                $_SESSION['asunto'] = "complete";
            } else {
                $_SESSION['asunto'] = "failed";
                $errores++;
            }
            //Validar descripcion
            if (!empty($descripcion) && !is_numeric($descripcion) && !preg_match("/[0-9]/", $descripcion)) {
                $_SESSION['descripcion'] = "complete";
            } else {
                $_SESSION['descripcion'] = "failed";
                $errores++;
            }

            if (($errores == 0) && $prioridad && $aula && $asunto && $descripcion) {

                $incidencia = new Incidencia();
                $incidencia->setPrioridad($prioridad);
                $incidencia->setAula($aula);
                $incidencia->setAsunto($asunto);
                $incidencia->setDescripcion($descripcion);

                $id = $_SESSION['identity']->id;
                $incidencia->setUsuario_id($id);

                $save = $incidencia->save();

                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }

        header("Location:" . base_url . 'incidencia/añadir_incidencia');
    }

    /* PROFESOR */
    public function incidencias_profesor()
    {
        $id = $_SESSION['identity']->id;

        $incidencia = new Incidencia();
        $total_registro = $incidencia->getIncidenciasTotales_Profesor($id);

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_incidencias_profesor = $incidencia->getIncidencias_Profesor($id, $desde, $por_pagina);

        require_once 'views/incidencias_profesor.php';
    }

    public function añadir_incidencia_profesor()
    {
        require_once 'views/añadir_incidencia_profesor.php';
    }

    public function añadir_incidencia_comprobar_profesor()
    {
        if (isset($_POST)) {

            $prioridad = isset($_POST['prioridad']) ? $_POST['prioridad'] : false;
            $aula = isset($_POST['aula']) ? $_POST['aula'] : false;
            $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar prioridad
            if (!empty($prioridad)) {
                $_SESSION['prioridad'] = "complete";
            } else {
                $_SESSION['prioridad'] = "failed";
                $errores++;
            }
            //Validar aula
            if (!empty($aula)) {
                $_SESSION['aula'] = "complete";
            } else {
                $_SESSION['aula'] = "failed";
                $errores++;
            }
            //Validar asunto
            if (!empty($asunto) && !is_numeric($asunto) && !preg_match("/[0-9]/", $asunto)) {
                $_SESSION['asunto'] = "complete";
            } else {
                $_SESSION['asunto'] = "failed";
                $errores++;
            }
            //Validar descripcion
            if (!empty($descripcion) && !is_numeric($descripcion) && !preg_match("/[0-9]/", $descripcion)) {
                $_SESSION['descripcion'] = "complete";
            } else {
                $_SESSION['descripcion'] = "failed";
                $errores++;
            }

            if (($errores == 0) && $prioridad && $aula && $asunto && $descripcion) {

                $incidencia = new Incidencia();
                $incidencia->setPrioridad($prioridad);
                $incidencia->setAula($aula);
                $incidencia->setAsunto($asunto);
                $incidencia->setDescripcion($descripcion);

                $id = $_SESSION['identity']->id;
                $incidencia->setUsuario_id($id);

                $save = $incidencia->save_profesor();

                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }

        header("Location:" . base_url . 'incidencia/añadir_incidencia_profesor');
    }
    /* PROFESOR */


    public function generarPDF()
    {
        Utils::isAdministrador('administrador');

        $incidencia = new Incidencia();
        $total_registro = $incidencia->getIncidenciasTotales();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_incidencias = $incidencia->getIncidencias($desde, $por_pagina);

        //header("Location:" . base_url . 'generarPDF/generarPDF.php');
        require_once 'generarPDF/generarPDF_Incidencias.php';
        
    }
}
