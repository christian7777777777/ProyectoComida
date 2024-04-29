<?php include("../templete/header.php");?>
<?php 

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombrePlatillo = (isset($_POST['txtNombrePlatillo']))?$_POST['txtNombrePlatillo']:"";
$txtDescipcionPlatillo = (isset($_POST['txtDescipcionPlatillo']))?$_POST['txtDescipcionPlatillo']:"";
$txtTipoPlatillo = (isset($_POST['txtTipoPlatillo']))?$_POST['txtTipoPlatillo']:"";
$txtPrecio = (isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtImagenPlatillo = (isset($_FILES['txtImagenPlatillo']['name']))?$_FILES['txtImagenPlatillo']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";


include("../config/bd.php");

switch($accion){
    case "Agregar":
        
        //INSERT INTO `platillos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Imagen`) VALUES (NULL, 'Salchipapa', 'Papas, Salchicha, Ensalada, Salsa, Mayonesa', '1.50', 'imagen.jpg');
        $sql = "INSERT INTO platillos (ID, Nombre, Descripcion, Tipo, Precio, Imagen) 
            VALUES (null, :nombre, :descripcion, :tipo, :precio, :imagen)";
        
        $stmt = $conn->prepare($sql);
        
        $fecha = new DateTime();
        $nombreArchivo = ($txtImagenPlatillo!="")?$fecha->getTimestamp()."_".$_FILES['txtImagenPlatillo']['name']:"imagen.jpg";
        $tmpImagen = $_FILES['txtImagenPlatillo']['tmp_name'];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);
        };
        
        $stmt->execute(array(':nombre' => $txtNombrePlatillo, ':descripcion' => $txtDescipcionPlatillo, ':tipo' => $txtTipoPlatillo, ':precio' => $txtPrecio, ':imagen' => $nombreArchivo));

        header("Location: menu.php");
        break;
    case "Modificar":
        
        $stmt = $conn->prepare("UPDATE platillos SET Nombre=:nombre, Descripcion=:descripcion, Tipo=:tipo, Precio=:precio WHERE ID=:id");
        $stmt->execute(array(':id' => $txtID, ':nombre' => $txtNombrePlatillo, ':descripcion' => $txtDescipcionPlatillo, ':tipo' => $txtTipoPlatillo,':precio' => $txtPrecio));

        if($txtImagenPlatillo!=""){

            $fecha = new DateTime();
            $nombreArchivo = ($txtImagenPlatillo!="")?$fecha->getTimestamp()."_".$_FILES['txtImagenPlatillo']['name']:"imagen.jpg";
            $tmpImagen = $_FILES['txtImagenPlatillo']['tmp_name'];
            
            move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);

            $stmt = $conn->prepare("SELECT Imagen FROM platillos WHERE ID=:id");
            $stmt->execute(array(':id' => $txtID));
            $Platillo = $stmt->fetch();

            if(isset($Platillo['Imagen']) && ($Platillo['Imagen']!="imagen.jpg")){
                if(file_exists("../../img/".$Platillo['Imagen'])){
                    unlink("../../img/".$Platillo['Imagen']);
                };
            };

            $stmt = $conn->prepare("UPDATE platillos SET Imagen=:imagen WHERE ID=:id");
            $stmt->execute(array(':id' => $txtID, ':imagen' => $nombreArchivo));   
        }
        header("Location: menu.php");
        break;
    case "Cancelar":
        header("Location: menu.php");
        break;
    
    case "Seleccionar":
        $stmt = $conn->prepare("SELECT * FROM platillos WHERE ID=:id");
        $stmt->execute(array(':id' => $txtID));
        $Platillo = $stmt->fetch();
        
        $txtNombrePlatillo = $Platillo['Nombre'];
        $txtDescipcionPlatillo = $Platillo['Descripcion'];
        $txtTipoPlatillo = $Platillo['Tipo'];
        $txtPrecio = $Platillo['Precio'];
        $txtImagenPlatillo = $Platillo['Imagen'];
        break;

    case "Borrar":
        
        $stmt = $conn->prepare("SELECT Imagen FROM platillos WHERE ID=:id");
        $stmt->execute(array(':id' => $txtID));
        $Platillo = $stmt->fetch();

        if(isset($Platillo['Imagen']) && ($Platillo['Imagen']!="imagen.jpg")){
            if(file_exists("../../img/".$Platillo['Imagen'])){
                unlink("../../img/".$Platillo['Imagen']);
            }
        };
        
        
        $stmt = $conn->prepare("DELETE FROM platillos WHERE ID=:id");
        
        $stmt->execute(array(':id' => $txtID));

        header("Location: menu.php");
        break;
}

$stmt = $conn->prepare("SELECT * FROM platillos");
$stmt->execute();
$listaPlatillos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-4">
    
    <div class="card">
        <div class="card-header">
            Datos del Platillo
        </div>
        <div class="card-body">
            
            <form method="post" enctype="multipart/form-data">
                <div class = "form-group">
                    <label for="txtID">Id</label>
                    <input type="text" required="" readonly="" class="form-control" value="<?php echo $txtID;?>" id="txtID" name="txtID" placeholder="Ingresa el Id">
                </div>

                <div class = "form-group">
                    <label for="txtNombrePlatillo">Nombre</label>
                    <input type="text" required="" class="form-control" value="<?php echo $txtNombrePlatillo;?>" id="txtNombrePlatillo" name="txtNombrePlatillo" placeholder="Ingresa el Nombre del Platillo">
                </div>

                <div class = "form-group">
                    <label for="txtDescipcionPlatillo">Descripcion</label>
                    <input type="text" required="" class="form-control" value="<?php echo $txtDescipcionPlatillo;?>" id="txtDescipcionPlatillo" name="txtDescipcionPlatillo" placeholder="Ingrediente 1, Ingrediente 2, .. , Ingrediente n">
                </div>

                <div class = "form-group">
                    <label for="txtTipoPlatillo" class="form-label mt-4">Example select</label>
                    <select class="form-select" id="txtTipoPlatillo" name="txtTipoPlatillo">
                        <option <?php if($txtTipoPlatillo == "Entradas") echo "selected"; ?>>Entradas</option>
                        <option <?php if($txtTipoPlatillo == "Platos a la carta") echo "selected"; ?>>Platos a la carta</option>
                        <option <?php if($txtTipoPlatillo == "Postres") echo "selected"; ?>>Postres</option>
                        <option <?php if($txtTipoPlatillo == "Bebidas") echo "selected"; ?>>Bebidas</option>
                    </select>
                </div>

                <div class = "form-group">
                    <label for="txtPrecio">Precio</label>
                    <input type="text" required="" class="form-control" value="<?php echo $txtPrecio;?>" id="txtPrecio" name="txtPrecio" placeholder="Precio del platillo">
                </div>

                <div class = "form-group">
                    <label for="txtImagenPlatillo">Imagen:</label>
                    <br>
                    <?php if($txtImagenPlatillo!=""){?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagenPlatillo; ?>" width="50" alt="" srcset="">
                    <?php }?>
                    <input type="file" class="form-control" id="txtImagenPlatillo" name="txtImagenPlatillo" placeholder="Imagen del platillo">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success <?php echo ($accion=="Seleccionar")?"disabled":""; ?>">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning <?php echo ($accion!="Seleccionar")?"disabled":""; ?>">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info <?php echo ($accion!="Seleccionar")?"disabled":""; ?>">Cancelar</button>
                </div>
            </form>
        </div>

    </div>

</div>
<div class="col-md-8">

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Tipo</th>
                <th scope="col">Precio</th>
                <th scope="col">Imagen</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($listaPlatillos as $platillo) { ?>
            <tr class="table-active">
                <th><?php echo $platillo['ID']?></th>
                <td><?php echo $platillo['Nombre']; ?></td>
                <td><?php echo $platillo['Descripcion']; ?></td>
                <td><?php echo $platillo['Tipo']; ?></td>
                <td><?php echo $platillo['Precio']; ?></td>
                <td>
                    
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $platillo['Imagen']; ?>" width="50" alt="" srcset="">
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $platillo['ID']?>" />
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>

</div>
<?php include("../templete/footer.php");?>
