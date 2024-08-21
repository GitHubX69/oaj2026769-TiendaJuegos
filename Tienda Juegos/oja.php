<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="ojaestilo.css">
  
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p id="top">0.01% de descuento en todos los productos :D!</p>
        <div class="empresa">
           
            <span id="titulo">JAMAL GAMES (Tienda De Juegos)</span>
        </div>
        <nav>
        <ul type="none" class="links">
                <li class="items"><a href="index.php">Home</a></li>
                <li class="items"><a href="jijiji.php">Games</a></li>
                <li class="items"><a href="paginaderegistro.php">Ingresar</a></li>
                <li class="items"><a href="contactos.php">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form id="inicioSesion" action="js">
            <legend>Login</legend>
            <br>
            <label for="usuario"> 
                <input type="text" name="nombre" id="usuario" placeholder="Usuario">
            </label>
            <br>
            <label for="clave">
                <input type="password" name="contraseña" id="clave" placeholder="Contraseña">
            </label>
            <br>
            <br>

            <button id="boton" onclick="location.href='jijiji.html'">Entrar</button>
            
            <br>

            <span id="paginaRegistro">Registrarme <a href="paginaderegistro.html">¿No tienes una cuenta? </a></span>
        </form>
    </main>

    <footer>
        <p>(aqui aparece un anuncio)</p>
    </footer>

    <script src="./Js/main.js"></script>

</body>
</html>