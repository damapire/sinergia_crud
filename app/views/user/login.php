<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php 
        if (!empty($error)) echo '<p style="color:red">' . $error . '</p>'; ?>
</body>
</html>
