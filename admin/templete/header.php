<?php 
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}else{
    if($_SESSION['usuario']=="ok"){
        $nombreUsuario=$_SESSION['nombreUsuario'];
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../css/prism-okaidia.css">
    <link rel="stylesheet" href="../../css/custom.min.css">
</head>
<body>

    <div class="navbar navbar-expand-lg fixed-top bg-body-tertiary" data-bs-theme="dark">
        <div class="container">
            <a href="../" class="navbar-brand">Sitio Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/menu.php">Platillos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/cerrar.php">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        
            
        