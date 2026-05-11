<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Recetas IA</title>
        
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FZFDDG0FPG"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-FZFDDG0FPG');
</script>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
    }

    /* LADO IZQUIERDO */
    .left {
        width: 50%;
        background: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061') no-repeat center center;
        background-size: cover;
    }

    /* LADO DERECHO */
    .right {
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f4f4f4;
    }

    .login-box {
        width: 350px;
        padding: 40px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 25px;
    }

    .input-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .input-group label {
        font-size: 14px;
        margin-bottom: 5px;
        display: block;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .login-box button {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #FFD54F;
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .login-box button:hover {
        background-color: #e85a2a;
    }

</style>
</head>
<body>
  
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZ5LC27M"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


<div class="left"></div>

<div class="right">
    <div class="login-box">
        <h2>Iniciar Sesión</h2>

        <form action="auth/login.php" method="POST">
            
            <div class="input-group">
                <label for="email">Correo</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Entrar</button>

        </form>
    </div>
</div>

</body>
</html>