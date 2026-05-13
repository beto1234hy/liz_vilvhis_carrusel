<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Galería</title>
</head>
<body>
    <h2>Subir imagen</h2>
    <p>Bienvenido, <?= $_SESSION["usuario"] ?> | <a href="logout.php">Cerrar sesión</a></p>

    <form id="formCarrusel" method="post" enctype="multipart/form-data" action="php/subir.php">
        <input type="file" id="imagen" name="imagen" required>
        <button type="submit">Subir</button>
    </form>

    <p id="mensaje"></p>
    <div id="carouselInner"></div>
    <script src="js/carrusel.js"></script>
</body>
</html>