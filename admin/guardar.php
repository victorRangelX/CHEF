<?php
session_start();

// Bloquear si no es admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit();
}

// Conexión a la base
require_once("../config/conexion.php");

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Hashear contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario en la base
$sql = "INSERT INTO usuarios (nombre, email, password, rol) 
        VALUES (:nombre, :email, :password, :rol)";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(":nombre", $nombre);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $passwordHash);
$stmt->bindParam(":rol", $rol);

$stmt->execute();

// Redirigir al panel de usuarios
header("Location: usuarios.php");
exit();
?>