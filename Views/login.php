<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylesL.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <header>
        <h1>Junta de Riego y/o Drenaje por Aspersión Zumbalica</h1>
        <a href="../Views/paginaprincipal.php" class="white-text">Regresar</a>
    </header>

    <div class=",,/container mt-5 d-flex justify-content-center">
        <div class="row w-100">
            <div class="col-md-6 d-flex align-items-center">
                <section id="login" class="w-100">
                    <h2>Login</h2>
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] == 1) {
                        echo 
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Usuario incorrecto</strong> Ingrese otras credenciales.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';    
                    }
                    ?>
                    <form action="../Controller/authenticate.php" method="post">
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Usuario:</label>
                            <select name="tipo" id="tipo" class="form-select">
                                <option value="admin">Administrador</option>
                                <option value="tesorero">Tesorero</option>
                                <option value="operador">Operador</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula:</label>
                            <input type="text" name="cedula" id="usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contra" class="form-label">Contraseña:</label>
                            <input type="password" name="contra" id="contra" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </section>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="../Views/img/llaveagua.png" alt="Imagen de Login" class="img-fluid rounded">
            </div>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Junta de Riego y/o Drenaje por Aspersión Zumbalica. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>