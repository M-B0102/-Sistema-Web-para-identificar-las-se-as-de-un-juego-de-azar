<?php
require 'fpdf/fpdf.php';

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        // Verifica si la imagen existe antes de agregarla
        $logo = 'images/logo.jpg';
        if (file_exists($logo)) {
            $this->Image($logo, 30, 5, 30); // Logo
        } else {
            $this->SetFont('Arial', 'I', 10);
            $this->SetTextColor(255, 0, 0); // Rojo para indicar error
            $this->Cell(0, 10, 'Error: Logo no encontrado', 0, 1, 'C');
        }

        // Título
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(40); // Margen a la izquierda
        $this->Cell(120, 30, 'Puntajes', 0, 0, 'C');
        $this->Ln(40); // Salto de línea
    }

    // Pie de página
    function Footer()
    {
        // Posiciona a 1.5 cm del final de la página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
?>
