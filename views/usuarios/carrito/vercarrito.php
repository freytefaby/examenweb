<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>usuario</title>
    
    </head>

    <body>
        <?php require ('views/header.php') ?>
        <h4>Carrito</h4>
        <?php if(isset($_GET["error"])){
            if($_GET["error"]==1){
                echo "<span style='color:red'>El valor de la compra supera el credito elimina algunos productos o pide mas credito al administrdor</span>";
            }

        } ?>
        <table border="3px">
            <tr>
                <th>#</th>
                <th>producto</th>
                <th>cantidad</th>
                <th>precio</th>
                <th>Acciones</th>
                
            </tr>

            <?php
            $count=0;
                foreach($_SESSION["carrito"] as $key=> $pro){
                    $count=$count+$pro["precio"];
                    ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $pro["nombre"]; ?></td>
                          <td><?php echo $pro["cantidad"]; ?></td>
                          <td><?php echo number_format($pro["precio"]); ?></td>
                          <td><a href="<?php echo constant('URL').'/usuarios/eliminarproductocarrito/'.$key ?>">Eliminar</a></td>
                        </tr>

                    <?php
                }

                
            
            ?>

        </table>
        <H2>total: <?php echo number_format($count); ?></H2>
        <?php
            if(count($_SESSION["carrito"])>0){
                ?>
<a href='<?php echo constant('URL').'/usuarios/realizarcompra' ?>'>Realizar compra</a>
                <?php
                            }
         ?>
       
       




        <?php require ('views/footer.php') ?>
    </body>


</html>