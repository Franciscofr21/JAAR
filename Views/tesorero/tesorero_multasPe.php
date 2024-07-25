<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'tesorero') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/tbl_multas.php';
$conn = new tbl_multas();
$multas = $conn->obtenerMulta();
include '../_layout/headerT.php'; 
?>

    <main>
        <section>
        <h2>Multas Existentes</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha Multa</th>
                            <th>Monto Multa</th>
                            <th>Descripción</th>
                            <th>Cedula Socio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($multas as $multa) { ?>
                            <tr>
                                <td data-label="Fecha Multa"><?php echo $multa['mul_fecha']; ?></td>
                                <td data-label="Monto Multa"><?php echo $multa['mul_monto']; ?></td>
                                <td data-label="Descripción"><?php echo $multa['mul_descrip']; ?></td>
                                <td data-label="Cédula Socio"><?php echo $multa['soc_cedula']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
<?php include '../_layout/footerT.php'; ?>