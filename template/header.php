<?php

session_start();


if (!isset($_SESSION["Cliente"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../index.php");
    exit();
}

include("../config/conexionbd.php");
$mensaje="";


if(isset($_POST['usuario'])){
    $NombreCliente = $_POST['usuario'];
}
if(isset($_POST['correo'])){
    $CorreoCliente = $_POST['correo'];
}
if(isset($_POST['mesa'])){
    $MesaCliente = $_POST['mesa'];
}

if(isset($_POST['AccionCarrito'])){
    switch($_POST['AccionCarrito']){
        case "AgregarCarrito":
            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                $ID=openssl_decrypt($_POST['id'], COD, KEY);
            }
            if(is_string(openssl_decrypt($_POST['Nombre'], COD, KEY))){
                $Plato=openssl_decrypt($_POST['Nombre'], COD, KEY);
            }
            if(is_numeric(openssl_decrypt($_POST['Precio'], COD, KEY))){
                $Precio=openssl_decrypt($_POST['Precio'], COD, KEY);
            }
            if(is_numeric(openssl_decrypt($_POST['Cantidad'], COD, KEY))){
                $Cantidad=openssl_decrypt($_POST['Cantidad'], COD, KEY);
            }
            
            if(!isset($_SESSION['CARRITO'])){
                $producto=array(
                    'ID'=>$ID,
                    'PLATO'=>$Plato,
                    'CANTIDAD'=>$Cantidad,
                    'PRECIO'=>$Precio
                );
                $_SESSION['CARRITO'][0]=$producto;

                $mensaje= "Producto Agregado";
            }else{
                $idProductos = array_column($_SESSION['CARRITO'], "ID");

                if(in_array($ID, $idProductos)){
                    echo "<script>alert('El producto ya ha sido seleccionado');</script>";
                }else{
                    $NumeroProducto=count($_SESSION['CARRITO']);
                    $producto=array(
                        'ID'=>$ID,
                        'PLATO'=>$Plato,
                        'CANTIDAD'=>$Cantidad,
                        'PRECIO'=>$Precio
                    );
                    $_SESSION['CARRITO'][$NumeroProducto]=$producto;
                    $mensaje= "Producto Agregado";
                }
            }
            //$mensaje= print_r($_SESSION, true);
            break;
        case "BorrarCarrito":
            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                $ID=openssl_decrypt($_POST['id'], COD, KEY);
            };

            foreach($_SESSION['CARRITO'] as $indice=>$producto){
                if($producto['ID']==$ID){
                    unset($_SESSION['CARRITO'][$indice]);
                }
            };
            break;

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/prism-okaidia.css">
    <link rel="stylesheet" href="../css/custom.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="../" class="navbar-brand">Sitio Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ProyectoComida/admin/">Administrador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ProyectoComida/pages/menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mostrarCarrito.php">Carrito(
                            <?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>
                            )</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br/>

    <div class="container">