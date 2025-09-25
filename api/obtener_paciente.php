<?php
require_once '../config/config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $id = intval($_POST['id_cliente']);
    try {
        $stmt = $pdo->prepare('SELECT id_cliente, nombre, empresa, correo_electronico, telefono, pais, ciudad, activo FROM pacientes WHERE id_cliente = ?');
        $stmt->execute([$id]);
        $paciente = $stmt->fetch();
        if ($paciente) {
            echo json_encode(['success' => true, 'paciente' => $paciente]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró el paciente.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Solicitud inválida.']);
}
