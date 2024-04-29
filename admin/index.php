<?php
// Verificar si se han enviado datos del formulario
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(($_POST['UsuarioAdmin']=="Admin") &&  ($_POST['PasswordAdmin']=="Cmom1505!@#$")){
        $_SESSION["usuario"]="ok";
        $_SESSION["nombreUsuario"]="Administrador";
        header("location: pages/menu.php");
    }else{
        $mensaje ="Usuario o Contrasenas invalidas";
    };
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/prism-okaidia.css">
    <link rel="stylesheet" href="../css/custom.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                
                <div class="card bg-secondary mb-3">
                    <div class="card-header text-center">
                        Login
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje)){ ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $mensaje;?>
                            </div>
                        <?php } ?>
                        
                        <form method="POST">
                            <div class = "form-group">
                                <label for="UsuarioAdmin">User</label>
                                <input type="text" class="form-control" id="UsuarioAdmin" name="UsuarioAdmin" aria-describedby="UsuarioAdminHelp" placeholder="Enter user">
                                <small id="UsuarioAdminHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="PasswordAdmin">Password</label>
                                <input type="password" class="form-control" id="PasswordAdmin" name="PasswordAdmin" placeholder="Password">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </dir>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="LoginAdmin">Sing In</button>
                            </div>
                        </form>
                    </div>
                    
                </div>

            </div>   
        </div>
    </div>
    <!-- Agrega los enlaces a Bootstrap JS y cualquier otro JS personalizado aquí -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>