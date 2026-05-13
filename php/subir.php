<?php
include "conexion.php";

if (!isset($_FILES['imagen'])) {
    exit("No hay imagen enviada");
}

if ($_FILES['imagen']['error'] !== 0) {
    exit("Error al subir archivo");
}

$nombre = $_FILES['imagen']['name'];
$tmp    = $_FILES['imagen']['tmp_name'];

$extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
$permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

if (!in_array($extension, $permitidas)) {
    exit("Tipo de archivo no permitido");
}

$nombre = uniqid('img_', true) . '.' . $extension;
$ruta   = "uploads/" . $nombre;

$carpetaDestino = "C:/xampp/htdocs/galeria/uploads/";
if (!is_dir($carpetaDestino)) {
    mkdir($carpetaDestino, 0755, true);
}

if (move_uploaded_file($tmp, $carpetaDestino . $nombre)) {

    // MARIADB
    $sql = "INSERT INTO imagenes (nombre, ruta) VALUES ('$nombre', '$ruta')";
    $mysql->query($sql);

    // ✅ Debug error MariaDB
    if ($mysql->error) {
        echo "Error MariaDB: " . $mysql->error;
        die();
    }

    // POSTGRESQL
    $stmt = $pg->prepare("
        INSERT INTO imagenes (nombre, ruta)
        VALUES (:nombre, :ruta)
    ");
    $stmt->execute([":nombre" => $nombre, ":ruta" => $ruta]);

    echo "✔ Subido correctamente";

} else {
    exit("✘ Error al mover el archivo");
}
?>