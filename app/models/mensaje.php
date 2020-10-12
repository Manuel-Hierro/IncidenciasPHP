<?php

class Mensaje
{
    private $id;
    private $usuario_id;
    private $fecha_mensaje;
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

    function getFecha_mensaje()
    {
        return $this->fecha_mensaje;
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

    function setFecha_mensaje($fecha_mensaje)
    {
        $this->fecha_mensaje = $this->db->real_escape_string($fecha_mensaje);
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    /* ADMINISTRADOR */
    public function getMensajes($desde, $por_pagina)
    {
        $mensajes = $this->db->query("SELECT * FROM usuario, mensaje WHERE usuario.id = mensaje.usuario_id LIMIT $desde, $por_pagina");
        return $mensajes;
    }

    public function getMensajesTotales()
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario, mensaje WHERE usuario.id = mensaje.usuario_id");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }

    public function mensaje()
    {
        $sql = "INSERT INTO mensaje VALUES("
            . "NULL,"
            . "'{$this->getId()}',"
            . "CURDATE(),"
            . "'{$this->getDescripcion()}');";
        $mensaje = $this->db->query($sql);

        $result = false;
        if ($mensaje) {
            $result = true;
        }
        return $result;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM mensaje WHERE usuario_id = {$this->usuario_id};";
        $eliminar = $this->db->query($sql);

        $result = false;
        if ($eliminar) {
            $result = true;
        }
        return $result;
    }
    /* ADMINISTRADOR */

    /* PROFESOR */
    public function getMensajes_Profesor($id, $desde, $por_pagina)
    {
        $mensajes = $this->db->query("SELECT * FROM usuario, mensaje WHERE usuario.id = mensaje.usuario_id LIMIT $desde, $por_pagina");
        return $mensajes;
    }

    public function getMensajesTotales_Profesor($id)
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario, mensaje WHERE usuario.id = mensaje.usuario_id");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }
    /* PROFESOR */    
}
