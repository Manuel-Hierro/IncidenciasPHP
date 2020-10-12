<?php require_once 'includes/head.php'; ?>
<link rel="stylesheet" href="<?= base_url ?>../assets/css/login.css">

<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
		<label id="label-1" for="tab-1" class="tab"></label>
		<input id="tab-2" type="radio" name="tab" class="sign-up">
		<label id="label-2" for="tab-2" class="tab"></label>

		<div class="login-form">
			<div>
				<form action="<?= base_url ?>usuario/enviar_email" method="POST">
					<div class="sign-in-htm">
						<div class="group">
							<label for="destino" class="label">Email de Destino:</label>
							<input type="destino" class="input" type="text" name="destino" id="destino" placeholder="Escribe el Email de Destino">
						</div>
						<div class="group">
							<label for="asunto" class="label">Asunto:</label>
							<input type="asunto" class="input" type="text" name="asunto" id="asunto" placeholder="Escribe el Asunto">
						</div>
						<div class="group">
							<label for="mensaje" class="label">Mensaje:</label>
							<input type="mensaje" class="input" type="email" name="mensaje" id="mensaje" placeholder="Escribe tu mensaje">
						</div>
						<div class="group">
							<input type="submit" class="button" name="submit" value="Enviar Correo">
						</div>
						<div class="hr"></div>
						<div class="group">
							<label for="recuperacion" class="label">Email de Recuperacion:</label>
							<input type="recuperacion" class="input" type="email" name="recuperacion" id="recuperacion" placeholder="Escribe tu Email de Recuperacion">
						</div>
						<div class="group">
							<input type="submit" class="button" name="submit" value="Solicitar Recuperacion">
						</div>
						<div class="group">
							<a href="<?= base_url ?>usuario/login" class="btn btn-outline-success btn-block">Atras</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php require_once 'includes/footer.php'; ?>