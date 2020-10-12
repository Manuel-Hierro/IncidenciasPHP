<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<div class="table-responsive">
    <table class="table table-striped table-dark text-center">
        <div class="text-center">
        </div>
        <br>
        <tr class="">            
            <th>ID</th>
            <th>NIF</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Username</th>
            <th>Perfil</th>
            <th>Email</th>
            <th>Fotografia</th>
            <th>Telefono</th>
            <th>Departamento</th>
            <th>Fecha</th>
            <th></th>
            <th></th>
        </tr>
        <?php while ($lista = $listado_registros->fetch_object()) : ?>
            <tr>                
                <td><?= $lista->id; ?></td>
                <td><?= $lista->nif; ?></td>
                <td><?= $lista->nombre; ?></td>
                <td><?= $lista->apellido1 . ' ' . $lista->apellido2; ?></td>
                <td><?= $lista->username; ?></td>
                <td><?= $lista->perfil; ?></td>
                <td><?= $lista->email; ?></td>
                <?php if (isset($lista) && is_object($lista) && !empty($lista->fotografia)) : ?>
                    <td><img src="<?= base_url ?>uploads/images/<?= $lista->fotografia ?>" class="miniatura" /></td>
                <?php else : ?>
                    <td></td>
                <?php endif; ?>
                <td><?= $lista->telefono; ?></td>
                <td><?= $lista->departamento; ?></td>
                <td><?= $lista->fecha; ?></td>
                <td>
                    <a class="btn btn-primary" href="<?= base_url ?>registro/aceptar&id=<?= $lista->id ?>"><span class="fas fa-check"></span> Aceptar</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="<?= base_url ?>registro/rechazar&id=<?= $lista->id ?>"><span class="fas fa-times"></span> Rechazar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<!-- MENU DE NAVEGACION INFERIOR (PAGINACION)  -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>registro/registros&pagina=<?= 1 ?>" tabindex="-1" aria-disabled="true">Primero</a>
        </li>
        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>registro/registros&pagina=<?= $pagina - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $total_paginas; $i++) {
            if ($i == $pagina) {
                echo "<li class='page-item disabled'><a class='btn btn-warning'>$i</a></li>";
            } else {
                echo "<li class='page-item'><a class='btn btn-outline-primary' href='registros&pagina=$i'>$i</a></li>";
            }
        } ?>

        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>registro/registros&pagina=<?php echo ($pagina < $total_paginas) ? $pagina + 1 : $pagina = $pagina; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a class="btn btn-outline-primary" href="<?= base_url ?>registro/registros&pagina=<?= $total_paginas ?>">Ultimo</a>
        </li>
    </ul>
</nav>
<!-- MENU DE NAVEGACION INFERIOR (PAGINACION)  -->

<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>

<?php require_once 'includes/footer.php'; ?>