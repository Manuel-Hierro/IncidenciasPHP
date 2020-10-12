<?php

class Usuario
{
    private $id;
    private $nif;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $username;
    private $password;
    private $perfil;
    private $email;
    private $fotografia;
    private $telefono;
    private $departamento;
    private $fecha;
    private $activo;

    private $db; //Atributo para la Base de Datos

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function getNif()
    {
        return $this->nif;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getApellido1()
    {
        return $this->apellido1;
    }

    function getApellido2()
    {
        return $this->apellido2;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        //return $this->password;
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getPerfil()
    {
        return $this->perfil;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getFotografia()
    {
        return $this->fotografia;
    }

    function getTelefono()
    {
        return $this->telefono;
    }

    function getDepartamento()
    {
        return $this->departamento;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getActivo()
    {
        return $this->activo;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNif($nif)
    {
        $this->nif = $this->db->real_escape_string($nif);
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido1($apellido1)
    {
        $this->apellido1 = $this->db->real_escape_string($apellido1);
    }

    function setApellido2($apellido2)
    {
        $this->apellido2 = $this->db->real_escape_string($apellido2);
    }

    function setUsername($username)
    {
        $this->username = $this->db->real_escape_string($username);
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setPerfil($perfil)
    {
        $this->perfil = $this->db->real_escape_string($perfil);
    }

    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;
    }

    function setTelefono($telefono)
    {
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /* ADMINISTRADOR */
    /* DATOS DE USUARIOS ACTIVOS */
    public function getUsuarios($desde, $por_pagina)
    {
        $usuarios = $this->db->query("SELECT * FROM usuario WHERE username != 'root' AND activo = 1 LIMIT $desde, $por_pagina;");
        return $usuarios;
    }

    public function getUsuariosTotales()
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario WHERE username != 'root' AND activo = 1;");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }
    /* DATOS DE USUARIOS ACTIVOS */
    /* DATOS DE USUARIOS INACTIVOS */
    public function getUsuarios_inactivos($desde, $por_pagina)
    {
        $usuarios = $this->db->query("SELECT * FROM usuario WHERE username != 'root' AND activo = 0 LIMIT $desde, $por_pagina;");
        return $usuarios;
    }

    public function getUsuariosTotales_inactivos()
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario WHERE username != 'root' AND activo = 0;");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }
    /* DATOS DE USUARIOS INACTIVOS */
    /* DATOS DE UN UNICO USUARIO */
    public function getUsuario()
    {
        $usuario = $this->db->query("SELECT * FROM usuario WHERE id = {$this->getId()}");
        return $usuario->fetch_object();
    }
    /* DATOS DE UN UNICO USUARIO */
    /* Hace las comprobaciones pertinentes para verificar los datos del Login */
    public function login()
    {
        $result = false;
        $username = $this->username;
        $password = $this->password;

        // Comprobar si existe el usuario
        $sql = "SELECT * FROM usuario WHERE username = '$username' AND activo = 1";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            //Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }

    /* Guarda los datos introducidos en el formulario */
    public function save()
    {
        $sql = "INSERT INTO usuario VALUES("
            . "NULL,"
            . "'{$this->getNif()}',"
            . "'{$this->getNombre()}',"
            . "'{$this->getApellido1()}',"
            . "'{$this->getApellido2()}',"
            . "'{$this->getUsername()}',"
            . "'{$this->getPassword()}',"
            . "'profesor',"
            . "'{$this->getEmail()}',"
            . "'{$this->getFotografia()}',"
            . "'{$this->getTelefono()}',"
            . "'{$this->getDepartamento()}',"
            . "CURDATE(), 0);";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    /* Guarda los datos introducidos en el formulario */
    public function saveadmin()
    {
        $sql = "INSERT INTO usuario VALUES("
            . "NULL,"
            . "'{$this->getNif()}',"
            . "'{$this->getNombre()}',"
            . "'{$this->getApellido1()}',"
            . "'{$this->getApellido2()}',"
            . "'{$this->getUsername()}',"
            . "'{$this->getPassword()}',"
            . "'{$this->getPerfil()}',"
            . "'{$this->getEmail()}',"
            . "'{$this->getFotografia()}',"
            . "'{$this->getTelefono()}',"
            . "'{$this->getDepartamento()}',"
            . "CURDATE(), 1);";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    /* BOTONES REGISTROS */
    public function aceptar()
    {
        $sql = "UPDATE usuario SET activo = 1 WHERE id = {$this->getId()};";
        $aceptar = $this->db->query($sql);

        $result = false;
        if ($aceptar) {
            $result = true;
        }
        return $result;
    }

    public function rechazar()
    {
        $sql = "DELETE FROM usuario WHERE id = {$this->id};";
        $rechazar = $this->db->query($sql);

        $result = false;
        if ($rechazar) {
            $result = true;
        }
        return $result;
    }
    /* BOTONES REGISTROS */
    /* BOTONES USUARIOS */
    public function edit()
    {
        $sql = "UPDATE usuario SET "
            . "nif='{$this->getNif()}',"
            . "nombre='{$this->getNombre()}',"
            . "apellido1='{$this->getApellido1()}',"
            . "apellido2='{$this->getApellido2()}',"
            . "username='{$this->getUsername()}',"
            . "password='{$this->getPassword()}',"
            . "perfil='{$this->getPerfil()}',"
            . "email='{$this->getEmail()}'";

        if ($this->getFotografia() != null) {
            $sql .= ", fotografia='{$this->getFotografia()}'";
        }

        $sql .= ", telefono='{$this->getTelefono()}'";
        $sql .= ", departamento='{$this->getDepartamento()}'";
        $sql .= "WHERE id = {$this->getId()};";

        $edit = $this->db->query($sql);

        $result = false;
        if ($edit) {
            $result = true;
        }
        return $result;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM usuario WHERE id = {$this->id};";
        $eliminar = $this->db->query($sql);

        $result = false;
        if ($eliminar) {
            $result = true;
        }
        return $result;
    }
    /* BOTONES USUARIOS */
    /* ADMINISTRADOR */

    /* PROFESOR */
    public function getUsuarios_Profesor($desde, $por_pagina)
    {
        $usuarios = $this->db->query("SELECT * FROM usuario WHERE username != 'root' AND activo = 1 LIMIT $desde, $por_pagina;");
        return $usuarios;
    }

    public function getUsuariosTotales_Profesor()
    {
        $sql_register = $this->db->query("SELECT COUNT(*) as 'Total_Registro' FROM usuario WHERE username != 'root' AND activo = 1;");
        $result_register = mysqli_fetch_array($sql_register);
        $total_registro = $result_register['Total_Registro'];

        return $total_registro;
    }
    /* PROFESOR */
}
