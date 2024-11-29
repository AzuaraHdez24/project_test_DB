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

$message = ""; // Variable para almacenar mensajes dinámicos

// Procesar datos cuando el formulario se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $apellido_usuario = $_POST['apellido_usuario'];
    $correo_usuario = $_POST['correo_usuario'];
    $id_libro = $_POST['libro'];

    // Validar si el usuario existe
    $sql_usuario = "SELECT id_alumno FROM alumnos WHERE nombre = '$nombre_usuario' AND apellido = '$apellido_usuario' AND email = '$correo_usuario'";
    $resultado_usuario = mysqli_query($connection, $sql_usuario);

    if (!$resultado_usuario) {
        $message = "<div class='error'>Error en la consulta de usuario: " . mysqli_error($connection) . "</div>";
    } else {
        if (mysqli_num_rows($resultado_usuario) > 0) {
            $usuario = mysqli_fetch_assoc($resultado_usuario);
            $id_usuario = $usuario['id_alumno'];

            // Verificar si el libro está disponible (estado = 1)
            $sql_verificar_libro = "SELECT disponible FROM libros WHERE id_libro = $id_libro";
            $resultado_libro = mysqli_query($connection, $sql_verificar_libro);

            if (!$resultado_libro) {
                $message = "<div class='error'>Error al verificar el libro: " . mysqli_error($connection) . "</div>";
            } else {
                if (mysqli_num_rows($resultado_libro) > 0) {
                    $libro = mysqli_fetch_assoc($resultado_libro);

                    if ($libro['disponible'] == 1) { // Si el libro está disponible
                        // Registrar el préstamo
                        $sql_prestamo = "INSERT INTO prestamos (id_alumno, id_libro, fecha_prestamo, hora_prestamo) 
                                         VALUES ($id_usuario, $id_libro, NOW(), CURTIME())";

                        if (mysqli_query($connection, $sql_prestamo) === TRUE) {
                            // Actualizar estado del libro a "No Disponible" (0)
                            $sql_actualizar_libro = "UPDATE libros SET disponible = 0 WHERE id_libro = $id_libro";
                            mysqli_query($connection, $sql_actualizar_libro);

                            $message = "<div class='success-message'>¡Préstamo registrado con éxito!</div>";
                        } else {
                            $message = "<div class='error'>Error al registrar el préstamo: " . mysqli_error($connection) . "</div>";
                        }
                    } else {
                        $message = "<div class='error'>El libro no está disponible.</div>";
                    }
                } else {
                    $message = "<div class='error'>Libro no encontrado.</div>";
                }
            }
        } else {
            $message = "<div class='error'>El usuario no existe. Verifica los datos ingresados.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Préstamo</title>
    <style>
        /* Estilos del formulario */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6c63ff, #c3a7f9);
        }

        .container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #555555;
            font-weight: 500;
            margin-bottom: 8px;
            text-align: left;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input:focus, select:focus, button:focus {
            border-color: #6c63ff;
            outline: none;
            box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
        }

        button {
            background: linear-gradient(135deg, #6c63ff, #8a63ff);
            color: #ffffff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #8a63ff, #6c63ff);
        }

        .success-message {
            font-size: 24px;
            font-weight: bold;
            color: #6c63ff;
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: #dc3545;
            margin-top: 10px;
        }

        .top-button {
            position: fixed;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #6c63ff, #8a63ff);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 50px;
            font-size: 12px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .top-button:hover {
            background: linear-gradient(135deg, #8a63ff, #6c63ff);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <button class="top-button" onclick="window.location.href='books.php';">Back</button>
    <div class="container">
        <?php
        // Mostrar mensaje dinámico
        if (!empty($message)) {
            echo $message;
        }
        ?>
        <h2>Formulario de Préstamo</h2>
        <form action="" method="post">
            <label for="nombre_usuario">Nombre del alumno:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="apellido_usuario">Apellido del alumno:</label>
            <input type="text" id="apellido_usuario" name="apellido_usuario" required>

            <label for="correo_usuario">Correo Electrónico:</label>
            <input type="email" id="correo_usuario" name="correo_usuario" required>

            <label for="libro">Selecciona un Libro:</label>
                    <select id="libro" name="libro" required>
                        <?php
                        // Consultar solo libros disponibles
                        $sql_libros = "SELECT id_libro, titulo FROM libros WHERE disponible = 1";
                        $resultado_libros = mysqli_query($connection, $sql_libros);

                        if ($resultado_libros && mysqli_num_rows($resultado_libros) > 0) {
                            while ($libro = mysqli_fetch_assoc($resultado_libros)) {
                                echo "<option value='" . $libro['id_libro'] . "'>" . $libro['id_libro'] . " - " . $libro['titulo'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay libros disponibles</option>";
                        }
                        ?>
                    </select>

            <button type="submit">Registrar Préstamo</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
