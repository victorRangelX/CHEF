<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    echo "Acceso denegado";
    exit();
}

include __DIR__ . "/../config/conexion.php";

// CONSULTAR USUARIOS
$sql = "SELECT * FROM usuarios ORDER BY id DESC";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Usuarios</title>

<style>

body{
  font-family: Arial;
  background: #fffdf4;
  padding: 30px;
  margin: 0;
}

.topbar{
  display:flex;
  justify-content: space-between;
  align-items:center;
  margin-bottom:20px;
}

.btn-crear{
  background:#ebd725;
  color:white;
  padding:12px 18px;
  border-radius:10px;
  text-decoration:none;
  font-weight:bold;
}

.btn-crear:hover{
  background:#d8a31d;
}

table{
  width:100%;
  border-collapse: collapse;
  background:white;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

th{
  background:#ffe46a;
  padding:15px;
  text-align:left;
}

td{
  padding:15px;
  border-bottom:1px solid #eee;
}

tr:hover{
  background:#fff8d9;
}

.rol-admin{
  color:#c0392b;
  font-weight:bold;
}

.rol-usuario{
  color:#27ae60;
  font-weight:bold;
}

.volver{
  display:inline-block;
  margin-top:20px;
  text-decoration:none;
  color:#333;
  font-weight:bold;
}

</style>
</head>

        
  <script>

async function eliminarUsuario(id){

  const confirmar = confirm("¿Eliminar usuario?");

  if(!confirmar) return;

  const res = await fetch("eliminar_usuario.php", {

    method:"POST",

    headers:{
      "Content-Type":"application/json"
    },

    body: JSON.stringify({ id })

  });

  const data = await res.json();

  if(data.success){

    location.reload();

  }else{

    alert(data.error || "Error");

  }
}

</script>
        
        
<body>

<div class="topbar">

  <h1>Usuarios</h1>

  <a class="btn-crear" href="crear.php">
    + Crear usuario
  </a>

</div>

<table>

<tr>
  <th>ID</th>
  <th>Nombre</th>
  <th>Email</th>
  <th>Rol</th>
  <th>Acciones</th>
</tr>

<?php foreach($usuarios as $usuario): ?>

<tr>

  <td><?php echo $usuario['id']; ?></td>

  <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>

  <td><?php echo htmlspecialchars($usuario['email']); ?></td>

  <td>

    <?php if($usuario['rol'] === 'admin'): ?>

      <span class="rol-admin">
        Admin
      </span>

    <?php else: ?>

      <span class="rol-usuario">
        Usuario
      </span>

    <?php endif; ?>

  </td>
   <td>

<?php if($usuario['id'] != $_SESSION['usuario_id']): ?>

<button 
class="btn-eliminar"
onclick="eliminarUsuario(<?php echo $usuario['id']; ?>)">
🗑 Eliminar
</button>

<?php else: ?>

<span>No disponible</span>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>

<a class="volver" href="../dashboard.php">
← Volver al dashboard
</a>

</body>
</html>