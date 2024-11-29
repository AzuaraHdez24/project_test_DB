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
    // Escapar y obtener datos del formulario
    $nombre_usuario = mysqli_real_escape_string($connection, trim($_POST['nombre_usuario']));
    $apellido_usuario = mysqli_real_escape_string($connection, trim($_POST['apellido_usuario']));
    $correo_usuario = mysqli_real_escape_string($connection, trim($_POST['correo_usuario']));
    $id_prestamo = mysqli_real_escape_string($connection, $_POST['prestamo']);

    // Validar si el préstamo existe y si el nombre, apellido y correo coinciden con el préstamo
    $sql_prestamo = "
        SELECT p.id_libro, a.nombre, a.apellido, a.email
        FROM prestamos p
        INNER JOIN alumnos a ON p.id_alumno = a.id_alumno
        WHERE p.id_prestamo = '$id_prestamo' AND p.fecha_devolucion IS NULL
    ";

    $resultado_prestamo = mysqli_query($connection, $sql_prestamo);

    if ($resultado_prestamo) {
        if (mysqli_num_rows($resultado_prestamo) > 0) {
            $prestamo = mysqli_fetch_assoc($resultado_prestamo);
            $id_libro = $prestamo['id_libro'];
            $nombre_alumno = trim(strtolower($prestamo['nombre']));
            $apellido_alumno = trim(strtolower($prestamo['apellido']));
            $correo_alumno = trim(strtolower($prestamo['email']));

            if (
                strtolower($nombre_usuario) === $nombre_alumno &&
                strtolower($apellido_usuario) === $apellido_alumno &&
                strtolower($correo_usuario) === $correo_alumno
            ) {
                // Registrar la devolución
                $sql_devolucion = "
                    UPDATE prestamos 
                    SET fecha_devolucion = NOW(), hora_devolucion = NOW() 
                    WHERE id_prestamo = '$id_prestamo'
                ";

                if (mysqli_query($connection, $sql_devolucion)) {
                    // Actualizar el estado del libro a "Disponible"
                    $sql_actualizar_libro = "UPDATE libros SET disponible = 1 WHERE id_libro = '$id_libro'";
                    mysqli_query($connection, $sql_actualizar_libro);

                    $message = "<div class='success-message'>¡Devolución registrada con éxito!</div>";
                } else {
                    $message = "<div class='error'>Error al registrar la devolución: " . mysqli_error($connection) . "</div>";
                }
            } else {
                $message = "<div class='error'>Los datos ingresados no coinciden con el usuario que solicitó este libro.</div>";
            }
        } else {
            $message = "<div class='error'>Préstamo no encontrado o ya ha sido devuelto.</div>";
        }
    } else {
        $message = "<div class='error'>Error en la consulta: " . mysqli_error($connection) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devolución</title>
    <style>
        /* Misma configuración CSS del ejemplo anterior */
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
        if (!empty($message)) {
            echo $message;
        }
        ?>
        <h2>Formulario de Devolución</h2>
        <form action="" method="post">
            <label for="nombre_usuario">Nombre del alumno:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="apellido_usuario">Apellido del alumno:</label>
            <input type="text" id="apellido_usuario" name="apellido_usuario" required>

            <label for="correo_usuario">Correo Electrónico:</label>
            <input type="email" id="correo_usuario" name="correo_usuario" required>

            <label for="prestamo">Selecciona un Préstamo:</label>
            <select id="prestamo" name="prestamo" required>
                <?php
                $sql_prestamos = "
                    SELECT p.id_prestamo, l.titulo 
                    FROM prestamos p
                    INNER JOIN libros l ON p.id_libro = l.id_libro
                    WHERE p.fecha_devolucion IS NULL
                ";
                $resultado_prestamos = mysqli_query($connection, $sql_prestamos);

                if ($resultado_prestamos && mysqli_num_rows($resultado_prestamos) > 0) {
                    while ($prestamo = mysqli_fetch_assoc($resultado_prestamos)) {
                        echo "<option value='" . $prestamo['id_prestamo'] . "'>" . $prestamo['titulo'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No hay préstamos pendientes</option>";
                }
                ?>
            </select>

            <button type="submit">Registrar Devolución</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
