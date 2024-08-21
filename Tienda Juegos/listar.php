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

// Obtener juegos de la base de datos
$sql = "SELECT * FROM juegos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Juegos</title>
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
        <h1>Lista de Juegos</h1>
        <a href="agregar.php">Agregar Nuevo Juego</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['precio']; ?>$</td>
                            <td><img src="<?php echo $row['imagen']; ?>" width="100"></td>
                            <td>
                                <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                                <a href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay juegos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>(Aquí aparece un anuncio)</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
