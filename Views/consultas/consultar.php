<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipoConsulta = $_POST['tipoConsulta'];
    $idSocio = $_POST['idSocio'];

    if ($tipoConsulta === 'pagos') {
        header("Location: ../consultas/consulPagos.php?idSocio=$idSocio");
        exit();
    } elseif ($tipoConsulta === 'multas') {
        header("Location: ../consultas/consulMultas.php?idSocio=$idSocio");
        exit();
    } else {
        // Manejar el caso en que el tipo de consulta no es válido
        echo "Tipo de consulta no válido.";
    }
} else {
    // Si no se accede mediante un formulario POST, redirigir al formulario de consultas
    header("Location: index.php#consultas");
    exit();
}
?>
