<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Usuario</title>

<style>
       
img {
  
    height: 45px;        
    width: auto;           
    max-width: 100%;     
    position: relative;
    display: inline-block; 
    vertical-align: middle; 

  
    padding: 5px;
    object-fit: contain;  
}
body{
  margin:0;
  font-family: Arial, sans-serif;
  background:#fffdf4;
  color:#2a2a2a;
}

/* HEADER */
header{
  background:#fff;
   padding-bottom: 5px;
border-bottom: 6px solid #FFF9C4;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  align-items:center;
        
}

header h1{
  margin:0;
  font-size:20px;
}

/* CONTENEDOR */
.container{
  padding:40px;
  display:flex;
  justify-content:center;
}

/* CARD */
.card{
  width:100%;
  max-width:500px;
  background:#fff;
        border: 2px solid #fedb64;
border-radius: 8px;
  padding:30px;
  border-radius:20px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

/* TITULO */
.card h2{
  margin-top:0;
  margin-bottom:25px;
}

/* INPUTS */
.input-group{
  margin-bottom:20px;
        
}

.input-group label{
  display:block;
  margin-bottom:8px;
  font-weight:bold;
}

.input-group input,
.input-group select{
  width:100%;
       
  padding:12px;
  border:none;
  border-radius:10px;
  font-size:15px;
  box-sizing:border-box;
          border: 2px solid #fedb64;
}

/* BOTON */
button{
  width:100%;
  padding:15px;
  border:none;
  border-radius:12px;
  background:#fedb64;
  color:white;
  font-size:16px;
  font-weight:bold;
  cursor:pointer;
  transition:0.3s;
}

button:hover{
  background:#d8a31d;
}

/* VOLVER */
.volver{
  display:inline-block;
  margin-top:20px;
  text-decoration:none;
  color:#333;
  font-weight:bold;
}

</style>
</head>

<body>

<header>
   <img src="../img/Nova.png" alt="">
  
</header>

<div class="container">

  <div class="card">

    <h2>Crear nuevo usuario</h2>

    <form action="guardar.php" method="POST">

      <div class="input-group">
        <label>Nombre</label>
        <input type="text" name="nombre" required>
      </div>

      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="input-group">
        <label>Contraseña</label>
        <input type="password" name="password" required>
      </div>

      <div class="input-group">
        <label>Rol</label>

        <select name="rol">

          <option value="usuario">
            Usuario
          </option>

          <option value="admin">
            Admin
          </option>

        </select>

      </div>

      <button type="submit">
        Crear usuario
      </button>

    </form>

    <a class="volver" href="usuarios.php">
      ← Volver a usuarios
    </a>

  </div>

</div>

</body>
</html>