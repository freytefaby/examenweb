<?php
session_start();
class Productos extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->code="";
        $this->view->nombre="";
        $this->view->codigo="";
        $this->view->descripcion="";
        $this->view->precio="";
        $this->view->cantidad="";
        $this->view->productos=[];
    }
    public function auth(){
        if(isset($_SESSION["user"])){
            if($_SESSION["user"]["tipoPerfil"]==1){
                
            }else{
                echo "<h3>No tiene permisos porque no eres un administrador</h3>
                    <a href='".constant('URL')."'>Logueate como administrador click aqui!!</a>"; exit;
            }
        }else{
            echo "<h3>Usuario no autenticado </h3>  <a href='".constant('URL')."'>Logueate como administrador click aqui!!</a>"; exit;
        }
    }
    
    function render(){
        $this->auth();
        $productos= $this->model->index();
        $this->view->productos=$productos;
        $this->view->render('admin/productos/index');
    }

    public function create(){
        $this->auth();
        $this->view->render('admin/productos/create');
    }

    public function store(){
        $this->auth();
        $nombre=$_POST["nombre"];
        $codigo=$_POST["codigo"];
        $descripcion=$_POST["descripcion"];
        $precio=$_POST["precio"];
        $cantidad=$_POST["cantidad"];
        $request=array("nombre"=>$nombre,"codigo"=>$codigo,"descripcion"=>$descripcion,"precio"=>$precio,"cantidad"=>$cantidad);
        $state=false;
        foreach ($request as $key => $value) {
            
                if(empty(trim($value))){
                    $this->view->$key=-1;
                    $state=true;
                }else
                {
                    $this->view->$key=$value;
                }
            
           
        }
        if($state){
            $this->view->render('admin/productos/create');
        }else{
            $response=$this->model->validateCode($request);
            if($response=="true"){
                $this->view->code="El codigo ya lo tiene otro producto, intente con otro.";
                $this->view->render('admin/productos/create');
            }else{
                $response=$this->model->create($request);
                header("location: ".constant('URL').'/productos');
            }
        }
        
    }

    public function edit($param=null){
        $this->auth();
        $response=$this->model->searchProduct($param[0]);
        if(count($response)>0){
            foreach ($response as $key => $value) {
                $this->view->precio=$value->precio;
                $this->view->nombre=$value->nombre;
                $this->view->codigo=$value->codigo;
                $this->view->descripcion=$value->descripcion;
                $this->view->creadopor=$value->creadopor;
                $this->view->cantidad=$value->cantidad;
                $_SESSION["idproducto"]=$value->idproducto;
                $_SESSION["codigo"]=$value->codigo;
    }
            $this->view->render('admin/productos/edit');
        }else{
            header("location: ".constant('URL').'/productos?error=no se encontro usuario');
        }
        
       
    }


    public function update(){
        $this->auth();
        $precio=$_POST["precio"];
        $nombre=$_POST["nombre"];
        $codigo=$_POST["codigo"];
        $cantidad=$_POST["cantidad"];
        $descripcion=$_POST["descripcion"];
        $request=array("precio"=>$precio,"nombre"=>$nombre,"codigo"=>$codigo,"descripcion"=>$descripcion,"cantidad"=>$cantidad);
        $state=false;
        foreach ($request as $key => $value) {
            
                if(empty(trim($value))){
                    $this->view->$key=-1;
                    $state=true;
                }else
                {
                    $this->view->$key=$value;
                }
            
            
        }
        if($state){
           $this->view->render('admin/productos/edit');
        }else{
            $response=-1;
            if($_SESSION["codigo"]!=$codigo){
            $response=$this->model->validateCode($request);
            }
            if($response=="true"){
                $this->view->code="El usuario ya existe en la base de datos intenta con otro";
                $this->view->render('admin/productos/edit');
            }else{
                $response=$this->model->update($request);
                unset($_SESSION["idproducto"]);
                unset($_SESSION["codigo"]);
                header("location: ".constant('URL').'/productos');
            }
        }
}


public function delete($param){
    $this->model->delete($param[0]);
    header("location: ".constant('URL').'/productos');
 }
}