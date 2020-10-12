<?php
require_once 'config.php';
require_once 'models/usuario.php';
require_once 'models/incidencia.php';
require_once 'models/mensaje.php';
require_once 'models/log.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Head</title>
    <meta name="Description" content="head">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>
    <h1>Lista de Usuarios</h1>
    <br>
    <table>
    <tr class="">
      <th>ID</th>
      <th>NIF</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Usuario</th>
      <th>Perfil</th>
      <th>Email</th>
      <th>Fotografia</th>
      <th>Telefono</th>
      <th>Departamento</th>
      <th>Fecha</th>      
    </tr>
    <?php while ($lista = $listado_usuarios->fetch_object()) : ?>
      <tr>
        <td><?= $lista->id; ?></td>
        <td><?= $lista->nif; ?></td>
        <td><?= $lista->nombre; ?></td>
        <td><?= $lista->apellido1 . ' ' . $lista->apellido2; ?></td>
        <td><?= $lista->username; ?></td>        
        <td><?= $lista->perfil; ?></td>
        <td><?= $lista->email; ?></td>
        <td></td>
        <td><?= $lista->telefono; ?></td>
        <td><?= $lista->departamento; ?></td>
        <td><?= $lista->fecha; ?></td>        
      </tr>
    <?php endwhile; ?>
    </table>
    <br>
    <div>
        <h4>Desarrollado por Manuel Jesus Hierro Pinto &copy; <?php echo date('Y') ?></h4>
    </div>
</body>

</html>