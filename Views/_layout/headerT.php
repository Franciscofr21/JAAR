<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tesorero Dashboard</title>
    <link rel="stylesheet" href="../../Views/css/stylesT.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido Tesorero</h1>
        <!-- <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?>-->
        <nav>
            <ul>
                <li><a href="../../Controller/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    
    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../tesorero/tesorero_dashboard.php">Pagos Pendientes</a>
        <a href="../tesorero/tesorero_pagados.php">Pagos Realizados</a>
        <a href="../tesorero/tesorero_multasPe.php">Multas Pendientes</a>
        <a href="../tesorero/tesorero_multasPa.php">Multas Pagadas</a>
    </div>

    <button class="openbtn" onclick="openNav()">&#9776; Menú</button>