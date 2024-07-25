<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'operador') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/tbl_medidor.php';
$conn = new tbl_medidor();
$medidores = $conn->obtenerMedidor();


include '../_layout/headerO.php'; 
?>
    <main>
        <section>
        <h2>Medidores Existentes</h2>
        <?php if (isset($_GET['medidor_agregado']) && $_GET['medidor_agregado'] === 'true') : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Éxito!</strong> El medidor se agregó correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'medidor_existente') : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> Ya existe un medidor asociado a este socio.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <button class="boton_agregar" onclick="openModal('modalAgregar')">Ingresar nuevo medidor</button>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Fecha Anterior</th>
                            <th>Lectura Anterior</th>
                            <th>Fecha Actual</th>
                            <th>Lectura Actual</th>
                            <th>Cédula Socio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medidores as $medidor) { ?>
                            <tr>
                                <td data-label="Identificación"><?php echo $medidor['med_identificacion']; ?></td>
                                <td data-label="Fecha Anterior"><?php echo $medidor['med_fechaA']; ?></td>
                                <td data-label="Lectura Anterior"><?php echo $medidor['med_lecturaA']; ?></td>
                                <td data-label="Fecha Actual"><?php echo $medidor['med_fechaN']; ?></td>
                                <td data-label="Lectura Actual"><?php echo $medidor['med_lecturaN']; ?></td>
                                <td data-label="Cédula Socio"><?php echo $medidor['soc_cedula']; ?></td>
                                <td data-label="Acciones">
                                    <form class="generar-pago-form" method="POST" action="../../Views/operador/generar_pago.php">
                                        <input type="hidden" name="med_id" value="<?php echo $medidor['med_id']; ?>">
                                        <input type="hidden" name="lecturaA" value="<?php echo $medidor['med_lecturaA']; ?>">
                                        <input type="hidden" name="lecturaN" value="<?php echo $medidor['med_lecturaN']; ?>">
                                        <input type="hidden" name="soc_cedula" value="<?php echo $medidor['soc_cedula']; ?>">
                                        <button type="submit" class="boton_pago btn btn-warning">Generar Pago</button>
                                    </form>
                                    <br>
                                     <!-- Botón para cambiar lectura -->
                                     <button type="button" class="boton_lectura btn btn-success" 
                                            onclick="openModalEditarLectura(
                                                <?php echo $medidor['med_id']; ?>, 
                                                '<?php echo $medidor['med_lecturaN']; ?>',
                                                '<?php echo $medidor['med_fechaN']; ?>')">Nueva Lectura</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal para editar lectura -->
    <div id="modalEditarLectura" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalEditarLectura')">&times;</span>
            <h2>Generar nueva lectura</h2>
            <form id="formEditarLectura" method="POST" action="../../Views/operador/editar_lectura_medidor.php">
                <input type="hidden" id="medidorId" name="medidorId">
                <div class="form-group">
                    <label for="lecturaNueva">Lectura Anterior (m3):</label>
                    <input type="number" class="form-control" id="lecturaNueva" name="lecturaNueva" step="0.01" required readonly>
                </div>
                <div class="form-group">
                    <label for="fechaNueva">Fecha Lectura Anterior:</label>
                    <input type="date" class="form-control" id="fechaNueva" name="fechaNueva" required>
                </div>
                <div class="form-group">
                    <label for="lecturaActual">Lectura Nueva (m3):</label>
                    <input type="number" class="form-control" id="lecturaActual" name="lecturaActual" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="fechaActual">Fecha Lectura Nueva:</label>
                    <input type="date" class="form-control" id="fechaActual" name="fechaActual" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="modalConfirmacion" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalConfirmacion')">&times;</span>
            <h2>Confirmación de Pago</h2>
            <p id="mensajeConfirmacion"></p>
            <button onclick="closeModal('modalConfirmacion')">Aceptar</button>
        </div>
    </div>

    <div id="modalError" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalError')">&times;</span>
            <h2>Error</h2>
            <p id="mensajeError"></p>
            <button onclick="closeModal('modalError')">Aceptar</button>
        </div>
    </div>

    <div id="modalAgregar" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Agregar Medidor</h2>
                <button type="button" class="close" onclick="closeModal('modalAgregar')">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../Views/operador/ope_modales/ope_agregar.php">
                    <div class="form-group">
                        <label for="identi">Identificación:</label>
                        <input type="text" class="form-control" id="identi" name="identi" required>
                    </div>
                    <div class="form-group">
                        <label for="fec">Fecha Lectura Anterior:</label>
                        <input type="date" class="form-control" id="fec" name="fec" required>
                    </div>
                    <div class="form-group">
                        <label for="lecturaAnterior">Lectura Anterior (m3):</label>
                        <input type="number" class="form-control" id="lecturaAnterior" name="lecturaAnterior" step="0.01" pattern="\d+(\.\d{2})?" title="Ingrese un número con dos dígitos enteros y dos decimales (por ejemplo, 123.45)" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaActual">Fecha Lectura Actual:</label>
                        <input type="date" class="form-control" id="fechaActual" name="fechaActual" required>
                    </div>
                    <div class="form-group">
                        <label for="lecturaActual">Lectura Actual (m3):</label>
                        <input type="number" class="form-control" id="lecturaActual" name="lecturaActual" step="0.01" pattern="\d+(\.\d{2})?" title="Ingrese un número con dos dígitos enteros y dos decimales (por ejemplo, 123.45)" required>
                    </div>
                    <div class="form-group">
                        <label for="soc_id">Seleccione el Socio:</label>
                        <select class="form-control" id="soc_id" name="soc_id" required>
                            <?php
                            // Incluir lógica PHP para obtener y mostrar los socios asociados al perfil con per_id = 4
                            require_once '../../Model/tbl_operadores.php';

                            $medidor = new tbl_medidor();
                            $socios = $medidor->obtenerSociosConPerId4();

                            foreach ($socios as $socio) {
                                echo "<option value=\"{$socio['soc_id']}\">{$socio['soc_nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="agregarMedidor">Agregar Medidor</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include '../_layout/footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.generar-pago-form');
            forms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const formData = new FormData(this);
                    fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('mensajeConfirmacion').textContent = data.message;
                        document.getElementById('modalConfirmacion').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

    // Función para abrir el modal de editar lectura
    function openModalEditarLectura(medidorId, lecturaNueva, fechaNueva) {
        document.getElementById('medidorId').value = medidorId;
        document.getElementById('lecturaNueva').value = lecturaNueva;
        document.getElementById('fechaNueva').value = fechaNueva;
        document.getElementById('modalEditarLectura').style.display = 'block';
    }


    // Función para cerrar cualquier modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Escuchar el submit del formulario de editar lectura
    document.addEventListener('DOMContentLoaded', function () {
        const formEditarLectura = document.getElementById('formEditarLectura');
        formEditarLectura.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Aquí puedes manejar la respuesta, por ejemplo cerrar el modal y mostrar mensaje
                closeModal('modalEditarLectura');
                alert('Lectura actualizada correctamente');
                // Puedes recargar la página o actualizar solo la tabla de medidores si prefieres
                location.reload(); // Recarga toda la página
                // Aquí puedes recargar solo la tabla de medidores si prefieres
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al actualizar la lectura del medidor');
            });
        });
    });
    </script>