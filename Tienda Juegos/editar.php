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

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $imagen = $conn->real_escape_string($_POST['imagen']);

    $sql = "UPDATE juegos SET nombre='$nombre', precio='$precio', imagen='$imagen' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener los datos del juego
$sql = "SELECT * FROM juegos WHERE id=$id";
$result = $conn->query($sql);
$game = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Juego</title>
    <link rel="stylesheet" href="ojaestilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p id="top">0.01% de descuento en todos los productos!</p>
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
        <h1>Editar Juego</h1>
        <form action="editar.php?id=<?php echo $game['id']; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $game['nombre']; ?>" required>
            <br>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo $game['precio']; ?>" required>
            <br>
            <label for="imagen">URL Imagen:</label>
            <input type="text" id="imagen" name="imagen" value="<?php echo $game['imagen']; ?>" required>
            <br>
            <input type="submit" value="Actualizar Juego">
        </form>
    </main>

    <footer>
        <p>(Aquí aparece un anuncio)</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
