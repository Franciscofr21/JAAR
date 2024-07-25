<?php
$idSocio = $_GET['idSocio'] ?? '';
$status = $_GET['status'] ?? '';
$message = $_GET['message'] ?? '';

if ($idSocio) {
    require_once '../../Model/tbl_multas.php';
    $conn = new tbl_multas();
    $soc_id = $conn->obtenerSocioIdPorCedula($idSocio);
    if ($soc_id) {
        $multas = $conn->obtenerMultasPorSocioId($soc_id);
    } else {
        echo "No se encontró un socio con esa cédula.";
        exit();
    }
} else {
    echo "No se proporcionó una cédula.";
    exit();
}
include '../_layout/headerCon.php'; 
?>
    <main>
        <section>
            <h2>Multas del Socio <?php echo htmlspecialchars($idSocio); ?></h2>
            <?php if ($status && $message): ?>
                <div class="alert alert-<?php echo htmlspecialchars($status); ?> alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($multas as $multa) { ?>
                        <tr>
                            <td><?php echo $multa['mul_id']; ?></td>
                            <td><?php echo $multa['mul_fecha']; ?></td>
                            <td><?php echo $multa['mul_monto']; ?></td>
                            <td><?php echo $multa['mul_descrip']; ?></td>
                            <td><?php echo $multa['mul_estado']; ?></td>
                            <td>
                                <button class="btn btn-primary pagar-btn" data-bs-toggle="modal" data-bs-target="#ModalPago" data-mul-id="<?php echo $multa['mul_id']; ?>" data-mul-monto="<?php echo $multa['mul_monto']; ?>">Pagar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="../paginaprincipal.php">Regresar</a>
        </section>
    </main>
<?php include '../_layout/footerCon.php'; ?>

<!-- Modal pagar -->
<div class="modal fade" id="ModalPago" tabindex="-1" aria-labelledby="ModalPagoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalPagoLabel">Confirmación de Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="pagoForm" class="row g-3 needs-validation" action="../../Views/consultas/pagoMulta.php" method="post" novalidate>
          <div class="col-md-4">
            <label for="MontoM" class="form-label">Monto</label>
            <input type="text" class="form-control" id="MontoM" name="MontoM" value="00.00" required readonly>
            <div class="valid-feedback">Monto Correcto</div>
            <div class="invalid-feedback">Debe ser un número válido</div>
          </div>
          <div class="col-md-8">
            <label for="ncuenta" class="form-label">Número de cuenta</label>
            <input type="text" class="form-control" id="ncuenta" name="ncuenta" required>
            <div class="valid-feedback">10 Dígitos</div>
            <div class="invalid-feedback">Mínimo 10 dígitos</div>
          </div>

          <input type="hidden" name="mul_id" id="mul_id" value="">
          <input type="hidden" name="idSocio" id="idSocio" value="<?php echo htmlspecialchars($idSocio); ?>">
          <div>
            <button type="submit" class="btn btn-primary" onclick="return validarFormulario()">Pagar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function validarFormulario() {
  var monto = document.getElementById('MontoM').value;
  var cuenta = document.getElementById('ncuenta').value;

  if (isNaN(monto) || parseFloat(monto) <= 0) {
    alert("Por favor, ingrese un monto válido.");
    return false;
  }

  if (cuenta.length !== 10 || isNaN(cuenta)) {
    alert("El número de cuenta debe tener 10 dígitos.");
    return false;
  }

  return true;
}

document.querySelectorAll('.pagar-btn').forEach(button => {
  button.addEventListener('click', function() {
    var mulId = this.dataset.mulId;
    var mulMonto = this.dataset.mulMonto;
    document.getElementById('mul_id').value = mulId;
    document.getElementById('MontoM').value = mulMonto;
  });
});
// Mostrar alertas y cerrar automáticamente después de 3 segundos
document.addEventListener('DOMContentLoaded', function() {
  var alertElement = document.querySelector('.alert');
  if (alertElement) {
    setTimeout(function() {
      var alert = new bootstrap.Alert(alertElement);
      alert.close();
    }, 3000);
  }
});
</script>