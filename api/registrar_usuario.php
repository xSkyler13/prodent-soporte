<?php
header('Content-Type: application/json');
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['id_rol1']; // aquí debes enviar el ID del rol
    $password = $_POST['pass'];

    // Hashear contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (id_rol, nombre_completo, email, telefono, password_hash) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $ok = $stmt->execute([$rol, $nombre, $email, $telefono, $password_hash]);

        echo json_encode(["success" => $ok]);
    } catch (PDOException $e) {
        echo json_encode([
            "success" => false, 
            "error" => $e->getMessage()
        ]);
    }
}
