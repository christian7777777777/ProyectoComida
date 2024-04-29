<?php
include("../template/header.php");
?>

<div class="accordion" id="accordionExample">

    <div class="accordion-item">

        <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Entradas
        </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="font-size:1.125rem;text-anchor:middle">
            <div class="accordion-body">
                <div class="row">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM platillos WHERE Tipo = 'Entradas'");
                    $stmt->execute();
                    $listaPlatillos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($listaPlatillos as $Platillo) {
                    ?> 
                    <div class="col-md-3">
                        <div class="card text-center">
                        <img class="card-img-top" src="../img/<?php echo $Platillo['Imagen']; ?>">

                            <div class="card-body">

                                <h4 class="card-title"><?php echo $Platillo['Nombre'] ?></h4>
                                <h6 class="card-text"><?php echo $Platillo['Descripcion'] ?></h6>
                                <span class="badge rounded-pill bg-secondary"><?php echo "$ ".$Platillo['Precio'] ?></span>

                                <form  method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($Platillo['ID'], COD, KEY);  ?>">
                                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo openssl_encrypt($Platillo['Nombre'], COD, KEY);?>">
                                    <input type="hidden" name="Precio" id="Precio" value="<?php echo openssl_encrypt($Platillo['Precio'], COD, KEY);?>">
                                    <input type="hidden" name="Cantidad" id="Cantidad" value="<?php echo openssl_encrypt(1, COD, KEY);?>">
                                    <button type="submit" class="btn btn-success" name="AccionCarrito" id="AccionCarrito" value="AgregarCarrito">Anadir a carrito</button>
                                </form>
                            </div>
                        </div>  
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Platos a la carta
        </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="font-size:1.125rem;text-anchor:middle">
            <div class="accordion-body">
                <div class="row">
                    <?php

                    $stmt = $conn->prepare("SELECT * FROM platillos WHERE Tipo = 'Platos a la carta'");
                    $stmt->execute();
                    $listaPlatillos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($listaPlatillos as $Platillo) {
                    ?> 
                    <div class="col-md-3">
                        <div class="card text-center">
                        <img class="card-img-top" src="../img/<?php echo $Platillo['Imagen']; ?>">

                            <div class="card-body">
                                <h4 class="card-title"><?php echo $Platillo['Nombre'] ?></h4>
                                <h6 class="card-text"><?php echo $Platillo['Descripcion'] ?></h6>
                                <span class="badge rounded-pill bg-secondary"><?php echo "$ ".$Platillo['Precio'] ?></span>
                                
                                <form  method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($Platillo['ID'], COD, KEY);  ?>">
                                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo openssl_encrypt($Platillo['Nombre'], COD, KEY);?>">
                                    <input type="hidden" name="Precio" id="Precio" value="<?php echo openssl_encrypt($Platillo['Precio'], COD, KEY);?>">
                                    <input type="hidden" name="Cantidad" id="Cantidad" value="<?php echo openssl_encrypt(1, COD, KEY);?>">
                                    <button type="submit" class="btn btn-success" name="AccionCarrito" id="AccionCarrito" value="AgregarCarrito">Anadir a carrito</button>
                                </form>

                            </div>
                        </div>  
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Postres
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="font-size:1.125rem;text-anchor:middle">
            <div class="accordion-body">
                <div class="row">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM platillos WHERE Tipo = 'Postres'");
                    $stmt->execute();
                    $listaPlatillos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($listaPlatillos as $Platillo) {
                    ?> 
                    <div class="col-md-3">
                        <div class="card text-center">
                        <img class="card-img-top" src="../img/<?php echo $Platillo['Imagen']; ?>">

                            <div class="card-body">
                                <h4 class="card-title"><?php echo $Platillo['Nombre'] ?></h4>
                                <h6 class="card-text"><?php echo $Platillo['Descripcion'] ?></h6>
                                <span class="badge rounded-pill bg-secondary"><?php echo "$ ".$Platillo['Precio'] ?></span>

                                <form  method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($Platillo['ID'], COD, KEY);  ?>">
                                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo openssl_encrypt($Platillo['Nombre'], COD, KEY);?>">
                                    <input type="hidden" name="Precio" id="Precio" value="<?php echo openssl_encrypt($Platillo['Precio'], COD, KEY);?>">
                                    <input type="hidden" name="Cantidad" id="Cantidad" value="<?php echo openssl_encrypt(1, COD, KEY);?>">
                                    <button type="submit" class="btn btn-success" name="AccionCarrito" id="AccionCarrito" value="AgregarCarrito">Anadir a carrito</button>
                                </form>

                            </div>
                        </div>  
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Bebidas
            </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample" style="font-size:1.125rem;text-anchor:middle">
            <div class="accordion-body">
                <div class="row">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM platillos WHERE Tipo = 'Bebidas'");
                    $stmt->execute();
                    $listaPlatillos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($listaPlatillos as $Platillo) {
                    ?> 
                    <div class="col-md-3">
                        <div class="card text-center">
                        <img class="card-img-top" src="../img/<?php echo $Platillo['Imagen']; ?>">

                            <div class="card-body">
                                <h4 class="card-title"><?php echo $Platillo['Nombre'] ?></h4>
                                <h6 class="card-text"><?php echo $Platillo['Descripcion'] ?></h6>
                                <span class="badge rounded-pill bg-secondary"><?php echo "$ ".$Platillo['Precio'] ?></span>

                                <form  method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($Platillo['ID'], COD, KEY);  ?>">
                                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo openssl_encrypt($Platillo['Nombre'], COD, KEY);?>">
                                    <input type="hidden" name="Precio" id="Precio" value="<?php echo openssl_encrypt($Platillo['Precio'], COD, KEY);?>">
                                    <input type="hidden" name="Cantidad" id="Cantidad" value="<?php echo openssl_encrypt(1, COD, KEY);?>">
                                    <button type="submit" class="btn btn-success" name="AccionCarrito" id="AccionCarrito" value="AgregarCarrito">Anadir a carrito</button>
                                </form>
                                
                            </div>
                        </div>  
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../template/footer.php");?>
    



