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
        <h4>Productos</h4>
        <span style="color:red"><?php if(isset($_GET["error"])){echo $_GET["error"];} ?></span>
        <a href="<?php echo constant('URL').'/productos/create' ?>">Crear un nuevo producto</a>
        <table border="3px">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>codigo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>cantidad</th>
                <th>Acciones</th>
                
            </tr>

            <?php
                foreach($this->productos as $key=> $pro){
                    ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $pro->nombre; ?></td>
                          <td><?php echo $pro->codigo; ?></td>
                          <td><?php echo $pro->descripcion; ?></td>
                          <td><?php echo number_format($pro->precio); ?></td>
                          <td><?php echo $pro->cantidad; ?></td>
                          <td><a href="<?php echo constant('URL').'/productos/edit/'.$pro->idproducto ?>">Editar</a>
                              <a href="<?php echo constant('URL').'/productos/delete/'.$pro->idproducto ?>">Eliminar</a></td>
                        </tr>

                    <?php
                }
            
            ?>
        </table>
        
       




        <?php require ('views/footer.php') ?>
    </body>


</html>