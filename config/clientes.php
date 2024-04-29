<?php

session_start();
if (isset($_POST["IdentificacionUsuario"])) {
    if($_POST["IdentificacionUsuario"]=="IngresoCliente"){
        
        $_SESSION['Cliente'] = $_POST['usuario'];
        $_SESSION['Correo'] = $_POST['correo'];
        $_SESSION['Mesa'] = $_POST['mesa'];

        header("Location: ../pages/menu.php");
    }
    
}
?>
