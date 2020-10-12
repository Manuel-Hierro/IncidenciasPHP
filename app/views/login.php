<?php require_once 'includes/head.php'; ?>
<link rel="stylesheet" href="<?= base_url ?>../assets/css/login.css">

<!-- Coprobacion Login -->
<?php if (!isset($_SESSION['identity'])) : ?>
	<?php if (isset($_SESSION['error_login'])) : ?>
		<div class="alert alert-danger" align="center">Identificacion fallida</div>
	<?php endif; ?>
	<?php Utils::deleteSession('error_login'); ?>

	<!-- Coprobacion Registro -->
	<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
		<div class="alert alert-success" align="center">Registro completado</div>
	<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
		<div class="alert alert-danger" align="center">Registro fallido, introduce bien los datos</div>
	<?php endif; ?>
	<?php Utils::deleteSession('register'); ?>	

	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
			<label id="label-1" for="tab-1" class="tab">Login</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up">
			<label id="label-2" for="tab-2" class="tab">Registro</label>

			<div class="login-form">
				<div>
					<form action="<?= base_url ?>usuario/login_comprobar" method="POST">
						<div class="sign-in-htm">
							<div class="group">
								<label for="username" class="label">Nombre de Usuario</label>
								<input type="text" class="input" id="username" name="username" placeholder="Escribe tu Usuario" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username']; } ?>">
							</div>
							<div class="group">
								<label for="password" class="label">Contraseña</label>
								<input type="password" class="input" data-type="password" name="password" id="password" placeholder="Escribe tu Contraseña" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>">
							</div>
							<div class="group">
								<input type="checkbox" id="recuerdame" name="recuerdame" class="check" <?php if(isset($_COOKIE['recuerdame'])){echo "checked";} ?>>
								<label for="recuerdame"><span class="icon"></span> Recuerdame</label>
							</div>
							<div class="group">
								<input type="submit" class="button" name="submit" value="Iniciar Sesion">
							</div>
							<div class="hr"></div>
							<div class="foot-lnk">
								<a href="<?= base_url ?>usuario/email">¿Has olvidado la Contraseña?</a>
							</div>
							<div class="hr"></div>
							<div class="text-center">
								<label class="label">Inicia Sesion con Google o Facebook</label>
							</div>
						</div>
					</form>
				</div>
				<div>
					<form action="<?= base_url ?>usuario/registro_comprobar" method="POST" enctype="multipart/form-data">
						<div class="sign-up-htm recuadro">
							<!-- NIF -->
							<div class="group">
								<label for="nif" class="label">NIF</label>
								<input id="nif" name="nif" type="text" class="input" placeholder="Escribe tu NIF     (xxxxxxxx-x)">
							</div>
							<?php if (isset($_SESSION['nif']) && $_SESSION['nif'] == 'failed'): ?>            
                			<div class="alert alert-danger" align="center">El NIF no es valido</div>
							<?php endif; ?>
							<?php Utils::deleteSession('nif'); ?>
							<!-- NIF -->
							<!-- NOMBRE -->
							<div class="group">
								<label for="nombre" class="label">Nombre</label>
								<input id="nombre" name="nombre" type="text" class="input" placeholder="Escribe tu Nombre     (Solo letras)">
							</div>
							<?php if (isset($_SESSION['nombre']) && $_SESSION['nombre'] == 'failed'): ?>
							<div class="alert alert-danger" align="center">El Nombre no es valido</div>
							<?php endif; ?>
							<?php Utils::deleteSession('nombre'); ?>
							<!-- NOMBRE -->
							<!-- APELLIDO 1 -->			
							<div class="group">
								<label for="apellido1" class="label">Primer Apellido</label>
								<input id="apellido1" name="apellido1" type="text" class="input" placeholder="Escribe tu 1º Apellido     (Solo letras)">
							</div>
							<?php if (isset($_SESSION['apellido1']) && $_SESSION['apellido1'] == 'failed'): ?>
                			<div class="alert alert-danger" align="center">El primer apellido no es valido</div>
							<?php endif; ?>
							<?php Utils::deleteSession('apellido1'); ?>
							<!-- APELLIDO 1 -->
							<!-- APELLIDO 2 -->
							<div class="group">
								<label for="apellido2" class="label">Segundo Apellido</label>
								<input id="apellido2" name="apellido2" type="text" class="input" placeholder="Escribe tu 2º Apellido     (Solo letras)">
							</div>
							<?php if (isset($_SESSION['apellido2']) && $_SESSION['apellido2'] == 'failed'): ?>
							<div class="alert alert-danger" align="center">El segundo apellido no es valido</div>
							<?php endif; ?>
							<?php Utils::deleteSession('apellido2'); ?>
							<!-- APELLIDO 2 -->
							<!-- USERNAME -->
							<div class="group">
								<label for="username" class="label">Nombre de Usuario</label>
								<input id="username" name="username" type="text" class="input" placeholder="Escribe tu Usuario     (Todo)">
							</div>
							<?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'failed'): ?>
							<div class="alert alert-danger" align="center">El Usuario no es valido</div>
							<?php endif; ?>
							<?php Utils::deleteSession('username'); ?>
							<!-- USERNAME -->
							<!-- PASSWORD -->
							<div class="group">
								<label for="password" class="label">Contraseña</label>
								<input id="password" name="password" type="password" class="input" data-type="password" placeholder="Escribe tu Contraseña     (Mayuscula, minisculas, numeros, caracteres, tamaño 8 y 12)">
							</div>
							<?php if (isset($_SESSION['password']) && $_SESSION['password'] == 'failed'): ?>
							<div class="alert alert-danger" align="center">La contraseña no es valida</div>
							<?php endif; ?>
							<?php Utils::deleteSession('password'); ?>
							<!-- PASSWORD -->
							<!-- EMAIL -->
							<div class="group">
								<label for="email" class="label">Correo Electronico</label>
								<input id="email" name="email" type="email" class="input" placeholder="Escribe tu Email     (xxxx@xxxx.xxx)">
							</div>
							<?php if (isset($_SESSION['email']) && $_SESSION['email'] == 'failed'): ?>
                			<div class="alert alert-danger" align="center">El email no es valido</div>
         					<?php endif; ?>
            				<?php Utils::deleteSession('email'); ?>
							<!-- EMAIL -->
							<!-- FOTOGRAFIA -->
							<div class="group">
								<label for="fotografia" class="label">Fotografia</label>
								<input id="fotografia" name="fotografia" type="file" class="input">
							</div>							
							<!-- FOTOGRAFIA -->
							<!-- TELEFONO -->
							<div class="group">
								<label for="telefono" class="label">Telefono</label>
								<input id="telefono" name="telefono" type="text" class="input" placeholder="Escribe tu Telefono     ((9/8)xxxxxxxx)">
							</div>
							<?php if (isset($_SESSION['telefono']) && $_SESSION['telefono'] == 'failed'): ?>
							<div class="alert alert-danger" align="center">El Telefono no es valido</div>
							<?php endif; ?>
							<?php Utils::deleteSession('telefono'); ?>
							<!-- TELEFONO -->
							<!-- DEPARTAMENTO -->
							<div class="group">
								<label for="departamento" class="label">Departamento</label>
								<select id="departamento" name="departamento" type="text" class="form-control">
									<option selected="true" disabled>Seleccione el Departamento</option>
									<option value="informatica">Informatica</option>
									<option value="administraccion">Administraccion</option>
									<option value="turismo">Turismo</option>
									<option value="comercio">Comercio</option>
								</select>
							</div>
							<?php if (isset($_SESSION['departamento']) && $_SESSION['departamento'] == 'failed'): ?>
							<div class="alert alert-danger" align="center">El Departamento no ha sido seleccionado</div>
							<?php endif; ?>
							<?php Utils::deleteSession('departamento'); ?>
							<!-- DEPARTAMENTO -->
							<!-- reCAPTCHA -->            
							<div class="g-recaptcha" data-sitekey="6Ld7z4wUAAAAAJTKKSfKbGI00L-JKH9PF4SWEdoo"></div>      
							<?php if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == 'failed'): ?>
								<div class="alert alert-danger" align="center">Error al comprobar el captcha</div>
							<?php endif; ?>
							<?php Utils::deleteSession('captcha'); ?>
							<!-- reCAPTCHA -->  
							<!-- ENVIAR -->
							<div class="group">
								<input type="submit" class="button" value="Enviar Datos">
							</div>
							<!-- ENVIAR -->
						</div>
					</form>
				</div>
			</div>
			<div id="hr" class="oculto"></div>
			<div id="foot" class="oculto">
				<label id="label-3" for="tab-1">¿Estas ya registrado?</label>
			</div>
		</div>
	</div>
<?php else : ?>
	<?= header("Location:" . base_url . 'usuario/principal'); ?>
<?php endif; ?>

<!-- Footer -->
<?php require_once 'includes/footer.php'; ?>