<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    
    </head>

    <body>
        <h1>Login del sistema</h1>
        <p style="color:red"><?php echo $this->errors ?></p>
        <form method="POST" action="<?php echo constant('URL'); ?>/login/login">
            <input type="text" name="user" placeholder="usuario"><br><br>
            <input type="password" name="pass" placeholder="password"><br><br>
            <input type="submit" value="ingresar">
        
        </form>
    </body>


</html>