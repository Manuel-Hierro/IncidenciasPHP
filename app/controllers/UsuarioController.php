<?php
require_once 'models/usuario.php';
require_once 'models/incidencia.php';
require_once 'models/mensaje.php';
require_once 'models/log.php';

class usuarioController
{
    /* Carga la vista del Login */
    public function login()
    {
        require_once 'views/login.php';
    }

    /* Carga la comprobacion del Login */
    public function login_comprobar()
    {
        if (isset($_POST)) {

            $usuario = new Usuario();
            $usuario->setUsername($_POST['username']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();

            if ($identity && is_object($identity)) {
                //Creamos una variable global con los datos del usuario
                $_SESSION['identity'] = $identity;

                /* Comprobamos si el que Inicia sesion es un profesor o un administrador */
                if ($identity->perfil == 'administrador') {
                    $_SESSION['administrador'] = true;
                } elseif ($identity->perfil == 'profesor') {
                    $_SESSION['profesor'] = true;
                }

                /* Añadimos la accion a la tabla de log */
                $id = $_SESSION['identity']->id;
                $log = new Log();
                $log->setId($id);
                $log->setAccion('login');
                $log->log();

                //Creamos un par de cookies para recordar el user/pass. Tiempo de caducidad = 15días
                // Si está seleccioniado el checkbox...
                if (isset($_POST['recuerdame']) && ($_POST['recuerdame'] == "on")) {
                    // Creamos las cookies para ambas variables 
                    setcookie('username', $_POST['username'], time() + (15 * 24 * 60 * 60));
                    setcookie('password', $_POST['password'], time() + (15 * 24 * 60 * 60));
                    setcookie('recuerdame', $_POST['recuerdame'], time() + (15 * 24 * 60 * 60));
                } else {
                    // Eliminamos las cookies
                    if (isset($_COOKIE['username'])) {
                        setcookie('username', "");
                    }
                    if (isset($_COOKIE['password'])) {
                        setcookie('password', "");
                    }
                    if (isset($_COOKIE['recuerdame'])) {
                        setcookie('recuerdame', "");
                    }
                }
            } else {
                $_SESSION['error_login'] = "Identificacion fallida";
            }
        }
        /* Vuelve a cargar la vista del login donde se mostraran los resultados de la comprobacion */
        header("Location:" . base_url . 'usuario/login');
    }    

    /* Comprueba el formualrio de Registro y añade un Usuario si todo va bien */
    public function registro_comprobar()
    {
        if (isset($_POST)) {

            $nif = isset($_POST['nif']) ? $_POST['nif'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : false;
            $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            /* ----- captcha ----- */
            $captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;
            $secret = '6Ld7z4wUAAAAABWz134Si2_gUx7aUfI8f5chRpbz';
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
            $arr = json_decode($response, TRUE);
            /* ----- captcha ----- */

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar nif
            if (!empty($nif) && preg_match("/[0-9]{8}-[A-Z]/", $nif)) {
                $_SESSION['nif'] = "complete";
            } else {
                $_SESSION['nif'] = "failed";
                $errores++;
            }
            //Validar nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['nombre'] = "complete";
            } else {
                $_SESSION['nombre'] = "failed";
                $errores++;
            }
            //Validar apellido1
            if (!empty($apellido1) && !is_numeric($apellido1) && !preg_match("/[0-9]/", $apellido1)) {
                $_SESSION['apellido1'] = "complete";
            } else {
                $_SESSION['apellido1'] = "failed";
                $errores++;
            }
            //Validar apellido2
            if (!empty($apellido2) && !is_numeric($apellido2) && !preg_match("/[0-9]/", $apellido2)) {
                $_SESSION['apellido2'] = "complete";
            } else {
                $_SESSION['apellido2'] = "failed";
                $errores++;
            }
            //Validar username
            if (!empty($username)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar password
            if (!empty($password) && preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $password)) {
                $_SESSION['password'] = "complete";
            } else {
                $_SESSION['password'] = "failed";
                $errores++;
            }
            //Validar email
            if (!empty($email) && preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email)) {
                $_SESSION['email'] = "complete";
            } else {
                $_SESSION['email'] = "failed";
                $errores++;
            }
            //Validar telefono
            if (!empty($telefono) && preg_match("/^(\+34|0034|34)?[8|9][0-9]{8}$/", $telefono)) {
                $_SESSION['telefono'] = "complete";
            } else {
                $_SESSION['telefono'] = "failed";
                $errores++;
            }
            //Validar departamento
            if (!empty($departamento)) {
                $_SESSION['departamento'] = "complete";
            } else {
                $_SESSION['departamento'] = "failed";
                $errores++;
            }
            //Validar CAPTCHA
            if ($arr['success']) {
                $_SESSION['captcha'] = "complete";
            } else {
                $_SESSION['captcha'] = "failed";
            }

            if (($errores == 0) && $nif && $nombre && $apellido1 && $apellido2 && $username && $password && $email && $telefono && $departamento  && $arr) {

                $usuario = new Usuario();
                $usuario->setNif($nif);
                $usuario->setNombre($nombre);
                $usuario->setApellido1($apellido1);
                $usuario->setApellido2($apellido2);
                $usuario->setUsername($username);
                $usuario->setPassword($password);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setDepartamento($departamento);

                //Guardar la imagen
                $file = $_FILES['fotografia'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    $usuario->setFotografia($filename);
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                }

                //Llamamos a la funcion para guardar el usuario
                $save = $usuario->save();

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
        header("Location:" . base_url . 'usuario/login');
    }    

    public function principal()
    {
        require_once 'views/principal.php';
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['administrador'])) {
            unset($_SESSION['administrador']);
        } elseif (isset($_SESSION['profesor'])) {
            unset($_SESSION['profesor']);
        }
        require_once 'views/login.php';
    }

    public function edit()
    {
        if (isset($_POST)) {

            $nif = isset($_POST['nif']) ? $_POST['nif'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : false;
            $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar nif
            if (!empty($nif) && preg_match("/[0-9]{8}-[A-Z]/", $nif)) {
                $_SESSION['nif'] = "complete";
            } else {
                $_SESSION['nif'] = "failed";
                $errores++;
            }
            //Validar nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['nombre'] = "complete";
            } else {
                $_SESSION['nombre'] = "failed";
                $errores++;
            }
            //Validar apellido1
            if (!empty($apellido1) && !is_numeric($apellido1) && !preg_match("/[0-9]/", $apellido1)) {
                $_SESSION['apellido1'] = "complete";
            } else {
                $_SESSION['apellido1'] = "failed";
                $errores++;
            }
            //Validar apellido2
            if (!empty($apellido2) && !is_numeric($apellido2) && !preg_match("/[0-9]/", $apellido2)) {
                $_SESSION['apellido2'] = "complete";
            } else {
                $_SESSION['apellido2'] = "failed";
                $errores++;
            }
            //Validar username
            if (!empty($username)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar password
            if (!empty($password) && preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $password)) {
                $_SESSION['password'] = "complete";
            } else {
                $_SESSION['password'] = "failed";
                $errores++;
            }
            //Validar email
            if (!empty($email) && preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email)) {
                $_SESSION['email'] = "complete";
            } else {
                $_SESSION['email'] = "failed";
                $errores++;
            }
            //Validar telefono
            if (!empty($telefono) && preg_match("/^(\+34|0034|34)?[8|9][0-9]{8}$/", $telefono)) {
                $_SESSION['telefono'] = "complete";
            } else {
                $_SESSION['telefono'] = "failed";
                $errores++;
            }
            //Validar departamento
            if (!empty($departamento)) {
                $_SESSION['departamento'] = "complete";
            } else {
                $_SESSION['departamento'] = "failed";
                $errores++;
            }

            if (($errores == 0) || $nif || $nombre || $apellido1 || $apellido2 || $username || $password || $perfil || $email || $telefono || $departamento) {

                $usuario = new Usuario();
                $usuario->setNif($nif);
                $usuario->setNombre($nombre);
                $usuario->setApellido1($apellido1);
                $usuario->setApellido2($apellido2);
                $usuario->setUsername($username);
                $usuario->setPassword($password);
                $usuario->setPerfil($perfil);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setDepartamento($departamento);

                //Guardar la imagen
                if (isset($_FILES['fotografia'])) {
                    $file = $_FILES['fotografia'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $usuario->setFotografia($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuario->setId($id);

                    $edit = $usuario->edit();
                }

                if ($edit) {
                    $_SESSION['register'] = "complete";

                    /* Añadimos la accion a la tabla de log */
                    $id = $_SESSION['identity']->id;
                    $log = new Log();
                    $log->setId($id);
                    $log->setAccion('editar');
                    $log->log();
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:" . base_url . 'usuario/usuarios');
    } 
    
    public function añadir_usuario()
    {
        Utils::isAdministrador('administrador');        

        require_once 'views/añadir_usuario.php';
    }

    public function añadir_usuario_comprobar()
    {
        Utils::isAdministrador('administrador');

        if (isset($_POST)) {

            $nif = isset($_POST['nif']) ? $_POST['nif'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : false;
            $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;           

            /* -------------------- Validar los datos -------------------- */

            $errores = 0;

            //Validar nif
            if (!empty($nif) && preg_match("/[0-9]{8}-[A-Z]/", $nif)) {
                $_SESSION['nif'] = "complete";
            } else {
                $_SESSION['nif'] = "failed";
                $errores++;
            }
            //Validar nombre
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $_SESSION['nombre'] = "complete";
            } else {
                $_SESSION['nombre'] = "failed";
                $errores++;
            }
            //Validar apellido1
            if (!empty($apellido1) && !is_numeric($apellido1) && !preg_match("/[0-9]/", $apellido1)) {
                $_SESSION['apellido1'] = "complete";
            } else {
                $_SESSION['apellido1'] = "failed";
                $errores++;
            }
            //Validar apellido2
            if (!empty($apellido2) && !is_numeric($apellido2) && !preg_match("/[0-9]/", $apellido2)) {
                $_SESSION['apellido2'] = "complete";
            } else {
                $_SESSION['apellido2'] = "failed";
                $errores++;
            }
            //Validar username
            if (!empty($username)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar password
            if (!empty($password) && preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $password)) {
                $_SESSION['password'] = "complete";
            } else {
                $_SESSION['password'] = "failed";
                $errores++;
            }
            //Validar perfil
            if (!empty($perfil)) {
                $_SESSION['username'] = "complete";
            } else {
                $_SESSION['username'] = "failed";
                $errores++;
            }
            //Validar email
            if (!empty($email) && preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email)) {
                $_SESSION['email'] = "complete";
            } else {
                $_SESSION['email'] = "failed";
                $errores++;
            }
            //Validar telefono
            if (!empty($telefono) && preg_match("/^(\+34|0034|34)?[8|9][0-9]{8}$/", $telefono)) {
                $_SESSION['telefono'] = "complete";
            } else {
                $_SESSION['telefono'] = "failed";
                $errores++;
            }
            //Validar departamento
            if (!empty($departamento)) {
                $_SESSION['departamento'] = "complete";
            } else {
                $_SESSION['departamento'] = "failed";
                $errores++;
            }            

            if (($errores == 0) && $nif && $nombre && $apellido1 && $apellido2 && $username && $password && $perfil && $email && $telefono && $departamento) {

                $usuario = new Usuario();
                $usuario->setNif($nif);
                $usuario->setNombre($nombre);
                $usuario->setApellido1($apellido1);
                $usuario->setApellido2($apellido2);
                $usuario->setUsername($username);
                $usuario->setPassword($password);
                $usuario->setPerfil($perfil);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setDepartamento($departamento);

                //Guardar la imagen
                $file = $_FILES['fotografia'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    $usuario->setFotografia($filename);
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                }

                //Llamamos a la funcion para guardar el usuario
                $save = $usuario->saveadmin();

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
       
        header("Location:" . base_url . 'usuario/añadir_usuario');
    }    

    public function editar()
    {
        Utils::isAdministrador('administrador');

        $_SESSION['edit'] = 'edit';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);

            $usu = $usuario->getUsuario();

            require_once 'views/editar.php';
        } 
    }

    public function eliminar()
    {
        Utils::isAdministrador('administrador');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $incidencia = new Incidencia();
            $incidencia->setUsuario_id($id);
            $delete_incidencia = $incidencia->eliminar();

            $mensaje = new Mensaje();
            $mensaje->setUsuario_id($id);
            $delete_mensaje = $mensaje->eliminar();

            $log = new Log();
            $log->setUsuario_id($id);
            $delete_log = $log->eliminar();

            $usuario = new Usuario();
            $usuario->setId($id);
            $delete = $usuario->eliminar();

            if ($delete && $delete_incidencia && $delete_mensaje && $delete_log) {

                $_SESSION['delete'] = 'complete';

                /* Añadimos la accion a la tabla de log */
                $id = $_SESSION['identity']->id;
                $log = new Log();
                $log->setId($id);
                $log->setAccion('borrar');
                $log->log();
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . 'usuario/usuarios');
    }

    /* LINKS DE LA BARRA DE NAVEGACION */
       

    public function usuarios()
    {
        Utils::isAdministrador('administrador');

        $usuario = new Usuario();
        $total_registro = $usuario->getUsuariosTotales();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_usuarios = $usuario->getUsuarios($desde, $por_pagina);

        require_once 'views/usuarios.php';
    }       

    public function usuarios_profesor()
    {
        $usuario = new Usuario();
        $total_registro = $usuario->getUsuariosTotales_Profesor();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_usuarios = $usuario->getUsuarios_Profesor($desde, $por_pagina);

        require_once 'views/usuarios_profesor.php';
    }   

    public function email()
    {
        require_once 'views/email.php';
    }

    public function enviar_email()
    {
        $dest = filter_input(INPUT_POST, 'destino');
        $asun = filter_input(INPUT_POST, 'asunto');
        $mens = filter_input(INPUT_POST, 'mensaje');

        if (mail($dest, $asun, $mens)) {
            require_once 'views/email.php';
        }
    }

    public function generarPDF()
    {
        Utils::isAdministrador('administrador');

        $usuario = new Usuario();
        $total_registro = $usuario->getUsuariosTotales();

        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $listado_usuarios = $usuario->getUsuarios($desde, $por_pagina);
        
        //header("Location:" . base_url . 'generarPDF/generarPDF.php');
        require_once 'generarPDF/generarPDF_Usuarios.php';
    }
}
