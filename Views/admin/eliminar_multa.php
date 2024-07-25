<?php
require_once '../../Model/tbl_multas.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarMulta'])) {
    $mul_id = $_POST['mul_id'];
    $conn = new tbl_multas();
    if ($conn->eliminarMulta($mul_id)) {
        header('Location: ../admin/admin_multas.php');
        exit();
    } else {
        echo "Error al eliminar el socio.";
    }
}
?>