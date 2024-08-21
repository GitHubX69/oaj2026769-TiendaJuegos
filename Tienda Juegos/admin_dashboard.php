<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="ojaestilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p id="top">Panel de Administración</p>
        <nav>
            <ul>
                <li><a href="listar.php">Listar Juegos</a></li>
                <li><a href="agregar.php">Agregar Juego</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Bienvenido al Panel de Administración</h1>
    </main>
    <footer>
        <p>(aquí aparece un anuncio)</p>
    </footer>
</body>
</html>
