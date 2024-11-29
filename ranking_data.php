<?php
include "db_conn.php";

// Consulta para obtener el ranking actualizado
$rankingSql = "
    SELECT l.titulo, COUNT(p.id_prestamo) AS total_prestamos
    FROM libros l
    LEFT JOIN prestamos p ON l.id_libro = p.id_libro
    GROUP BY l.id_libro, l.titulo
    ORDER BY total_prestamos DESC
    LIMIT 10
";
$rankingResult = mysqli_query($conn, $rankingSql);

$data = [];

while ($row = mysqli_fetch_assoc($rankingResult)) {
    $data[] = [
        'titulo' => $row['titulo'],
        'total_prestamos' => $row['total_prestamos']
    ];
}

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($data);
