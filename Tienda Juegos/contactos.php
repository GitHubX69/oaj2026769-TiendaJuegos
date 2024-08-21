<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
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
        <form id="contacto" onsubmit="alert('Enviado')">
            <legend>Contacto</legend>
            <br>
            <label for="usuario">
                <input type="text" name="nombre" id="usuario" placeholder="Nombre y Apellido">
            </label>
            <br>
            <label for="correo">
                <input type="email" name="email" id="correo" placeholder="Correo Electrónico">
            </label>
            <br>
            <textarea name=“comentario” rows="10" cols="53" placeholder="¡Deja tu comentario!"></textarea>
            <br>
            <p>
                <input class="boton1" type="reset" name="resetear" value="Resetear">
                <input class="boton2" type="submit" name="registrar" value="Entrar">
            </p>
        </form>
    </main>

    <footer>
        <p>(aqui aparece el anuncio)</p>
    </footer>


</body>
</html>