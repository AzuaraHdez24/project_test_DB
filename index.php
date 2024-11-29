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

    <section class="path">
  <div class="path__content container">
    <div class="path__content--text">
      <h1>Biblioteca del Saber</h1>
      <p>
        Sé bienvenido a nuestra biblioteca virtual, diseñada
        para los amantes de la lectura, interesados en la adquisición 
        de las obras más destacadas de los autores más emblemáticos de la
        historia.
      </p>
      <a href="#informacion" class="btn-info">Information</a>
    </div>
    <div class="path__content--img">
      <img src="./img/biblioteca_img1.jpg" alt="Imagen ilustrativa" />
    </div>
  </div>
</section>


    <main class="main">
      <div class="container">
        <h2>Conoce a algunos de nuestros autores</h2>
        <div class="main__cards">
          <div class="main__card">
            <img src="./img/paulo_coelho.jpeg" class="main__card--image" />
            <h3 class="main__card--author">Paulo Coelho</h3>
            <h4 class="main__card--subtitle">Rio de Janeiro, 1948</h4>
            <p class="main__card--description">
              Es uno de los escritores mas leidos del mundo, con mas de 320
              millones de libros vendidos en 170 paises y traducciones en 88
              lenguas.
            </p>
          </div>
          <div class="main__card">
            <img src="./img/johanna_lin.jpg" class="main__card--image" />
            <h3 class="main__card--author">Johanna Lindsey</h3>
            <h4 class="main__card--subtitle">Alemania Occidental, 1952</h4>
            <p class="main__card--description">
              Sus libros llegaron a la lista de los más vendidos de The New York
              Times. Lindsey abordó una variedad de subgéneros románticos, incluyendo
              medieval, Refency, western, vikingo e incluso ciencia ficción.
            </p>
          </div>
          <div class="main__card">
            <img src="./img/king.jpg" class="main__card--image" />
            <h3 class="main__card--author">Stephen King</h3>
            <h4 class="main__card--subtitle">Estados Unidos, 1947</h4>
            <p class="main__card--description">
              Se puede afirmar con rotundidad que es el rey absoluto de la
              ciencia ficción y el padrino de un género que ha dignificado,
              popularizado y rentabilizado.
            </p>
          </div>
          <div class="main__card">
            <img src="./img/hwang_sok.jpeg" class="main__card--image" />
            <h3 class="main__card--author">Sok-yong Hwang</h3>
            <h4 class="main__card--subtitle">Seúl, 1943</h4>
            <p class="main__card--description">
            Una de sus obras traducidas al español es Bari, la princesa abandonada.
            Recibiendo el nombre de Bari, como la princesa de una antigua leyenda 
            quien recibió el mismo destino. Se ve obligada a huir hacia China, terminando 
            en Londres. 
            </p>
          </div>
          <div class="main__card">
            <img
              src="./img/miguel_cervantes.jpeg"
              class="main__card--image"
            />
            <h3 class="main__card--author">Miguel de Cervantes</h3>
            <h4 class="main__card--subtitle">Alcala de Henares, 1547</h4>
            <p class="main__card--description">
              Dicen las crónicas literarias que El Quijote fue la primera novela
              moderna de la Historia. Poco importa en realidad...
            </p>
          </div>
          <div class="main__card">
            <img src="./img/jane_austen.jpg" class="main__card--image" />
            <h3 class="main__card--author">Jane Austen</h3>
            <h4 class="main__card--subtitle">Reino Unido, 1775</h4>
            <p class="main__card--description">
              Esta prolífica escritora fue, en gran medida, pionera de la
              literatura femenina. Sus mujeres, sometidas a rígidas normas
              protocolarias y abocadas a casarse por conveniencia, reunían, sin
              embargo, toda la dialéctica más exigente para enfrentarte a los
              hombres que no amaban y a los padres opresores.
            </p>
          </div>
        </div>
      </div>
    </main>
    

<!-- CRUD Operations AUTORES-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
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
            justify-content: flex-start; /* Alinea los elementos a la izquierda */
            gap: 5px; /* Espacio entre la casilla y el botón */
            margin-bottom: 20px;
        }

        .search__form input {
            width: 20%; /* Ajusta el ancho según sea necesario */
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
    </style>
</head>
<body>
    <section id="search" class="item__db">
        <form method="GET" class="search__form" action="#search">
            <input type="text" name="search" placeholder="Buscar autor" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Buscar</button>
        </form>

        <?php    
        include "db_conn.php";

        // Búsqueda
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM autores";
        if ($search) {
            $sql .= " WHERE nombre_autor LIKE '%$search%' OR 
                            nacionalidad LIKE '%$search%' OR
                            fecha_nacimiento LIKE '%$search%'";
        }

        $result = mysqli_query($conn, $sql);
        ?>
        <div class="db__list">
            <header class="db__list--header">
            </header>
            <?php
            if (mysqli_num_rows($result) > 0) {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Autor</th>
                            <th>Nacionalidad</th>
                            <th>Fecha de Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['nombre_autor'] ?></td>
                                <td><?php echo $row['nacionalidad'] ?></td>
                                <td><?php echo $row['fecha_nacimiento'] ?></td>
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

