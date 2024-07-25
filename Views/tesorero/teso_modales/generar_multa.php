<?php
require_once '../../../Model/tbl_multas.php';

function generarCodigoUnico($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregarMulta'])) {
    $monto = $_POST['multa'];
    $descripcion = $_POST['descrip'];
    $soc_id = $_POST['socid'];
    $pag_id = $_POST['pagid'];

    $conn = new tbl_multas();
    $fecha = date('Y-m-d');
    $codMul = generarCodigoUnico(); // Generar el código único

    if ($conn->crearMulta($fecha, $monto, $codMul, $descripcion, $soc_id) && $conn->actualizarCodigoMulta($pag_id,$codMul) ) {
        echo "<script>
                alert('Multa agregada correctamente.');
                window.location.href = '../tesorero_dashboard.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Error al agregar la multa.');
                window.location.href = '../tesorero_dashboard.php';
              </script>";
        exit();
    }
}
?>
