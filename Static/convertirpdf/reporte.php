<?php
// Incluimos los archivos necesarios
include 'plantilla.php'; // Define la clase PDF
include '../connect/db.php'; // Configura la conexión a la base de datos

// Verificamos la conexión a la base de datos
if (!$conn) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}

// Realizamos la consulta a la base de datos
$query = "SELECT id, jugador_puntos, ia_puntos, fecha_hora FROM puntajes";
$resultado = mysqli_query($conn, $query);

// Validamos que la consulta sea exitosa
if (!$resultado) {
    die('Error al ejecutar la consulta: ' . mysqli_error($conn));
}

// Creamos un nuevo PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);

// Encabezados de la tabla
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Puntaje Jugador', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Puntaje IA', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Fecha y Hora', 1, 1, 'C', true);

// Relleno de datos
$pdf->SetFont('Arial', '', 12);
while ($row = mysqli_fetch_assoc($resultado)) {
    $pdf->Cell(20, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['jugador_puntos'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['ia_puntos'], 1, 0, 'C');
    $pdf->Cell(70, 10, $row['fecha_hora'], 1, 1, 'C');
}

// Cerramos la conexión
mysqli_close($conn);

// Generamos y mostramos el PDF
$pdf->Output();
?>
