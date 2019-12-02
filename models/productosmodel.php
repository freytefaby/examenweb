<?php
include_once ("models/map/producto.php");
class productosModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $items=[];
        try{
            $query=$this->db->connect()->prepare("select * from productos where creadopor=:user");
            $query->execute(["user"=>$_SESSION["user"]["id"]]);
            while($row = $query->fetch()){
                $item=new producto();
                $item->idproducto=$row["idproducto"];
                $item->precio=$row["precio"];
                $item->nombre=$row["nombre"];
                $item->codigo=$row["codigo"];
                $item->descripcion=$row["descripcion"];
                $item->cantidad=$row["cantidad"];
                $item->creadopor=$row["creadopor"];
                array_push($items,$item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function validateCode($request){
        $query=$this->db->connect()->prepare("select * from productos where codigo=:codigo");
        try{
            $query->execute(['codigo'=>$request["codigo"]]);
            $row=$query->fetch();
            if($row){
                return "true";
            }else{
                return "false";
            }
           
        }catch(PDOException $e){
            return [];
        }
    }

    public function create($request){
        $query=$this->db->connect()->prepare("insert into productos(precio,nombre,codigo,descripcion,creadopor,cantidad) values (:precio,:nombre,:codigo,:descripcion,:creadopor,:cantidad)");
        $query->execute(["precio"=>$request["precio"],
                         "nombre"=>$request["nombre"],
                         "codigo"=>$request["codigo"],
                         "descripcion"=>$request["descripcion"],
                         "cantidad"=>$request["cantidad"],
                         "creadopor"=>$_SESSION["user"]["id"]]);

    }

    public function searchProduct($id){
        $items=[];
        try{
            $query=$this->db->connect()->prepare("select * from productos where idproducto=:idproducto");
            $query->execute(["idproducto"=>$id]);
            while($row = $query->fetch()){
                $item=new producto();
                $item->idproducto=$row["idproducto"];
                $item->precio=$row["precio"];
                $item->nombre=$row["nombre"];
                $item->codigo=$row["codigo"];
                $item->descripcion=$row["descripcion"];
                $item->creadopor=$row["creadopor"];
                $item->cantidad=$row["cantidad"];
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function update($request){
      
            $query=$this->db->connect()->prepare("update productos set precio=:precio, nombre=:nombre, codigo=:codigo, descripcion=:descripcion, creadopor=:creadopor, cantidad=:cantidad  where idproducto=:id");
            $query->execute(["precio"=>$request["precio"],
            "nombre"=>$request["nombre"],
            "codigo"=>$request["codigo"],
            "descripcion"=>$request["descripcion"],
            "creadopor"=>$_SESSION["user"]["id"],
            "cantidad"=>$request["cantidad"],
            "id"=>$_SESSION["idproducto"]]);
        
        
        

    }
    public function delete($id){
        $query=$this->db->connect()->prepare("delete from productos where idproducto=:id");
        $query->execute(["id"=>$id]);
    }

}