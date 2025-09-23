<?php
require_once "/../config/config.php";

// Conexión a la BD
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$eventos = [];
$resultado = $conexion->query("SELECT id, titulo, fecha_inicio, fecha_fin FROM citas");

while($row = $resultado->fetch_assoc()) {
    $eventos[] = [
        'id' => $row['id'],
        'title' => $row['titulo'],
        'start' => $row['fecha_inicio'],
        'end'   => $row['fecha_fin']
    ];
}

echo json_encode($eventos);