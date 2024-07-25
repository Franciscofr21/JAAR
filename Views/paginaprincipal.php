<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junta de Riego y/o Drenaje por Aspersión Zumbalica</title>
    <link rel="stylesheet" href="../Views/css/styles.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <header>
        <h1>Junta de Riego y/o Drenaje por Aspersión Zumbalica</h1>
        <nav>
            <ul>
                <li><a href="#historia">Historia</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#consultas">Consultas</a></li>
                <li><a href="../Views/login.php">Ingresar</a></li>
            </ul>
        </nav>
    </header>

    <section id="historia">
        <h2>Historia</h2>
        <p>
            La Junta de Riego y/o Drenaje por Aspersión Zumbalica fue creada en la ciudad de Latacunga, parroquia La matriz en el año 1997. Se constituyó como una de las principales juntas encargadas de la Gestión Comunitaria del Agua de la zona de Zumbalica. Desde entonces, ha proporcionado servicios de captación y distribución de agua a más de 200 familias en 12 comunidades de la parroquia.
        </p>
    </section>

    <section id="servicios">
        <h2>Servicios</h2>
        <ul>
            <li>Captación de aguas de ríos, lagos, pozos y lluvia.</li>
            <li>Purificación del agua para su distribución.</li>
            <li>Mantenimiento de la infraestructura fluvial de más de 50 hectáreas.</li>
            <li>Servicios de agua para uso industrial a nuevas familias y comunidades.</li>
        </ul>
    </section>

    <section id="consultas">
        <h2>Consultas</h2>
        <form action="../Views/consultas/consultar.php" method="post">
            <label for="tipoConsulta">Tipo de Consulta:</label>
            <select id="tipoConsulta" name="tipoConsulta">
                <option value="pagos">Pagos</option>
                <option value="multas">Multas</option>
            </select>
            <br>
            <label for="idSocio">Ingrese su Cedula:</label>
            <input type="text" id="idSocio" name="idSocio" required>
            <br>
            <input type="submit" value="Consultar">
        </form>
    </section>
    <section></section>
    <footer>
        <p>&copy; 2024 Junta de Riego y/o Drenaje por Aspersión Zumbalica. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>