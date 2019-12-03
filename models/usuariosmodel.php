<?php
include_once ("models/map/producto.php");
include_once ("models/map/compra.php");
include_once ("models/map/detalle.php");
class usuariosModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $items=[];
        try{
            $query=$this->db->connect()->query("select * from productos");
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

    public function buscarproducto($request,$param){
        $items=[];
        if(empty($request)){
            $query=$this->db->connect()->query("select * from productos");
        }else{
            $query=$this->db->connect()->prepare("select * from productos where $param=:codigo");
        }
       
        try{
            $query->execute(['codigo'=>$request]);
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

    public function create($request){
        $query=$this->db->connect()->prepare("insert into productos(precio,nombre,codigo,descripcion,creadopor) values (:precio,:nombre,:codigo,:descripcion,:creadopor)");
        $query->execute(["precio"=>$request["precio"],
                         "nombre"=>$request["nombre"],
                         "codigo"=>$request["codigo"],
                         "descripcion"=>$request["descripcion"],
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
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

   public function realizarcompra($request){
      
       $fecha=new DateTime();
    $query=$this->db->connect()->prepare("insert into compra(usuario,total,cantidad_productos,fecha) values (:usuario,:total,:cantidad_productos,:fecha)");
    $query->execute(["usuario"=>$request["usuario"],
                     "total"=>$request["total"],
                     "cantidad_productos"=>$request["cantidad"],
                     "fecha"=>$fecha->format('Y-m-d')]);
       $query2=$this->db->connect()->query("select idcompra from compra ORDER BY idcompra desc limit 0,1");
       $data=$query2->fetch();
       return $data["idcompra"];
   }

   public function actualizarp($id,$cantidad){
    $query=$this->db->connect()->prepare("update productos set cantidad=:cantidad where idproducto=:idproducto");
    $query->execute(["cantidad"=>$cantidad,
                     "idproducto"=>$id]);

   }

   public function detalles($id,$cantidad,$precio,$data){
    $query=$this->db->connect()->prepare("insert into detalle(producto,cantidad,precio,compraid) values (:producto,:cantidad,:precio,:compraid)");
    $query->execute(["producto"=>$id,
                     "cantidad"=>$cantidad,
                     "precio"=>$precio,
                     "compraid"=>$data]);

   }

   public function actualizarUser($cantidad,$id){
    $query=$this->db->connect()->prepare("update usuario set credito=:credito where id=:id");
    $query->execute(["credito"=>$cantidad,
                     "id"=>$id]);
   }

   public function compras(){
    $items=[];
    try{
        $query=$this->db->connect()->prepare("select * from compra where usuario=:usuario");
        $query->execute(["usuario"=>$_SESSION["user"]["id"]]);
        while($row = $query->fetch()){
            $item=new compra();
            $item->idcompra=$row["idcompra"];
            $item->usuario=$row["usuario"];
            $item->total=$row["total"];
            $item->cantidad_productos=$row["cantidad_productos"];
            $item->fecha=$row["fecha"];
            array_push($items,$item);
        }
        return $items;
    }catch(PDOException $e){
        return [];
    }

   }

   public function detallecompra($id){
    $items=[];
    try{
        $query=$this->db->connect()->prepare("select d.iddetalle, p.nombre, d.cantidad, d.precio, d.compraid from detalle as d inner join productos as p on p.idproducto=d.producto where compraid=:id");
        $query->execute(["id"=>$id]);
        while($row = $query->fetch()){
            $item=new detalle();
            $item->iddetalle=$row["iddetalle"];
            $item->producto=$row["nombre"];
            $item->cantidad=$row["cantidad"];
            $item->precio=$row["precio"];
            $item->compraid=$row["compraid"];
            array_push($items,$item);
        }
        return $items;
    }catch(PDOException $e){
        return [];
    }

   }

}