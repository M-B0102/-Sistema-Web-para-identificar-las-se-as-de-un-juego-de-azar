<?php
include 'Static/connect/db.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .btn-export {
            margin: 10px;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
        }

        .btn-excel {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-excel:hover {
            background-color: #218838;
        }

        .btn-pdf {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-pdf:hover {
            background-color: #c82333;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Puntajes Registrados</h2>
        
        <div class="d-flex justify-content-between">
            <a href="Piedra, Papel o Tijera.php" class="btn btn-back">Volver al Menú</a>
            <div>
                <a href="Static/convertirpdf/excel.php" class="btn btn-excel btn-export">Exportar a Excel</a>
                <a href="Static/convertirpdf/reporte.php" class="btn btn-pdf btn-export">Exportar a PDF</a>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Puntaje Jugador</th>
                        <th>Puntaje IA</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT id, jugador_puntos, ia_puntos, fecha_hora FROM puntajes";
                    $result_puntajes = mysqli_query($conn, $query);

                    if ($result_puntajes && mysqli_num_rows($result_puntajes) > 0) {
                        while ($row = mysqli_fetch_assoc($result_puntajes)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['jugador_puntos']); ?></td>
                                <td><?php echo htmlspecialchars($row['ia_puntos']); ?></td>
                                <td><?php echo htmlspecialchars($row['fecha_hora']); ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron registros de puntajes.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
