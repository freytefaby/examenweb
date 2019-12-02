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
        <h4>Administradores</h4>
        <span style="color:red"><?php if(isset($_GET["error"])){echo $_GET["error"];} ?></span>
        <a href="<?php echo constant('URL').'/administradores/create/1' ?>">Crear un nuevo administrador</a>
        <table border="3px">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Password</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cedula</th>
                <th>Fecha nacimiento</th>
                <th>Perfil</th>
                <th>Acciones</th>
                
            </tr>

            <?php
                foreach($this->admin as $key=> $admins){
                    ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $admins->user; ?></td>
                          <td><?php echo $admins->password; ?></td>
                          <td><?php echo $admins->nombres; ?></td>
                          <td><?php echo $admins->apellidos; ?></td>
                          <td><?php echo $admins->cedula; ?></td>
                          <td><?php echo $admins->fecha_nac; ?></td>
                          <td>Administrdor</td>
                          <td><a href="<?php echo constant('URL').'/administradores/edit/'.$admins->id ?>">Editar</a>
                              <a href="<?php echo constant('URL').'/administradores/delete/'.$admins->id ?>">Eliminar</a></td>
                        </tr>

                    <?php
                }
            
            ?>
        </table>
        
       




        <?php require ('views/footer.php') ?>
    </body>


</html>