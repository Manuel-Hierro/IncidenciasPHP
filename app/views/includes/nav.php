<link rel="stylesheet" href="<?= base_url ?>../assets/css/nav.css">

<?php if (isset($_SESSION['administrador'])) : ?>
  <nav id="nav1">
    <a class="link1" href="<?= base_url ?>usuario/principal">Inicio</a>
    <a class="link1" href="<?= base_url ?>registro/registros">Registros</a>
    <a class="link1" href="<?= base_url ?>incidencia/incidencias">Incidencias</a>
    <a class="link1" href="<?= base_url ?>usuario/usuarios">Usuarios</a>
    <a class="link1" href="<?= base_url ?>mensaje/mensajes">Mensajes</a>
    <a class="link1" href="<?= base_url ?>log/logs">Logs</a>
    <a class="link1" href="<?= base_url ?>usuario/logout">
      <i class="fas fa-sign-out-alt"></i><?= $_SESSION['identity']->nombre ?>, Cerrar Sesion</a>
  </nav>
<?php elseif (isset($_SESSION['profesor'])) : ?>
  <nav id="nav1">
    <a class="link1" href="<?= base_url ?>usuario/principal">Inicio</a>
    <a class="link1" href="<?= base_url ?>incidencia/incidencias_profesor">Incidencias</a>
    <a class="link1" href="<?= base_url ?>usuario/usuarios_profesor">Usuarios</a>
    <a class="link1" href="<?= base_url ?>mensaje/mensajes_profesor">Mensajes</a>
    <a class="link1" href="<?= base_url ?>usuario/logout">
      <i class="fas fa-sign-out-alt"></i><?= $_SESSION['identity']->nombre ?>, Cerrar Sesion</a>
  </nav>
<?php endif; ?>