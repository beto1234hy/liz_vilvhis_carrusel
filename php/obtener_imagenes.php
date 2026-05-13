<?php
include "conexion.php";

$resultado = $mysql->query("SELECT * FROM imagenes ORDER BY id DESC");

$imagenes = [];

while ($fila = $resultado->fetch_assoc()) {
    $imagenes[] = $fila;
}

echo json_encode($imagenes);
?>