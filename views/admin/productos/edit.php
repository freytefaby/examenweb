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
        <h4>
        editar producto</h4>
        <?php if($this->code!=""){
            ?>  
                <span style="color:red; font-weigth:bold"><?php echo $this->code; ?></span>
            <?php
        } ?>
        <form action="<?php echo constant('URL').'/productos/update' ?>" method="POST">
            <input type="text" name="nombre" placeholder="nombre" value="<?php if($this->nombre!=-1){echo $this->nombre;} ?>">
            <?php if($this->nombre==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="codigo" name="codigo" placeholder="codigo" value="<?php if($this->codigo!=-1){echo $this->codigo;} ?>">
            <?php if($this->codigo==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="text" name="descripcion" placeholder="descripcion" value="<?php if($this->descripcion!=-1){echo $this->descripcion;} ?>">
            <?php if($this->descripcion==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="number" name="precio" placeholder="precio" value="<?php if($this->precio!=-1){echo $this->precio;} ?>">
            <?php if($this->precio==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="number" name="cantidad" placeholder="cantidad" value="<?php if($this->cantidad!=-1){echo $this->cantidad;} ?>">
            <?php if($this->cantidad==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>
            
            <input type="submit" value="guardar">
        
        </form>
        
       




        <?php require ('views/footer.php') ?>
    </body>


</html>