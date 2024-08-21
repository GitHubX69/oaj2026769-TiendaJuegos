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
    // Captura los datos del formulario
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = $_POST['contraseña'];

    // Verifica el email en la base de datos
    $sql = "SELECT id, contraseña, rol FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['rol'] = $row['rol'];

            // Redirigir según el rol del usuario
            if ($row['rol'] == 'Admin') {
                header("Location: admin_dashboard.php");  // Redirige a la página del administrador
            } else {
                header("Location: cliente_dashboard.php");  // Redirige a la página del cliente
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese email.";
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
    <title>Login</title>
    <link rel="stylesheet" href="ojaestilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p id="top">100% de descuento en todos los productos :D!</p>
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
        <form id="login" action="login.php" method="POST">
            <legend>Login</legend>
            <br>
            <label for="correo">
                <input type="email" name="email" id="correo" placeholder="Correo Electrónico" required>
            </label>
            <br>
            <label for="clave">
                <input type="password" name="contraseña" id="clave" placeholder="Contraseña" required>
            </label>
            <br>
            <label for="rol">
                <select name="rol" id="rol" required>
                    <option value="Admin">Admin</option>
                    <option value="Cliente">Cliente</option>
                </select>
            </label>
            <br>
            <p>
                <input class="boton2" type="submit" name="ingresar" value="Ingresar">
            </p>
            <br>
            <span id="registrarse">¿No tienes una cuenta? <a href="paginaderegistro.php">Registrarse</a></span> 
        </form>
    </main>

    <footer>
        <p>(aquí aparece un anuncio)</p>
    </footer>

    <script src="./Js/main.js"></script>
</body>
</html>
