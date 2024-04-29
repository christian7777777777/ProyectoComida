<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Comida</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/prism-okaidia.css">
    <link rel="stylesheet" href="./css/custom.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form method="post" action="config/clientes.php">
                    <h3 class="text-center mb-4">Registra tus datos antes de Ordenar</h3>
                    <div>
                        <label for="usuario" class="form-label mt-4">Nombres Completos</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="usuarioHelp" placeholder="Ingresa tus Nombres" required="">
                        <small id="usuarioHelp" class="form-text text-muted">Nos ayuda a identificar tu orden y facturacion</small>
                    </div>
                    <div>
                        <label for="correo" class="form-label mt-4">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="usuarioHelp" placeholder="Ingresa tu email" required="">
                        <small id="correoHelp" class="form-text text-muted">Nos ayuda a identificar tu orden y facturacion</small>
                    </div>
                    <div>
                        <label for="mesa" class="form-label mt-4">Mesa</label>
                        <select class="form-select" id="mesa" name="mesa">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="IdentificacionUsuario" id="IdentificacionUsuario" value="IngresoCliente">Identificarme</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Agrega los enlaces a Bootstrap JS y cualquier otro JS personalizado aquí -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>