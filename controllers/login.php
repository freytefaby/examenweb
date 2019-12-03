<?php
session_start();
class Login extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->errors="";
    }

    function render(){
        $this->view->render('login/login');
    }

    public function login(){
       $user=$_POST["user"];
       $pass=$_POST["pass"];
       $request=["user"=>$user, "pass"=>$pass];
       $response=$this->model->login($request);
       if($response=="false"){
            $this->view->errors="Usuario y contraseña incorrecto";
            $this->view->render('login/login');
       }else{
            $_SESSION["user"]=$response;
            if($response["tipoPerfil"]==1){
                header('location:'.constant('URL').'/administradores');
            }else{
                $_SESSION["carrito"]=array();
                header('location:'.constant('URL').'/usuarios');
            }
            
            
       }
       
    }


}