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
    <h1>Lista de Incidencias</h1>
    <br>
    <table>
        <tr class="">
            <th>Usuario</th>
            <th>Perfil</th>
            <th>Fecha y Hora</th>
            <th>Prioridad</th>
            <th>Aula</th>
            <th>Asunto</th>
            <th>Descripcion</th>
        </tr>
        <?php while ($lista = $listado_incidencias->fetch_object()) : ?>
            <tr>
                <td><?= $lista->username; ?></td>
                <td><?= $lista->perfil; ?></td>
                <td><?= $lista->fecha_incidencia; ?></td>
                <td><?= $lista->prioridad; ?></td>
                <td><?= $lista->aula; ?></td>
                <td><?= $lista->asunto; ?></td>
                <td><?= $lista->descripcion; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <div>
        <h4>Desarrollado por Manuel Jesus Hierro Pinto &copy; <?php echo date('Y') ?></h4>
    </div>
</body>

</html>