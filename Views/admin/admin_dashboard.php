<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../../Model/conexion.php';
$conn = new Conexion();
$admins = $conn->obtenerAdmins();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crearAdmin'])) {
    $cedula = $_POST['cedula'];
    $contrasena = $_POST['contrasena'];
    if ($conn->crearAdmin($cedula, $contrasena)) {
        
        $_SESSION['alertType'] = 'success';
        $_SESSION['alertMessage'] = 'Administrador creado exitosamente.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        $_SESSION['alertType'] = 'danger';
        $_SESSION['alertMessage'] = 'La cédula ya existe o hubo un error al crear el administrador.';
    }
}

include '../_layout/header.php';
?>
<main>
    <section id="section1">
        <h2>Crear Administrador</h2>
        
        <?php if (isset($_SESSION['alertMessage'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['alertType']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['alertMessage']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            
            unset($_SESSION['alertType']);
            unset($_SESSION['alertMessage']);
            ?>
        <?php } ?>

        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearAdminModal">
            Crear Admin
        </button>
    </section>
    <section>
        <h2>Administradores Existentes</h2>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Contraseña</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin) { ?>
                        <tr>
                            <td data-label="Cédula"><?php echo $admin['soc_cedula']; ?></td>
                            <td data-label="Contraseña"><?php echo $admin['soc_contra']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="crearAdminModal" tabindex="-1" aria-labelledby="crearAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearAdminModalLabel">Crear Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula:</label>
                        <input type="text" id="cedula" name="cedula" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                    </div>
                    <button type="submit" name="crearAdmin" class="btn btn-primary">Crear Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../_layout/footer.php'; ?>