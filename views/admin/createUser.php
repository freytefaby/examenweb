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
        Crear Usuario</h4>
        <?php if($this->user2!=""){
            ?>  
                <span style="color:red; font-weigth:bold"><?php echo $this->user2; ?></span>
            <?php
        } ?>
        <form action="<?php echo constant('URL').'/administradores/storeU' ?>" method="POST">
            <input type="text" name="user" placeholder="user" value="<?php if($this->user!=-1){echo $this->user;} ?>">
            <?php if($this->user==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="password" name="password" placeholder="contraseña" value="<?php if($this->password!=-1){echo $this->password;} ?>">
            <?php if($this->password==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="text" name="nombre" placeholder="nombre" value="<?php if($this->nombre!=-1){echo $this->nombre;} ?>">
            <?php if($this->nombre==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="text" name="apellido" placeholder="apellido" value="<?php if($this->apellido!=-1){echo $this->apellido;} ?>">
            <?php if($this->apellido==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="text" name="cedula" placeholder="cedula" value="<?php if($this->cedula!=-1){echo $this->cedula;} ?>">
            <?php if($this->cedula==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="date" name="fecha_nac" placeholder="fecha de nacimiento" value="<?php if($this->fecha_nac!=-1){echo $this->fecha_nac;} ?>">
            <?php if($this->fecha_nac==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="email" name="correo" placeholder="Correo" value="<?php if($this->correo!=-1){echo $this->correo;} ?>">
            <?php if($this->correo==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>

            <input type="number" name="credito" placeholder="credito" value="<?php if($this->credito!=-1){echo $this->credito;} ?>">
            <?php if($this->credito==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>
           <!--<select name="tipo">
                <option value="0">Seleccione</option>
                <?php
                    $var=["1"=>"Administrador","2"=>"Usuario"];
                   
                    foreach ($var as $key => $value) {
                        if($this->tipo==$key){
                            ?>
                            <option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
                        <?php
                        }else{
                            ?>
                            <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                            <?php
                        }
                       ?>
                       
                       <?php
                    }
                
                ?>
    
            </select>
            <?php if($this->tipo==-1){echo "<span style='color:red'>Este campo es requerido</span>";} ?><br><br>-->
            <input type="submit" value="guardar usuario">
        
        </form>
        
       




        <?php require ('views/footer.php') ?>
    </body>


</html>