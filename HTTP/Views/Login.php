<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<style>
		body{font-family:Arial,Helvetica,sans-serif;background:#f5f5f5;display:flex;align-items:center;justify-content:center;height:100vh;margin:0}
		.card{background:#fff;padding:24px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.1);width:320px}
		h2{margin:0 0 16px;font-size:20px}
		label{display:block;margin-bottom:6px;font-size:14px}
		input[type="text"],input[type="password"]{width:100%;padding:10px;margin-bottom:12px;border:1px solid #ddd;border-radius:4px}
		.actions{display:flex;align-items:center;justify-content:space-between}
		button{background:#0078d4;color:#fff;border:none;padding:10px 16px;border-radius:4px;cursor:pointer}
		.links{font-size:13px}
		.links a{color:#0078d4;text-decoration:none}
	</style>
</head>
<body>
	<main class="card">
		<h2>Iniciar sesión</h2>
		<form action="/login" method="post" autocomplete="off">
			<div>
				<label for="username">Usuario o correo</label>
				<input type="text" id="username" name="username" required autofocus>
			</div>
			<div>
				<label for="password">Contraseña</label>
				<input type="password" id="password" name="password" required>
			</div>
			<div class="actions">
				<button type="submit">Entrar</button>
				<div class="links"><a href="/forgot">¿Olvidó su contraseña?</a></div>
			</div>
		</form>
	</main>
</body>
</html>
