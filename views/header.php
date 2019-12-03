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
  <td><a href="<?php echo constant('URL').'/usuarios/vercarrito' ?>">carrito[<?php echo count($_SESSION["carrito"]) ?>]</a></td>
  <td><a href="<?php echo constant('URL').'/usuarios/miscompras' ?>">mis compras</a></td>
  <td><a href="<?php echo constant('URL').'/usuarios' ?>">catalogo</a></td>
  <td><a href="#">Mi saldo $<?php echo number_format($_SESSION["user"]["credito"]) ?></a></td>
 </tr>
</table>

<?php
}
?>
