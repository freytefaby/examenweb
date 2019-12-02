<?php if($_SESSION["user"]["tipoPerfil"]==1)
{
?>
<h3>Menu de administrador</h3>
<table>
 <tr>
  <td><a href="<?php echo constant('URL') ?>">Login</a></td>
  <td><a href="<?php echo constant('URL').'/administradores' ?>">Administradores</a></td>
  <td><a href="<?php echo constant('URL').'/administradores/usuarios' ?>">Usuarios</a></td>
  <td><a href="<?php echo constant('URL').'/productos' ?>">Productos</a></td>
 </tr>
</table>

<?php
}else
{
?>
<h3>Menu de usuario</h3>
<table>
 <tr>
  <td><a href="<?php echo constant('URL') ?>">Login</a></td>
  <td><a href="<?php echo constant('URL').'/administradores' ?>">carrito</a></td>
  <td><a href="<?php echo constant('URL').'/administradores/usuarios' ?>">mis compras</a></td>
  <td><a href="<?php echo constant('URL').'/productos' ?>">Productos</a></td>
 </tr>
</table>

<?php
}
?>
