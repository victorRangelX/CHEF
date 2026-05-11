<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

include __DIR__ . "/config/conexion.php";

// CONSULTA RECETAS
if ($_SESSION['rol'] === 'admin') {

    $sql = "SELECT * FROM recetas ORDER BY id DESC LIMIT 10";

    $stmt = $conexion->prepare($sql);

} else {

    $sql = "SELECT * FROM recetas 
            WHERE usuario_id = :usuario_id 
            ORDER BY id DESC LIMIT 10";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":usuario_id", $_SESSION['usuario_id']);
}

$stmt->execute();

$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

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
        
        
body {

        
    
 
  margin: 0;
  font-family: Arial, sans-serif;
  background: #ffffff;
  color: #2a2a2a;

}

/* recetas */
.recetas-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

.receta-card {
    background: #fff;
  border: 2px solid #fedb64;
  padding: 20px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.receta-card h3 {
  margin-top: 0;
        
  color: #333;
}       
        
  .contenido-receta {
  margin-top: 10px;
  color: #555;
  line-height: 1.5;
}

.btn-receta {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 15px;
  background: #fedb64;
  color: white;
  text-decoration: none;
  border-radius: 10px;
  font-weight: bold;
  transition: 0.3s;
        border-style: none;
}

.btn-receta:hover {
  background: #d8a31d;
}
        
  /* HEADER */      
header {
  background: #fff;
  border-bottom: 10px solid #fedb64;
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header h1 {
  margin: 0;
  font-size: 20px;
}

header a {
  color: #000000;
  text-decoration: none;
}

/* CONTENEDOR */
.container {
  padding: 30px;
}

/* TARJETAS */
.card {
  background: #fff;
  border: 6px solid #fedb64;
  padding: 20px;
  border-radius: 15px;
  margin-bottom: 20px;
}

/* BOTONES */
.menu {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 15px;
  margin-top: 20px;
}

.menu a {
  text-decoration: none;
  padding: 15px;
  border-radius: 12px;
  text-align: center;
  font-weight: bold;
  background: #fedb64;
  color: white;
  transition: 0.3s;
}

.menu a:hover {
  background: #d8a31d;
}
        
        
        
        .modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
}

.modal-content {
  background: white;
  margin: 5% auto;
  padding: 30px;
  width: 80%;
  max-width: 700px;
  border-radius: 20px;
  max-height: 80vh;
  overflow-y: auto;
}

.cerrar {
  float: right;
  font-size: 30px;
  cursor: pointer;
}

#modalContenido {
  margin-top: 20px;
  line-height: 1.8;
  white-space: pre-line;
}
</style>
</head>
        
        
  <!-- MODAL -->
<div id="modalReceta" class="modal">

  <div class="modal-content">

    <span class="cerrar" onclick="cerrarModal()">&times;</span>

    <h2 id="modalTitulo"></h2>

    <div id="modalContenido"></div>

  </div>

</div>      
        
        
    <script>

function abrirModal(titulo, contenido){

  document.getElementById("modalTitulo").innerText = titulo;

  document.getElementById("modalContenido").innerText = contenido;

  document.getElementById("modalReceta").style.display = "block";
}

function cerrarModal(){

  document.getElementById("modalReceta").style.display = "none";
}

</script>    
        

<body>

<header>
   <img src="../img/Nova.png" alt="">
  <a href="auth/logout.php">Cerrar sesión</a>
</header>

<div class="container">

  <div class="card">
    <h2>Bienvenido a Nova,  <?php echo $_SESSION['nombre']; ?></h2>
    <p>tu herramienta de inteligencia artifical para crear recetas!!</p>
    <p>te encuentras logeado como : <?php echo $_SESSION['rol']; ?></p>
  </div>

  <?php if ($_SESSION['rol'] === 'admin'): ?>

    <div class="card">
      <h2>Panel de Administración</h2>

      <div class="menu">
        <a href="admin/usuarios.php"> Usuarios</a>
       	<a href="chat.html"> Crear nueva receta</a>
        <a href="land.html"> Volver al inicio</a>
      </div>
    </div>

  <?php else: ?>

    <div class="card">
      <h2>Panel de Usuario</h2>
		<p>Que realizaremos el dia de hoy</p>
      <div class="menu">
              
        <a href="land.html"> volver cerrar y volver al landingpage</a>
        <a href="chat.html"> Crear nueva receta</a>
     
    
      </div>
    </div>

  <?php endif; ?>

</div>
        
  <div class="card">

  <h2>
    <?php if ($_SESSION['rol'] === 'admin'): ?>
      Últimas recetas del sistema
    <?php else: ?>
      Mis recetas
    <?php endif; ?>
  </h2>

  <div class="recetas-grid">

    <?php foreach($recetas as $receta): ?>

      <div class="receta-card">

        <h3>
          <?php echo htmlspecialchars($receta['titulo']); ?>
        </h3>

        <div class="contenido-receta">

          <?php
            $preview = substr(strip_tags($receta['contenido']), 0, 120);
            echo htmlspecialchars($preview);
          ?>...

        </div>

       

        <div class="fecha">
          <?php echo $receta['fecha']; ?>
        </div>

              
               <button 
        class="btn-receta"
        onclick="abrirModal(
        `<?php echo htmlspecialchars($receta['titulo'], ENT_QUOTES); ?>`,
        `<?php echo htmlspecialchars($receta['contenido'], ENT_QUOTES); ?>`
        )">
        Ver receta
        </button>
      </div>

    <?php endforeach; ?>

  </div>

</div>

</body>
</html>