<?php
require_once "/../config/config.php";

// Consulta de citas
$sql = "SELECT id, asunto, fecha_inicio, fecha_fin FROM citas";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['asunto'],
        'start' => $row['fecha_inicio'],
        'end'   => $row['fecha_fin']
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
