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
        <h4>Agregar al carrito</h4>
        <?php if(isset($_GET["error"])){
            if($_GET["error"]==1){
                echo "<span style='color:red'>Este producto ya se encuentra en el carrito.</span>";
            }else
            {
                echo "<span style='color:red'>Debe ser una cantidad mayor a 0</span>";
            }
        } ?>
       <form method="POST" action="<?php echo constant('URL').'/usuarios/carritoguardar' ?>">
            <?php
            //var_dump($this->productos);
                foreach($this->infop as $key=> $pro){
                    
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
                                        <input type="hidden" name="producto" value="<?php echo $pro->nombre ?>">
                                        <input type="hidden" name="id" value="<?php echo $pro->idproducto ?>">
                                        <input type="hidden" name="precio" value="<?php echo $pro->precio ?>">
                                        <input type="hidden" name="cantidad_old" value="<?php echo $pro->cantidad ?>">
                                        <input type="number" name="cantidad" min="1" max="<?php echo $pro->cantidad ?>" placeholder="cantidad"  >
                                        <input type="submit" value="Agregar" >
                                        <?php
                                    }
                                ?>
                                
                            </p>
                        
                        </div>
                    <?php
                }
            
            ?>
       </form>
        
       




        <?php require ('views/footer.php') ?>
    </body>


</html>