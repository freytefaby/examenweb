<?php
include_once ("models/map/admin.php");
class administradoresModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function index($tipo){
        $items=[];
        try{
            $query=$this->db->connect()->prepare("select * from usuario where tipoPerfil=:tipo and creadopor=:user");
            $query->execute(["tipo"=>$tipo,"user"=>$_SESSION["user"]["id"]]);
            while($row = $query->fetch()){
                $item=new admin();
                $item->id=$row["id"];
                $item->user=$row["user"];
                $item->password=$row["password"];
                $item->nombres=$row["nombres"];
                $item->apellidos=$row["apellidos"];
                $item->cedula=$row["cedula"];
                $item->fecha_nac=$row["fecha_nac"];
                $item->tipoPerfil=$row["tipoPerfil"];
                $item->correo=$row["correo"];
                $item->credito=$row["credito"];
                array_push($items,$item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function validateUser($request){
        $query=$this->db->connect()->prepare("select * from usuario where user=:user");
        try{
            $query->execute(['user'=>$request["user"]]);
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
        $query=$this->db->connect()->prepare("insert into usuario(user,password,nombres,apellidos,cedula,fecha_nac,tipoPerfil,creadopor,credito,correo) values (:user,:password,:nombres,:apellidos,:cedula,:fecha_nac,:tipoPerfil,:creadopor,:credito,:correo)");
        $query->execute(["user"=>$request["user"],
                         "password"=>md5($request["password"]),
                         "nombres"=>$request["nombre"],
                         "apellidos"=>$request["apellido"],
                         "cedula"=>$request["cedula"],
                         "fecha_nac"=>$request["fecha_nac"],
                         "tipoPerfil"=>$request["tipo"],
                         "correo"=>$request["correo"],
                         "credito"=>$request["credito"],
                         "creadopor"=>$_SESSION["user"]["id"]]);

    }

    public function searchAdmin($id){
        $items=[];
        try{
            $query=$this->db->connect()->prepare("select * from usuario where id=:id");
            $query->execute(["id"=>$id]);
            while($row = $query->fetch()){
                $item=new admin();
                $item->id=$row["id"];
                $item->user=$row["user"];
                $item->password=$row["password"];
                $item->nombres=$row["nombres"];
                $item->apellidos=$row["apellidos"];
                $item->cedula=$row["cedula"];
                $item->fecha_nac=$row["fecha_nac"];
                $item->tipoPerfil=$row["tipoPerfil"];
                $item->correo=$row["correo"];
                $item->credito=$row["credito"];
                array_push($items,$item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function update($request){
        if(empty($request["password"])){
            $query=$this->db->connect()->prepare("update usuario set user=:user, nombres=:nombres, apellidos=:apellidos, cedula=:cedula, fecha_nac=:fecha_nac,tipoPerfil=:tipoPerfil, correo=:correo, credito=:credito where id=:id");
            $query->execute(["user"=>$request["user"],
            "nombres"=>$request["nombre"],
            "apellidos"=>$request["apellido"],
            "cedula"=>$request["cedula"],
            "fecha_nac"=>$request["fecha_nac"],
            "tipoPerfil"=>$request["tipo"],
            "correo"=>$request["correo"],
            "credito"=>$request["credito"],
            "id"=>$_SESSION["idupdate"]]);
        }else{
            $query=$this->db->connect()->prepare("update usuario set user=:user, password=:password, nombres=:nombres, apellidos=:apellidos, cedula=:cedula, fecha_nac=:fecha_nac,tipoPerfil=:tipoPerfil, correo=:correo, credito=:credito where id=:id");
            $query->execute(["user"=>$request["user"],
                         "password"=>md5($request["password"]),
                         "nombres"=>$request["nombre"],
                         "apellidos"=>$request["apellido"],
                         "cedula"=>$request["cedula"],
                         "fecha_nac"=>$request["fecha_nac"],
                         "tipoPerfil"=>$request["tipo"],
                         "correo"=>$request["correo"],
                         "credito"=>$request["credito"],
                         "id"=>$_SESSION["idupdate"]]);
        }
        
        

    }
    public function delete($id){
        $query=$this->db->connect()->prepare("delete from usuario where id=:id or creadopor=:creado");
        $query->execute(["id"=>$id,"creado"=>$id]);
    }

}