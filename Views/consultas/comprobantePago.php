<?php
require('../../fpdf/fpdf.php');
require_once '../../Model/tbl_factura.php';

$idSocio = $_GET['idSocio'] ?? '';
$facturaId = $_GET['facturaId'] ?? '';

if ($idSocio && $facturaId) {
    $conn = new tbl_factura();
    $factura = $conn->obtenerFacturaPorId($facturaId);
    if ($factura) {
        // Datos del comprobante
        $comprobante = [
            'numero' => $factura['fac_id'],
            'cedula' => $idSocio,
            'nombre' => $factura['nombre_socio'],
            'apellido' => $factura['apellido_socio'],
            'mes' => $factura['fac_fecha'],
            'valor' => $factura['fac_total'],
            'recaudador' => $factura['fac_cobrador'],
            'fecha_pago' => $factura['fac_fecha'],
            'total' => $factura['fac_total']
        ];

        class PDF extends FPDF
        {
            // Cabecera de página
            function Header()
            {
                // Logo
                //$this->Image('path/to/logo.png', 10, 8, 33);
                // Arial bold 15
                $this->SetFont('Arial', 'B', 15);
                // Movernos a la derecha
                $this->Cell(80);
                // Título
                $this->Cell(30, 10, 'Comprobante de Pago', 0, 0, 'C');
                // Salto de línea
                $this->Ln(20);
            }

            // Pie de página
            function Footer()
            {
                // Posición a 1.5 cm del final
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial', 'I', 8);
                // Número de página
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }
        }

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        // Título
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'COMPROBANTE DE PAGO DEL SERVICIO DE AGUA', 0, 1, 'C');
        $pdf->Cell(0, 10, 'NUMERO DE COMPROBANTE: ' . $comprobante['numero'], 0, 1, 'C');

        // Línea de separación
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(5);

        // Datos de la Junta de Riego y del Socio
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, 'DATOS DE LA JUNTA:', 0, 0, 'C');
        $pdf->Cell(95, 10, 'DATOS DEL SOCIO:', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);

        // Ajustar los márgenes para crear dos columnas
        $columnWidth = 95;

        // Columna de la Junta de Riego
        $pdf->Cell($columnWidth, 10, 'Nombre: Junta de Riego Zumbalica', 0, 0, 'C');
        $pdf->Cell(0, 10, 'Numero de cedula: ' . $comprobante['cedula'], 0, 1, 'C');

        $pdf->Cell($columnWidth, 10, 'Direccion: Barrio Zumbalica Sector Sur', 0, 0, 'C');
        $pdf->Cell(0, 10, 'Nombres: ' . $comprobante['nombre'], 0, 1, 'C');

        $pdf->Cell($columnWidth, 10, 'Telefono: 023815789', 0, 0, 'C');
        $pdf->Cell(0, 10, 'Apellidos: ' . $comprobante['apellido'], 0, 1, 'C');

        $pdf->Cell($columnWidth, 10, 'Correo: juntazumbalica@gmail.com', 0, 0, 'C');
        $pdf->Cell(0, 10, '', 0, 1, 'C');  // Celda vacía para alinear correctamente

        // Línea de separación
        $pdf->Ln(5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(10);

        // Datos del Pago
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'DETALLE DEL PAGO:', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);

        // Crear la tabla de detalles del pago
        $pdf->Cell(60, 10, 'Cedula', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Mes', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Valor', 1, 1, 'C');

        $pdf->Cell(60, 10, $comprobante['cedula'], 1, 0, 'C');
        $pdf->Cell(60, 10, $comprobante['mes'], 1, 0, 'C');
        $pdf->Cell(60, 10, '$' . $comprobante['valor'], 1, 1, 'C');
        $pdf->Ln(10);

        // Centrar datos del recaudador, fecha de pago y total
        $pdf->Cell(0, 10, 'Nombre del Recaudador: ' . $comprobante['recaudador'], 0, 1, 'C');
        $pdf->Cell(0, 10, 'Fecha del pago: ' . $comprobante['fecha_pago'], 0, 1, 'C');
        $pdf->Cell(0, 10, 'Total a pagar: $' . $comprobante['total'], 0, 1, 'C');

        $pdf->Output();
    } else {
        echo "No se encontró la factura.";
        exit();
    }
} else {
    echo "No se proporcionó una cédula o ID de factura.";
    exit();
}
?>