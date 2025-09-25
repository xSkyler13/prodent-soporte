<?php
require_once '../config/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("SELECT u.id_usuario,
                            u.nombre_completo,
                            u.email,
                            u.telefono,
                            u.activo,
                            u.id_rol,
                            r.nombre_rol
                        FROM usuarios u
                        JOIN roles r ON u.id_rol = r.id_rol
                        WHERE u.id_usuario = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($usuario);
}