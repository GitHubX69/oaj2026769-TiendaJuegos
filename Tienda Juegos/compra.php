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

// Obtener los detalles del juego
$id_juego = $_GET['id'];
$sql = "SELECT * FROM juegos WHERE id = $id_juego";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Juego no encontrado.");
}

$juego = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cliente = $conn->real_escape_string($_POST['nombre_cliente']);
    $pago_cliente = floatval($_POST['pago_cliente']);
    $precio_juego = floatval($juego['precio']);

    // Validar en el servidor que el pago no sea menor que el precio
    if ($pago_cliente < $precio_juego) {
        die("El monto pagado no puede ser menor que el precio del juego.");
    }

    $cambio = $pago_cliente - $precio_juego;
    
    // Registrar la compra en la base de datos
    $sql_insert = "INSERT INTO compras (id_juego, nombre_cliente, monto_pagado, cambio) VALUES ('$id_juego', '$nombre_cliente', '$pago_cliente', '$cambio')";

    if ($conn->query($sql_insert) === TRUE) {
        $recibo_url = "recibo.php?id=" . $conn->insert_id;
        header("Location: $recibo_url");
        exit();  // Asegura que el script se detiene después de la redirección
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra - <?php echo htmlspecialchars($juego['nombre']); ?></title>
    <link rel="stylesheet" href="ojaestilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p id="top">   0.01% de descuento en todos los productos!</p>
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
        <article class="card">
            <img class="fondo" src="<?php echo htmlspecialchars($juego['imagen']); ?>" width="400" height="300" alt="Fondo de Juego">
            <h2><?php echo htmlspecialchars($juego['nombre']); ?></h2>
            <p><?php echo htmlspecialchars($juego['precio']); ?>$</p>
        </article>

        <form id="compra" action="compra.php?id=<?php echo $id_juego; ?>" method="POST">
            <legend>Realizar Compra</legend>
            <label for="nombre_cliente">
                <input type="text" name="nombre_cliente" id="nombre_cliente" placeholder="Nombre del Cliente" required>
            </label>
            <br>
            <label for="pago_cliente">
                <input type="number" name="pago_cliente" id="pago_cliente" placeholder="Monto Pagado" step="0.01" required>
            </label>
            <br>
            <input class="boton2" type="submit" value="Comprar">
        </form>
    </main>

    <footer id="footerHeroes">
        <p>(Aquí aparece un anuncio)</p>
    </footer>
</body>
</html>
