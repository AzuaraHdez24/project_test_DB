<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>biblioteca_tec</title>

    <style>

/* Main */
main {
  margin: 20px auto;
  text-align: center;
  max-width: 800px;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  font-size: 24px; /* Tamaño más grande */
  font-weight: bold; /* Negrita */
  color: #8158d3; /* Morado para destacar */
  text-align: center;
  margin-bottom: 20px;
}

/* Footer */
footer {
  margin-top: 20px;
  padding: 20px;
  background-color: #f0e9ff;
  text-align: center;
  color: #444;
  border-top: 2px solid #8158d3;
}

footer .contacto p {
  margin: 5px 0;
  font-size: 14px;
}

footer .contacto a {
  color: #8158d3;
  text-decoration: none;
}

footer .contacto a:hover {
  text-decoration: underline;
}

footer .mapa iframe {
  margin-top: 15px;
  width: 100%;
  max-width: 600px;
  height: 300px;
  border: none;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
  
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

    <main>
      <p>Bienvenido a nuestra biblioteca virtual.</p>
    </main>

    <footer>
      <div class="contacto">
        <p>Teléfono: 232-126-9864</p>
        <p>WhatsApp: <a href="#">Enviar mensaje</a></p>
        <p>Instagram: <a href="https://instagram.com/el_usuario">@el_usuario</a></p>
        <p>Avenida Ignacio De La Llave 182, 93600 Martínez de la Torre, Veracruz de Ignacio de la Llave </p>
      </div>
      <div class="mapa">
      <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.0389615028677!2d-97.05735632561213!3d20.07387262200727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d7f855b0c5d1e1%3A0x250d59df6bc4eb3a!2sAvenida%20Ignacio%20De%20La%20Llave%20182%2C%2093600%20Mart%C3%ADnez%20de%20la%20Torre%2C%20Veracruz%20de%20Ignacio%20de%20la%20Llave!5e0!3m2!1ses!2smx!4v1693069177475!5m2!1ses!2smx"
            width="600"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </footer>
  </body>
</html>
