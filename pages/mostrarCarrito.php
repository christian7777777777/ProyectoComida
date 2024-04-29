<?php
include("../template/header.php");

?>
<br>
<h3>Lista Carrito</h3>

<?php if(!empty($_SESSION['CARRITO'])) {?>
<table class="table table-light table-bordered">
    <thead>
        <tr>
            <th width="40%">Plato</th>
            <th width="5%">Cantidad</th>
            <th width="20%">Costo Unitario</th>
            <th width="20%">Costo Acumulado</th>
            <th width="15%">Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto) {?>
        <tr>
            <td width="40%"><?php echo $producto['PLATO']; ?></td>
            <td width="5%"><?php echo $producto['CANTIDAD']; ?></td>
            <td width="20%"><?php echo $producto['PRECIO']; ?></td>
            <td width="20%"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'], 2); ?></td>
            <td width="15%">
                <form  method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">
                    <button type="submit" class="btn btn-danger" name="AccionCarrito" id="AccionCarrito" value="BorrarCarrito">Borrar</button>
                </form>
                
            </td>
        </tr>
        <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD'])?>
        <?php }?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="rigth"><h3><?php echo number_format($total, 2); ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" >
                <form action="pagar.php" method="post">
                    <input type="hidden" name="emailCliente" id="emailCliente" value=<?php echo $_SESSION['Correo']; ?>>
                    <input type="hidden" name="nombreCliente" id="nombreCliente" value=<?php echo $_SESSION['Cliente']; ?>>
                    <input type="hidden" name="valorPedido" id="valorPedido" value=<?php echo number_format($total, 2); ?>>
                    <input type="hidden" name="mesaCliente" id="mesaCliente" value=<?php echo $_SESSION['Mesa']; ?>>
                    <button type="submit" class="btn btn-secondary" name="pagar" id="pagar" value="pagar">Pagar</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>

<?php }else{ ?>
    <div class="alert alert-success">
        No hay productos en el carrito
    </div>
<?php } ?>
<?php include("../template/footer.php");?>