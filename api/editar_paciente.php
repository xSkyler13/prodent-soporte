<?php
require_once '../config/config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $id = intval($_POST['id_cliente']);
    $nombre = $_POST['nombre'] ?? '';
    $empresa = $_POST['empresa'] ?? '';
    $correo = $_POST['correo_electronico'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $activo = $_POST['activo'] ?? 1;
    try {
        $stmt = $pdo->prepare('UPDATE pacientes SET nombre = ?, empresa = ?, correo_electronico = ?, telefono = ?, pais = ?, ciudad = ?, activo = ? WHERE id_cliente = ?');
        $ok = $stmt->execute([$nombre, $empresa, $correo, $telefono, $pais, $ciudad, $activo, $id]);
        echo json_encode(['success' => $ok]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Solicitud inválida.']);
}
