<?php require_once 'includes/head.php'; ?>
<?php require_once 'includes/nav.php'; ?>
<br>
<h1 class="text-center">
    Bienvenido Señor <?= $_SESSION['identity']->perfil ?> <?=$_SESSION['identity']->nombre ?>
</h1>
<br>
<p class="text-center">
    Indique que desea hacer a continuacion
</p>
<br>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('delete'); ?>

<?php require_once 'includes/footer.php'; ?>