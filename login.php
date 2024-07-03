<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="login-container">
    <div class="login-form">

        <h2 class="text-light">Iniciar Sesión</h2>
        <form action="login_action.php" method="post">
            <?php if(isset($_GET['error'])): ?>
                <p class="error">ACCESO DENEGADO</p>
            <?php endif; ?>
            <div class="input-group">
                <input type="text" name="username" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="input-group">
                <button type="submit">Iniciar de sesión</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
