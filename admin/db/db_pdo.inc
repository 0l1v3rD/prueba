<?php
    $host = "localhost";  // Servidor
    $nombreBD = "videojuegos";  // Base de datos
    $usuario = "root";  // Usuario
    $password = ""; // Contraseña
    $dsn = "mysql:host=$host;dbname=$nombreBD";
    try {   // Crear conexión 
        $pdo = new PDO($dsn, $usuario, $password);
    } catch (\PDOException $e) {
     // La conexión falló
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>