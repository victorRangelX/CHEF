<?php
session_start();
include __DIR__ . "/config/conexion.php";

header("Content-Type: application/json");

// activar errores (temporal)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["success" => false, "error" => "No autenticado"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["contenido"])) {
    echo json_encode(["success" => false, "error" => "Sin contenido"]);
    exit();
}

$contenido = $data["contenido"];
$usuario_id = $_SESSION['usuario_id'];

// título 
$lineas = explode("\n", $contenido);
$titulo = trim($lineas[0]);

try {
    $sql = "INSERT INTO recetas (usuario_id, titulo, contenido) 
            VALUES (:usuario_id, :titulo, :contenido)";

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":contenido", $contenido);

    $stmt->execute();

    echo json_encode(["success" => true]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}