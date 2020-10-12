<?php

class Log
{
    private $id;
    private $usuario_id;
    private $fecha_log;
    private $accion;
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

    function getFecha_log()
    {
        return $this->fecha_log;
    }

    function getAccion()
    {
        return $this->accion;
    }

    function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
    }

    function setFecha_log($fecha_log)
    {
        $this->fecha_log = $this->db->real_escape_string($fecha_log);
    }

    function setAccion($accion)
    {
        $this->accion = $this->db->real_escape_string($accion);
    }

    /* ADMINISTRADOR */
    public function getLogs($desde, $por_pagina)
    {
        $logs = $this->db->query("SELECT * FROM usuario, log WHERE usuario.id = log.usuario_id LIMIT $desde, $por_pagina");
        return $logs;
    }

    public function getLogsTotales()
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario, log WHERE usuario.id = log.usuario_id");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }

    public function log()
    {
        $sql = "INSERT INTO log VALUES("
            . "NULL,"
            . "'{$this->getId()}',"
            . "CURDATE(),"
            . "'{$this->getAccion()}');";
        $log = $this->db->query($sql);

        $result = false;
        if ($log) {
            $result = true;
        }
        return $result;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM log WHERE usuario_id = {$this->usuario_id};";        
        $eliminar = $this->db->query($sql);

        $result = false;
        if ($eliminar) {
            $result = true;
        }
        return $result;
    }
    /* ADMINISTRADOR */
}
