<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../Views/css/stylesA.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <header>
        <h1>Bienvenido Administrador</h1>
        <nav>
            <ul>
                <li><a href="../../Controller/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    
    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../admin/admin_dashboard.php">Administradores</a>
        <a href="../admin/admin_tesoreros.php">Tesoreros</a>
        <a href="../admin/admin_operadores.php">Operadores</a>
        <a href="../admin/admin_usuarios.php">Usuarios</a>
        <a href="../admin/admin_medidores.php">Medidores</a>
        <a href="../admin/admin_multas.php">Multas</a>
        <a href="../admin/admin_pagos.php">Pagos</a>
        <a href="../admin/admin_facturas.php">Facturas</a>
    </div>

    <button class="openbtn" onclick="openNav()">&#9776; Menú</button>