<?php
session_start();
class Usuarios extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->productos=[];
        $this->view->infop=[];
        $this->view->compras=[];
        $this->view->detalles=[];
       
    }
    
    
    function render(){
        $productos= $this->model->index();
        $this->view->productos=$productos;
        $this->view->render('usuarios/index');
    }

    public function buscarproducto(){
        $productos= $this->model->buscarproducto($_POST["buscar"],"codigo");
        $this->view->productos=$productos;
        $this->view->render('usuarios/index');
    }

    public function carrito($param)
    {  
        $productos= $this->model->buscarproducto($param[0],"idproducto");
        $this->view->infop=$productos;
        $this->view->render('usuarios/carrito/add');
        // $productos= $this->model->buscarproducto($param[0],"idproducto");
        // $arr = json_decode(json_encode($productos), true);
        // array_push($_SESSION["carrito"],$arr);
       
    }

    public function carritoguardar(){
        $sw=0;
        if($_POST["cantidad"]>0){
            if(count($_SESSION["carrito"])>0){
                foreach ($_SESSION["carrito"] as  $value) {
                    if($value["id"]==$_POST["id"]){
                        $sw=1;
                    }
                }
    
                
                if($sw==0){
                    $arr=array("id"=>$_POST["id"],"nombre"=>$_POST["producto"],"cantidad"=>$_POST["cantidad"],"precio"=>$_POST["cantidad"]*$_POST["precio"],"cantidad_old"=>$_POST["cantidad_old"]);
                    array_push($_SESSION["carrito"],$arr);
                    header("location:".constant('URL').'/usuarios');
                }else{
                    header("location:".constant('URL').'/usuarios/carrito/'.$_POST["id"].'?error=1');
                }
    
    
                //var_dump($_SESSION["carrito"]);
              
            }
            else{
                $arr=array("id"=>$_POST["id"],"nombre"=>$_POST["producto"],"cantidad"=>$_POST["cantidad"],"precio"=>$_POST["cantidad"]*$_POST["precio"],"cantidad_old"=>$_POST["cantidad_old"]);
                array_push($_SESSION["carrito"],$arr);
                header("location:".constant('URL').'/usuarios');
            }
    
        }else{
            header("location:".constant('URL').'/usuarios/carrito/'.$_POST["id"].'?error=2');
        }
        
       
        
    }

    public function vercarrito(){
        $this->view->render('usuarios/carrito/vercarrito');
    }

    public function eliminarproductocarrito($param){
        unset($_SESSION["carrito"][$param[0]]);
        header("location:".constant('URL').'/usuarios/vercarrito');
    }

    public function realizarcompra(){
        $count=0;
        $cant=0;
        foreach ($_SESSION["carrito"] as $value) {
           $count=$count+$value["precio"];
           $cant=$cant+1;
        }
        if($_SESSION["user"]["credito"]>=$count){

            $arr=array("usuario"=>$_SESSION["user"]["id"],
            "total"=>$count,
            "cantidad"=>$cant );
            $data=$this->model->realizarcompra($arr);
            foreach($_SESSION["carrito"] as $value2){
                $this->model->detalles($value2["id"],$value2["cantidad"],$value2["precio"],$data);
                $this->model->actualizarp($value2["id"],$value2["cantidad_old"]-$value2["cantidad"]);
            }
            $this->model->actualizarUser($_SESSION["user"]["credito"]-$count,$_SESSION["user"]["id"]);
            $_SESSION["user"]["credito"]=$_SESSION["user"]["credito"]-$count;
            $_SESSION["carrito"]=[];
            header("location:".constant('URL').'/usuarios');
            
        }else{
            header("location:".constant('URL').'/usuarios/vercarrito?error=1');
        }
    }

    public function miscompras(){
        $compra= $this->model->compras();
        $this->view->compras=$compra;
        $this->view->render('usuarios/compra/vercompra');
    }

    public function detallecompra($param){
        $detail= $this->model->detallecompra($param[0]);
        $this->view->detalles=$detail;
        $this->view->render('usuarios/compra/detallecompra');
    }
}