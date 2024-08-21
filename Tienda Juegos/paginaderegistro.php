<?php
// Configuración de la base de datos
$servername = "localhost";  // Generalmente "localhost" para servidores locales como XAMPP, WAMP, MAMP.
$username = "root";         // Usuario por defecto para servidores locales.
$password = "";             // Por defecto, la contraseña suele estar vacía para servidores locales.
$dbname = "tienda_juegos";  // Nombre de la base de datos que creaste en phpMyAdmin.

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);  // Encriptación de la contraseña
    $pais = $conn->real_escape_string($_POST['paises']);
    $rol = $conn->real_escape_string($_POST['rol']);

    // Verificar si el correo ya está registrado
    $check_email = "SELECT id FROM usuarios WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado. Por favor, utiliza otro.";
    } else {
        // Insertar los datos en la tabla
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, pais, rol) VALUES ('$nombre', '$email', '$contraseña', '$pais', '$rol')";

        if ($conn->query($sql) === TRUE) {
            // Redirigir a la página de login después del registro
            header("Location: login.php");
            exit();  // Asegura que el script se detiene después de la redirección
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Registro</title>
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
        <form id="registro" action="paginaderegistro.php" method="POST">
            <legend>Registro</legend>
            <br>
            <label for="usuario">
                <input type="text" name="nombre" id="usuario" placeholder="Nombre y Apellido" required>
            </label>
            <br>
            <label for="correo">
                <input type="email" name="email" id="correo" placeholder="Correo Electrónico" required>
            </label>
            <br>
            <label for="clave">
                <input type="password" name="contraseña" id="clave" placeholder="Contraseña" required>
            </label>
            <br>
            <select id="opciones" name="paises" required>
                <option value="" selected disabled>País</option>
                <option value="Arg">Argentina</option>
                <option value="Bol">Bolivia</option>
                <option value="Col">Colombia</option>
                <option value="Bra">Brasil</option>
                <option value="Egp">Egipto</option>
            </select>
            <br>
            <label for="rol">Selecciona tu rol:</label>
            <select id="rol" name="rol" required>
                <option value="Cliente" selected>Cliente</option>
                <option value="Admin">Administrador</option>
            </select>
            <br>
            <p>
                <input class="boton1" type="reset" name="resetear" value="Resetear">
                <input class="boton2" type="submit" name="registrar" value="Registrar">
            </p>
            <br>
            <span id="ingresar">¿Ya tienes una cuenta? <a href="login.php">Ingresar</a></span> 
        </form>
    </main>

    <footer>
        <p>(aquí aparece un anuncio)</p>
    </footer>

    <script src="./Js/main.js"></script>
</body>
</html>
