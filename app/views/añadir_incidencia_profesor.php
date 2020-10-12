<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<div class="card-body">

    <!-- INICIO / Comprobar Errores -->
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
        <div class="alert alert-success" align="center">Incidencia Creada</div>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
        <div class="alert alert-danger" align="center">Incidencia fallida, introduce bien los datos</div>
    <?php endif; ?>
    <?php Utils::deleteSession('register'); ?>
    <!-- FIN / Comprobar Errores -->

    <div class="">
        <form action="<?= base_url ?>incidencia/añadir_incidencia_comprobar_profesor" method="POST" enctype="multipart/form-data">
            <!-- PRIORIDAD -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"></span></div>
                <select type="text" class="form-control" name="prioridad" id="prioridad">
                    <option selected="true" disabled>Seleccione una Prioridad</option>
                    <option value="Baja">Baja</option>
                    <option value="Media">Media</option>
                    <option value="Alta">Alta</option>
                </select>
            </div>
            <?php if (isset($_SESSION['prioridad']) && $_SESSION['prioridad'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">La prioridad no ha sido seleccionada</div>
            <?php endif; ?>
            <?php Utils::deleteSession('prioridad'); ?>
            <!-- PRIORIDAD -->
            <!-- AULA -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"></span></div>
                <select type="text" class="form-control" name="aula" id="aula">
                    <option selected="true" disabled>Seleccione el Aula</option>
                    <option value="Aula 1">Aula 1</option>
                    <option value="Aula 2">Aula 2</option>
                    <option value="Aula 3">Aula 3</option>
                    <option value="Aula 4">Aula 4</option>
                </select>
            </div>
            <?php if (isset($_SESSION['aula']) && $_SESSION['aula'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El Aula no ha sido seleccionada</div>
            <?php endif; ?>
            <?php Utils::deleteSession('aula'); ?>
            <!-- AULA -->
            <!-- ASUNTO -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"></span></div>
                <input type="text" class="form-control" name="asunto" id="asunto" placeholder="Indica el Asunto     (Solo letras)">
            </div>
            <?php if (isset($_SESSION['asunto']) && $_SESSION['asunto'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El asunto no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('asunto'); ?>
            <!-- ASUNTO -->
            <!-- DESCRIPCION -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"></span></div>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Explica la incidenca     (Solo letras)">
            </div>
            <?php if (isset($_SESSION['descripcion']) && $_SESSION['descripcion'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">La descripcion no es valida</div>
            <?php endif; ?>
            <?php Utils::deleteSession('descripcion'); ?>
            <!-- DESCRIPCION -->
            <!-- ENVIAR -->
            <div class="form-group text-center">
                <input class="btn btn-outline-primary" type="submit" name="submit" value="Aceptar" class="btn aceptar_registro">
                <a class="btn btn-outline-primary" href="<?= base_url ?>incidencia/incidencias_profesor">Atras</a>
            </div>
            <!-- ENVIAR -->
        </form>
    </div>
</div>

<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>

<?php require_once 'includes/footer.php'; ?>