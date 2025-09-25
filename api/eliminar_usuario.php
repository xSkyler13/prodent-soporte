<?php
require_once '../config/config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id = intval($_POST['id_usuario']);
    try {
        $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id_usuario = ?');
        $stmt->execute([$id]);
        if ($stmt->rowCount()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró el usuario.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Solicitud inválida.']);
}
