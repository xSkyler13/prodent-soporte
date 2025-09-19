<?php
header("Content-Type: application/json; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', 0);   // 🚫 No mostrar errores en pantalla
ini_set('log_errors', 1);       // ✅ Guardar en log
ini_set('error_log', __DIR__ . "/../error.log"); // log en /api/error.log
session_start();

require_once __DIR__ . "/../config/config.php"; // tu conexión PDO

// Leer datos JSON del body
$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "Por favor, introduce tu email y contraseña."
    ]);
    exit;
}

try {
    // Buscar el usuario en la BD
    $stmt = $pdo->prepare("SELECT id_usuario, id_rol, email, password_hash FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute([":email" => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        echo json_encode(['success' => false, 'message' => 'Credenciales inválidas']);
        exit;
    }

    // ✅ Guardar sesión
    $_SESSION['user_id'] = $user['id_usuario'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['rol']     = $user['id_rol'];

    echo json_encode([
        "success" => true,
        "message" => "Login exitoso.",
        "redirect" => "../modules/views/index.php" // aquí mandamos a tu dashboard
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error en el servidor: " . $e->getMessage()
    ]);
}
