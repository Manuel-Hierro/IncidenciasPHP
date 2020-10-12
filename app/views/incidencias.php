<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<div class="table-responsive">
    <table class="table table-striped table-dark text-center">
        <div class="text-center">
            <br>
            <a class="btn btn-success text-center" href="<?= base_url ?>incidencia/añadir_incidencia">Añadir Incidencia</a>
            <a class="btn btn-success text-center" href="<?= base_url ?>incidencia/generarPDF">Generar PDF</a>
        </div>
        <br>
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
</div>

<!-- MENU DE NAVEGACION INFERIOR (PAGINACION)  -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>incidencia/incidencias&pagina=<?= 1 ?>" tabindex="-1" aria-disabled="true">Primero</a>
        </li>
        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>incidencia/incidencias&pagina=<?= $pagina - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $total_paginas; $i++) {
            if ($i == $pagina) {
                echo "<li class='page-item disabled'><a class='btn btn-warning'>$i</a></li>";
            } else {
                echo "<li class='page-item'><a class='btn btn-outline-primary' href='incidencias&pagina=$i'>$i</a></li>";
            }
        } ?>

        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>incidencia/incidencias&pagina=<?php echo ($pagina < $total_paginas) ? $pagina + 1 : $pagina = $pagina; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>incidencia/incidencias&pagina=<?= $total_paginas ?>">Ultimo</a>
        </li>
    </ul>
</nav>
<!-- MENU DE NAVEGACION INFERIOR (PAGINACION)  -->

<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>

<?php require_once 'includes/footer.php'; ?>