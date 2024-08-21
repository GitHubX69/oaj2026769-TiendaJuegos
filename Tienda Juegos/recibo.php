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

// Obtener el ID de la compra desde la URL
$compra_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($compra_id > 0) {
    // Consultar los detalles de la compra
    $sql_compra = "SELECT c.id_juego, c.nombre_cliente, c.monto_pagado, c.cambio, j.nombre AS juego_nombre, j.precio
                   FROM compras c
                   JOIN juegos j ON c.id_juego = j.id
                   WHERE c.id = '$compra_id'";
    $result_compra = $conn->query($sql_compra);

    if ($result_compra->num_rows > 0) {
        $row = $result_compra->fetch_assoc();
        $juego_nombre = $row['juego_nombre'];
        $precio = $row['precio'];
        $nombre_cliente = $row['nombre_cliente'];
        $monto_pagado = $row['monto_pagado'];
        $cambio = $row['cambio'];
    } else {
        die("Compra no encontrada.");
    }
} else {
    die("ID de compra inválido.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Compra</title>
    <link rel="stylesheet" href="ojaestilo.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .recibo-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        .recibo-container h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .recibo-container p {
            margin: 10px 0;
            font-size: 18px;
            color: #555;
        }

        .recibo-container p strong {
            font-weight: bold;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="recibo-container">
        <h1>Recibo de Compra</h1>
        <p><strong>Cliente:</strong> <?php echo htmlspecialchars($nombre_cliente); ?></p>
        <p><strong>Juego:</strong> <?php echo htmlspecialchars($juego_nombre); ?></p>
        <p><strong>Precio del Juego:</strong> $<?php echo number_format($precio, 2); ?></p>
        <p><strong>Monto Pagado:</strong> $<?php echo number_format($monto_pagado, 2); ?></p>
        <p><strong>Cambio a Devolver:</strong> $<?php echo number_format($cambio, 2); ?></p>
    </div>

    <footer>
        <p>(Aquí aparece un anuncio)</p>
    </footer>
</body>
</html>
