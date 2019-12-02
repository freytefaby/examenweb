<?php

class View{
    function __construct(){
        
    }

    public function render($nombre){
        require 'views/'.$nombre.'.php';
    }
}