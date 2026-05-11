<?php
session_start();

include __DIR__ . "/../config/conexion.php";

header("Content-Type: application/json");

// SOLO ADMIN
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {

    echo json_encode([
        "success" => false,
        "error" => "Acceso denegado"
    ]);

    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

// EVITAR BORRARSE A SI MISMO
if ($id == $_SESSION['usuario_id']) {

    echo json_encode([
        "success" => false,
        "error" => "No puedes eliminarte"
    ]);

    exit();
}

$sql = "DELETE FROM usuarios WHERE id = :id";

$stmt = $conexion->prepare($sql);

$stmt->bindParam(":id", $id);

$stmt->execute();

echo json_encode([
    "success" => true
]);
?>