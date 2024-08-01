<?php
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Tu usuario de base de datos
$password = ""; // Tu contraseña de base de datos
$dbname = "dbgifito";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar y ejecutar la consulta
    $sql = "SELECT idUser, nomUser, passUser FROM user WHERE nomUser = ? AND passUser = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idUser, $nomUser, $passUser);
        $stmt->fetch();
        // Las credenciales son correctas, iniciar sesión
        $_SESSION['idUser'] = $idUser;
        $_SESSION['nomUser'] = $nomUser;
        header("Location: proyectofinal.html"); // Redirigir a proyectofinal.html
        exit(); // Detener la ejecución del script después de la redirección
    } else {
        echo "Nombre de usuario o contraseña incorrecta";
    }

    $stmt->close();
}

$conn->close();
?>
