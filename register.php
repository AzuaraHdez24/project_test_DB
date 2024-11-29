<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "library_projectnew"; 

$connection = mysqli_connect($host, $user, $pass, $db_name, 3307);

if (!$connection) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO alumnos (nombre, apellido, telefono, email, contraseña) 
        VALUES ('$name', '$lastname', '$phone', '$email', '$password')";

if (mysqli_query($connection, $sql)) {
    // Redirige al formulario con un mensaje de éxito
    header('Location: formulario.html?status=success');
} else {
    // Redirige al formulario con un mensaje de error
    header('Location: formulario.html?status=error');
}

// Cerrar la conexión
mysqli_close($connection);
?>
