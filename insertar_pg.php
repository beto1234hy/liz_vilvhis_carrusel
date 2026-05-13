<?php
include "conexion_pg.php";

$nombre = "imagen_test.jpg";
$ruta = "uploads/imagen_test.jpg";

$sql = "INSERT INTO imagenes (nombre, ruta)
        VALUES (:nombre, :ruta)";

$stmt = $pg->prepare($sql);

$stmt->execute([
    ":nombre" => $nombre,
    ":ruta" => $ruta
]);

echo "Insertado correctamente";
?>