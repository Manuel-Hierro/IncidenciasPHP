<?php

class Incidencia
{

    private $id;
    private $usuario_id;
    private $fecha_incidencia;
    private $prioridad;
    private $aula;
    private $asunto;
    private $descripcion;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function getUsuario_id()
    {
        return $this->usuario_id;
    }

    function getFecha_incidencia()
    {
        return $this->fecha_incidencia;
    }

    function getPrioridad()
    {
        return $this->prioridad;
    }

    function getAula()
    {
        return $this->aula;
    }

    function getAsunto()
    {
        return $this->asunto;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
    }

    function setFecha_incidencia($fecha_incidencia)
    {
        $this->fecha_incidencia = $this->db->real_escape_string($fecha_incidencia);
    }

    function setPrioridad($prioridad)
    {
        $this->prioridad = $this->db->real_escape_string($prioridad);
    }

    function setAula($aula)
    {
        $this->aula = $this->db->real_escape_string($aula);
    }

    function setAsunto($asunto)
    {
        $this->asunto = $this->db->real_escape_string($asunto);
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    /* ADMINISTRADOR */
    public function getIncidencias($desde, $por_pagina)
    {
        $incidencia = $this->db->query("SELECT * FROM usuario, incidencia WHERE usuario.id = incidencia.usuario_id LIMIT $desde, $por_pagina");
        return $incidencia;
    }

    public function getIncidenciasTotales()
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario, incidencia WHERE usuario.id = incidencia.usuario_id");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }

    public function save()
    {
        $sql = "INSERT INTO incidencia VALUES("
            . "NULL,"
            . "'{$this->getUsuario_id()}',"
            . "CURDATE(),"
            . "'{$this->getPrioridad()}',"
            . "'{$this->getAula()}',"
            . "'{$this->getAsunto()}',"
            . "'{$this->getDescripcion()}');";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM incidencia WHERE usuario_id = {$this->usuario_id};";
        $eliminar = $this->db->query($sql);

        $result = false;
        if ($eliminar) {
            $result = true;
        }
        return $result;
    }
    /* ADMINISTRADOR */

    /* PROFESOR */
    public function getIncidencias_Profesor($id, $desde, $por_pagina)
    {
        $incidencia = $this->db->query("SELECT * FROM incidencia WHERE $id = usuario_id LIMIT $desde, $por_pagina");
        return $incidencia;
    }

    public function getIncidenciasTotales_Profesor($id)
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM incidencia WHERE $id = usuario_id");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }    

    public function save_profesor()
    {
        $sql = "INSERT INTO incidencia VALUES("
            . "NULL,"
            . "'{$this->getUsuario_id()}',"
            . "CURDATE(),"
            . "'{$this->getPrioridad()}',"
            . "'{$this->getAula()}',"
            . "'{$this->getAsunto()}',"
            . "'{$this->getDescripcion()}');";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    /* PROFESOR */
}
