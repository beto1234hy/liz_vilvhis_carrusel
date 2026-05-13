<?php
include "conexion.php";

if (!isset($_POST['id']) || !isset($_POST['ruta'])) {
    exit("Datos incompletos");
}

$id   = $_POST['id'];
$ruta = $_POST['ruta'];

// Eliminar archivo físico
$archivo = __DIR__ . "/../" . $ruta;
if (file_exists($archivo)) {
    unlink($archivo);
}

// Eliminar de PostgreSQL
$stmt = $pg->prepare("DELETE FROM imagenes WHERE id = :id");
$stmt->execute([":id" => $id]);

echo "✔ Imagen eliminada";
?>