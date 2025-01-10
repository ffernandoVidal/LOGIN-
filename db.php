<?php
$servername = "localhost";
$username = "root"; 
$password = ""; // Contraseña actualizada
$dbname = "minidb"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>