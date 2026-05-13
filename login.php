<?php
session_start();
include "php/conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $mysql->query($sql);
    $fila = $resultado->fetch_assoc();

    if ($fila && password_verify($password, $fila["password"])) {
        $_SESSION["usuario"] = $fila["usuario"];
        header("Location: index.html");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h2>Iniciar sesión</h2>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="usuario" placeholder="Usuario" required><br><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit">Entrar</button>
    </form>

</body>
</html>