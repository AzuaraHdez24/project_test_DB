<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>biblioteca_tec</title>

  
    <!-- Google Font: LATO -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body>
    <header class="header">
      <div class="container">
        <div class="header-top">
          <span class="header__logo">
            <p>LibraryTEC</p>
          </span>
          <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="books.php">Books</a>
            <a href="formulario.html">Login</a>
            <a href="AboutUs.php">About Us</a>
          </nav>
        </div>
      </div>
    </header>

<?php
include "db_conn.php";

// Búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT 
            libros.id_libro, 
            libros.titulo, 
            libros.anio_publicacion, 
            autores.nombre_autor, 
            idiomas.nombre_idioma,
            editoriales.nombre_editorial,
            generos.nombre_genero,
            libros.disponible  
        FROM 
            libros
        INNER JOIN 
            autores ON libros.id_autor = autores.id_autor
        INNER JOIN 
            idiomas ON libros.id_idioma = idiomas.id_idioma
        INNER JOIN 
            editoriales ON libros.id_editorial = editoriales.id_editorial
        INNER JOIN
            generos ON libros.id_genero = generos.id_genero"; 

if ($search) {
    $sql .= " WHERE 
                libros.id_libro LIKE '%$search%' OR 
                libros.titulo LIKE '%$search%' OR 
                autores.nombre_autor LIKE '%$search%' OR 
                idiomas.nombre_idioma LIKE '%$search%' OR
                editoriales.nombre_editorial LIKE '%$search%' OR
                generos.nombre_genero LIKE '%$search%' OR
                libros.anio_publicacion LIKE '%$search%'";  // Filtramos por editorial también
}

// Ordenar por id_libro
$sql .= " ORDER BY libros.id_libro";

// Ejecutar la consulta
$result = mysqli_query($conn, $sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    // Si la consulta falla, mostrar el error
    echo "Error en la consulta: " . mysqli_error($conn);
    exit; // Detener la ejecución del script si la consulta falla
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        section.item__db {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        .search__form {
            display: flex;
            justify-content: flex-start;
            gap: 5px;
            margin-bottom: 20px;
        }

        .search__form input {
            width: 20%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search__form button {
            padding: 10px 25px;
            background-color: #a76cf4;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search__form button:hover {
            background-color: #0056b3;
        }

        .db__list {
            margin-top: 20px;
        }

        .db__list--header h2 {
            text-align: center;
            color: #ad6bf8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        thead {
            background-color: #ad6bf8;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .action-buttons a {
            padding: 10px 20px;
            background-color: #a76cf4;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .action-buttons a:hover {
            background-color: #574bff;
        }

        /* Estilos para "Activo" e "Inactivo" */
        .activo {
            color: green;
            font-weight: bold;
        }

        .inactivo {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <section class="item__db">
        <form method="GET" class="search__form">
            <input type="text" name="search" placeholder="Buscar por título, editorial, año de publicación genero, autor o idioma" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Buscar</button>
        </form>

        <div class="db__list">
            <header class="db__list--header">
                <h2>Aquí tus libros favoritos</h2>
            </header>
            <?php
            if (mysqli_num_rows($result) > 0) {
                ?>
                <table>
                <div class="action-buttons">
                    <a href="prestamo.php" class="prestamo-btn">Haz tu Préstamo</a>
                    <a href="devolucion.php" class="devolucion-btn">Haz tu Devolución</a>
                </div>
                    <thead>
                        <tr>
                            <th>Num. identificador</th>
                            <th>Título</th>
                            <th>Género</th>
                            <th>Editorial</th>
                            <th>Año de Publicación</th>
                            <th>Autor</th>
                            <th>Idioma</th>
                            <th>Disponibilidad</th>  <!-- Nueva columna para disponibilidad -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            // Determinar si el libro está activo o inactivo
                            $disponibilidad = $row['disponible'] == 1 ? '<span class="activo">Available</span>' : '<span class="inactivo">Not available</span>';
                            ?>
                            <tr>
                                <td><?php echo $row['id_libro']; ?></td>
                                <td><?php echo $row['titulo']; ?></td>
                                <td><?php echo $row['nombre_genero']; ?></td>
                                <td><?php echo $row['nombre_editorial']; ?></td>
                                <td><?php echo $row['anio_publicacion']; ?></td>
                                <td><?php echo $row['nombre_autor']; ?></td>
                                <td><?php echo $row['nombre_idioma']; ?></td>
                                <td><?php echo $disponibilidad; ?></td>  <!-- Mostrar disponibilidad -->
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                
                <?php
            } else {
                echo "<p class='no-results'>No se encontraron resultados</p>";
            }
            ?>
        </div>
    </section>
</body>
</html>



<!-- Incluimos el script de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="item__ranking">
    <header class="db__list--header">
        <h2>Ranking de Libros Más Solicitados</h2>
    </header>
    <div class="ranking-container">
        <canvas id="rankingChart"></canvas>
        <div id="rankingData" class="ranking-data"></div>
    </div>
</section>

<style>
    /* Estilos generales */
    .item__ranking {
        width: 80%;
        margin: 40px auto;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
    }

    .item__ranking h2 {
        color: #ad6bf8;
        margin-bottom: 20px;
        text-align: center;
    }

        /* Estilo de la gráfica */
        #rankingChart {
        flex: 1;
        max-width: 700px; /* Ajusta el tamaño máximo de la gráfica */
        max-height: 500px;
    }
    /* Contenedor para gráfica y datos */
    .ranking-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }



    /* Estilo para los datos de la lista */
    .ranking-data {
        flex: 1;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
        color: #333;
    }

    .ranking-data ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .ranking-data li {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px solid #ddd;
    }

    .ranking-data li span {
        font-weight: bold;
    }
</style>

<script>
    // Obtener los datos del ranking desde PHP
    <?php
    // Consulta para obtener los datos del ranking
    $rankingSql = "
        SELECT l.titulo, COUNT(p.id_prestamo) AS total_prestamos
        FROM libros l
        LEFT JOIN prestamos p ON l.id_libro = p.id_libro
        GROUP BY l.id_libro, l.titulo
        ORDER BY total_prestamos DESC
        LIMIT 6
    ";
    $rankingResult = mysqli_query($conn, $rankingSql);

    // Crear arrays para los datos
    $titles = [];
    $counts = [];

    while ($row = mysqli_fetch_assoc($rankingResult)) {
        $titles[] = $row['titulo'];
        $counts[] = $row['total_prestamos'];
    }
    ?>

    // Datos en formato JavaScript
    const titles = <?php echo json_encode($titles); ?>;
    const counts = <?php echo json_encode($counts); ?>;

    // Configuración de la gráfica
    const ctx = document.getElementById('rankingChart').getContext('2d');
    const rankingChart = new Chart(ctx, {
        type: 'pie', // Cambiado a gráfica de pastel
        data: {
            labels: titles, // Títulos de los libros
            datasets: [{
                label: 'Total de Préstamos',
                data: counts, // Conteos de préstamos
                backgroundColor: [
                    'rgba(173, 107, 248, 0.7)',
                    'rgba(107, 153, 248, 0.7)',
                    'rgba(107, 248, 173, 0.7)',
                    'rgba(248, 173, 107, 0.7)',
                    'rgba(248, 107, 173, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(173, 107, 248, 1)',
                    'rgba(107, 153, 248, 1)',
                    'rgba(107, 248, 173, 1)',
                    'rgba(248, 173, 107, 1)',
                    'rgba(248, 107, 173, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>

<script>
    let rankingChart;

    // Función para cargar los datos de la gráfica
    function loadRankingData() {
        fetch('ranking_data.php') // Solicita datos al endpoint
            .then(response => response.json())
            .then(data => {
                const titles = data.map(item => item.titulo);
                const counts = data.map(item => item.total_prestamos);

                // Si la gráfica ya está inicializada, actualizamos sus datos
                if (rankingChart) {
                    rankingChart.data.labels = titles;
                    rankingChart.data.datasets[0].data = counts;
                    rankingChart.update(); // Refresca la gráfica
                } else {
                    // Si no está inicializada, creamos la gráfica
                    const ctx = document.getElementById('rankingChart').getContext('2d');
                    rankingChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: titles,
                            datasets: [{
                                label: 'Total de Préstamos',
                                data: counts,
                                backgroundColor: [
                                    'rgba(173, 107, 248, 0.7)',
                                    'rgba(107, 153, 248, 0.7)',
                                    'rgba(107, 248, 173, 0.7)',
                                    'rgba(248, 173, 107, 0.7)',
                                    'rgba(248, 107, 173, 0.7)',
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(153, 102, 255, 0.7)'
                                ],
                                borderColor: [
                                    'rgba(173, 107, 248, 1)',
                                    'rgba(107, 153, 248, 1)',
                                    'rgba(107, 248, 173, 1)',
                                    'rgba(248, 173, 107, 1)',
                                    'rgba(248, 107, 173, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                }
            })
            .catch(error => console.error('Error al cargar los datos del ranking:', error));
    }

    // Cargar los datos de la gráfica al inicio
    loadRankingData();

    // Refrescar automáticamente la gráfica después de un préstamo
    document.querySelector('.prestamo-btn').addEventListener('click', () => {
        setTimeout(() => {
            loadRankingData(); // Recargar datos tras un préstamo
        }, 1000); // Pequeño retraso para permitir que el préstamo sea registrado
    });
</script>

