<?php
header('Content-Type: application/json');

// ruta corregida: usa __DIR__ para evitar problemas
require_once __DIR__ . '/../config/config.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido");
    }

    // Sanitizar y validar entradas
    $id       = $_POST['id_usuario'] ?? null;
    $nombre   = $_POST['nombre_completo'] ?? '';
    $email    = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $rol      = $_POST['id_rol'] ?? '';
    $estado   = $_POST['activo'] ?? '';

    if (!$id) {
        throw new Exception("Falta ID de usuario");
    }

    $stmt = $pdo->prepare("
        UPDATE usuarios 
        SET nombre_completo = ?, 
            email = ?, 
            telefono = ?, 
            id_rol = ?,   -- Guardas la relación con roles
            activo = ?
        WHERE id_usuario = ?
    ");
    $ok = $stmt->execute([$nombre, $email, $telefono, $rol, $estado, $id]);

    if (!$ok) {
        throw new Exception("No se pudo actualizar el usuario");
    }

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // siempre devolvemos JSON con el error
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
