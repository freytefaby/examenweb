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
        <h4>Ver compras</h4>
      
        <table border="3px">
            <tr>
                <th>nombre</th>
                <th>cantidad</th>
                <th>precio</th>
                <th>compra</th>
                
                
            </tr>

            <?php
            $count=0;
         
                foreach($this->detalles as $d){
                   
                    ?>
                        <tr>
                          <td><?php echo $d->producto ?></td>
                          <td><?php echo $d->cantidad ?></td>
                          <td><?php echo number_format($d->precio) ?></td>
                          <td><?php echo $d->compraid ?></td>
                         
                          
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