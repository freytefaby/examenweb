<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>admin</title>
    
    </head>

    <body>
        <?php require ('views/header.php') ?>
        <h4>Catalogo de productos</h4>
       
    <form action="<?php echo constant('URL').'/usuarios/buscarproducto' ?>" method="POST"  >
        <input type="text" name="buscar" placeholder="Buscar por codigo">
        <input type="submit" value="buscar">
    
    </form><br><br>
            <?php
            //var_dump($this->productos);
                foreach($this->productos as $key=> $pro){
                    
                    ?>
                        <div style="float:left; margin-right:30px; border:solid 1px;">
                             <span style="background:green; color:white; margin:10px"><?php echo $pro->nombre ?></span>
                            <p style="font-size:15px; margin:0px; padding:0px;">
                                <?php echo $pro->descripcion ?><br>
                                <?php echo number_format($pro->precio) ?> COP<br>
                                <?php echo $pro->codigo ?><br>
                                Existencia: <?php if($pro->cantidad==0){
                                    echo "<span style='background:red; color:white'>Agotado</span>";
                                }else{
                                    echo $pro->cantidad;
                                }  ?><br>
                                <?php
                                    if($pro->cantidad!=0){
                                        ?>
                                        <a href="<?php echo constant('URL').'/usuarios/compra/'.$pro->idproducto ?>">Comprar</a>
                                        <?php
                                    }
                                ?>
                                
                            </p>
                        
                        </div>
                    <?php
                }
            
            ?>
        </table>
        
       




        <?php require ('views/footer.php') ?>
    </body>


</html>