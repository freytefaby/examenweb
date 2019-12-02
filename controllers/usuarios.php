<?php
session_start();
class Usuarios extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->productos=[];
    }
    
    
    function render(){
        $productos= $this->model->index();
        $this->view->productos=$productos;
        $this->view->render('usuarios/index');
    }

    public function buscarproducto(){
        var_dump($_POST);
        $productos= $this->model->buscarproducto($_POST["buscar"]);
        $this->view->productos=$productos;
        $this->view->render('usuarios/index');
    }

}