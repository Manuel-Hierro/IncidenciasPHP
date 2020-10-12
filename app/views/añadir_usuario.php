<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/nav.php'; ?>

<div class="div3 card-body">

    <!-- INICIO / Comprobar Errores -->
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
        <div class="alert alert-success" align="center">Registro completado</div>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
        <div class="alert alert-danger" align="center">Registro fallido, introduce bien los datos</div>
    <?php endif; ?>
    <?php Utils::deleteSession('register'); ?>
    <!-- FIN / Comprobar Errores -->

    <div class="div6">
        <form action="<?= base_url ?>usuario/añadir_usuario_comprobar" method="POST" enctype="multipart/form-data">
            <!-- NIF -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-edit"></i></span></div>
                <input type="text" class="form-control" name="nif" id="nif" placeholder="Escribe tu NIF     (xxxxxxxx-x)">
            </div>
            <?php if (isset($_SESSION['nif']) && $_SESSION['nif'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El NIF no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('nif'); ?>
            <!-- FIN -->
            <!-- NOMBRE -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-edit"></i></span></div>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe tu Nombre     (Solo letras)">
            </div>
            <?php if (isset($_SESSION['nombre']) && $_SESSION['nombre'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El Nombre no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('nombre'); ?>
            <!-- NOMBRE -->
            <!-- APELLIDO 1 -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-edit"></i></span> </div>
                <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Escribe tu 1º Apellido     (Solo letras)">
            </div>
            <?php if (isset($_SESSION['apellido1']) && $_SESSION['apellido1'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El primer apellido no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('apellido1'); ?>
            <!-- APELLIDO 1 -->
            <!-- APELLIDO 2 -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-edit"></i></span></div>
                <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="Escribe tu 2º Apellido     (Solo letras)">
            </div>
            <?php if (isset($_SESSION['apellido2']) && $_SESSION['apellido2'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El segundo apellido no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('apellido2'); ?>
            <!-- APELLIDO 2 -->
            <!-- USERNAME -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-edit"></i></span></div>
                <input type="text" class="form-control" name="username" id="username" placeholder="Escribe tu Usuario     (Todo)">
            </div>
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El Usuario no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('username'); ?>
            <!-- USERNAME -->
            <!-- PASSWORD -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-unlock-alt"></i></span></div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Escribe tu Contraseña     (Mayuscula, minisculas, numeros, caracteres, tamaño 8 y 12)">
            </div>
            <?php if (isset($_SESSION['password']) && $_SESSION['password'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">La contraseña no es valida</div>
            <?php endif; ?>
            <?php Utils::deleteSession('password'); ?>
            <!-- PASSWORD -->
            <!-- PERFIL -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-tag"></i></span></div>
                <select type="text" class="form-control" name="perfil" id="perfil">
                    <option selected="true" disabled>Seleccione un perfil</option>
                    <option value="administrador">Administrador</option>
                    <option value="profesor">Profesor</option>
                </select>
            </div>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El Perfil no ha sido seleccionado</div>
            <?php endif; ?>
            <?php Utils::deleteSession('perfil'); ?>
            <!-- PERFIL -->
            <!-- EMAIL -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-at"></i></span></div>
                <input type="text" class="form-control" name="email" id="email" placeholder="Escribe tu Email     (xxxx@xxxx.xxx)">
            </div>
            <?php if (isset($_SESSION['email']) && $_SESSION['email'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El email no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('email'); ?>
            <!-- EMAIL -->
            <!-- FOTOGRAFIA -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-image"></i></span></div>
                <?php if (isset($usu) && is_object($usu) && !empty($usu->fotografia)) : ?>
                    <img src="<?= base_url ?>uploads/images/<?= $usu->fotografia ?>" class="miniatura" />
                <?php endif; ?>
                <input type="file" class="form-control" name="fotografia" id="fotografia">
            </div>
            <!-- FOTOGRAFIA -->
            <!-- TELEFONO -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Escribe tu Telefono     ((9/8)xxxxxxxx)">
            </div>
            <?php if (isset($_SESSION['telefono']) && $_SESSION['telefono'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El Telefono no es valido</div>
            <?php endif; ?>
            <?php Utils::deleteSession('telefono'); ?>
            <!-- TELEFONO -->
            <!-- DEPARTAMENTO -->
            <div class="input-group form-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-briefcase"></i></span></div>
                <select type="text" class="form-control" name="departamento" id="departamento">
                    <option selected="true" disabled>Seleccione el Departamento</option>
                    <option value="informatica">Informatica</option>
                    <option value="administraccion">Administraccion</option>
                    <option value="turismo">Turismo</option>
                    <option value="comercio">Comercio</option>
                </select>
            </div>
            <?php if (isset($_SESSION['departamento']) && $_SESSION['departamento'] == 'failed') : ?>
                <div class="alert alert-danger" align="center">El Departamento no ha sido seleccionado</div>
            <?php endif; ?>
            <?php Utils::deleteSession('departamento'); ?>
            <!-- DEPARTAMENTO -->
            <!-- ENVIAR -->
            <div class="form-group text-center">
                <input class="btn btn-outline-primary" type="submit" name="submit" value="Aceptar" class="btn aceptar_registro">
                <a class="btn btn-outline-primary" href="<?= base_url ?>usuario/usuarios">Atras</a>
            </div>
            <!-- ENVIAR -->
        </form>
    </div>
</div>

<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>

<?php require_once 'includes/footer.php'; ?>