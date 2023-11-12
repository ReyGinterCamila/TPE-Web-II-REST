<?php
require_once 'config.php';

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=" . HOST, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . NAME);

    // Cerrar la conexión inicial
    $pdo = null;

    // Volver a conectar con la nueva base de datos
    $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . NAME, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si las tablas existen
    $tables = array("categoria", "usuario", "producto");

    foreach ($tables as $table) {
        $checkTable = $pdo->query("SHOW TABLES LIKE '$table'");

        if ($checkTable->rowCount() == 0) {
            // Si la tabla no existe, leer el archivo SQL y ejecutarlo
            $sql = file_get_contents('articulos.sql');
            $pdo->exec($sql);
            break;
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
