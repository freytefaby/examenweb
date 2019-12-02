<?php
class errores extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje="Error al cargar metodo";
        $this->view->render('errores/index');
    }
}