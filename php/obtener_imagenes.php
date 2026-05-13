<?php
include "conexion.php";

$stmt = $pg->query("SELECT * FROM imagenes ORDER BY id DESC");
$imagenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($imagenes);
?>