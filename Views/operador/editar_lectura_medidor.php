<?php
// Verificar si se ha enviado la solicitud por método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluir archivo de conexión y la clase tbl_medidor
    require_once '../../Model/tbl_medidor.php';
    $conn = new tbl_medidor();

    // Obtener los datos del formulario
    $medidorId = $_POST['medidorId'];
    $lecturaActual = $_POST['lecturaNueva'];
    $fechaActual = $_POST['fechaNueva'];
    $lecturaNueva = $_POST['lecturaActual'];
    $fechaNueva = $_POST['fechaActual'];

    // Transformar las fechas al formato YYYY-MM-DD
    $fechaActual = (new DateTime($fechaActual))->format('Y-m-d');
    $fechaNueva = (new DateTime($fechaNueva))->format('Y-m-d');

    // Llamar al método para editar la lectura del medidor
    $result = $conn->editarLecturaMedidor($medidorId, $lecturaActual, $fechaActual, $lecturaNueva, $fechaNueva);

    if ($result) {
        // Preparar respuesta JSON
        $response = [
            'status' => 'success',
            'message' => 'Lectura actualizada correctamente.'
        ];
    } else {
        // Preparar respuesta JSON en caso de error
        $response = [
            'status' => 'error',
            'message' => 'Error al actualizar la lectura del medidor.'
        ];
    }

    // Devolver respuesta JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si la solicitud no es por método POST, redirigir o manejar el error según sea necesario
    $response = [
        'status' => 'error',
        'message' => 'Método no permitido.'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>