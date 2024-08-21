<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda_juegos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los productos
$sql = "SELECT * FROM juegos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAMES</title>
    <link rel="stylesheet" href="ojaestilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p id="top">100% de descuento en todos los productos!</p>
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

    <main id="cards">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <article class="card">
                <img class="fondo" src="<?php echo $row['imagen']; ?>" width="400" height="300" alt="<?php echo $row['nombre']; ?>">
                <h2><?php echo $row['nombre']; ?></h2>
                <p><?php echo $row['precio']; ?>$</p>
                <button class="Comprar">
                    <a href="compra.php?id=<?php echo $row['id']; ?>">Comprar</a>
                </button>
            </article>
        <?php } ?>
    </main>

    <footer id="footerHeroes">
        <p>(Aquí aparece un anuncio)</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
