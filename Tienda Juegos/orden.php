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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $juego_id = $conn->real_escape_string($_POST['juego_id']);
    $monto_pagado = $conn->real_escape_string($_POST['monto_pagado']);

    // Obtener los detalles del juego seleccionado
    $sql = "SELECT nombre, precio FROM juegos WHERE id='$juego_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_juego = $row['nombre'];
        $precio_juego = $row['precio'];

        // Calcular el cambio
        $cambio = $monto_pagado - $precio_juego;
        
        // Mostrar el recibo
        echo '<h1>Recibo de Compra</h1>';
        echo '<p>Juego: ' . $nombre_juego . '</p>';
        echo '<p>Precio: $' . $precio_juego . '</p>';
        echo '<p>Monto pagado: $' . $monto_pagado . '</p>';
        echo '<p>Cambio: $' . ($cambio >= 0 ? $cambio : '0') . '</p>';
        echo '<p>Gracias por su compra.</p>';
    } else {
        echo "Juego no encontrado.";
    }
}

$conn->close();
?>
