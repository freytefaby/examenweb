<?php
session_start();
class Administradores extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->user2="";
        $this->view->id="";
        $this->view->user="";
        $this->view->password="";
        $this->view->nombre="";
        $this->view->apellido="";
        $this->view->cedula="";
        $this->view->fecha_nac="";
        $this->view->correo="";
        $this->view->credito=0;
        $this->view->tipo=0;
        $this->view->admin=[];
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
        $admin= $this->model->index(1);
        $this->view->admin=$admin;
        $this->view->render('admin/administradores');
    }

    function create($param=null){
        $this->auth();
        if($param[0]==1){
    
            $this->view->render('admin/create');
        }else{
            $this->view->render('admin/createUser');
        }
        

    }
    

    public function store(){
        $this->auth();
        $user=$_POST["user"];
        $password=$_POST["password"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $cedula=$_POST["cedula"];
        $fecha_nac=$_POST["fecha_nac"];
        $tipo=1;
        $correo=null;
        $credito=null;
        $request=array("user"=>$user,"password"=>$password,"nombre"=>$nombre,"apellido"=>$apellido,"cedula"=>$cedula,"fecha_nac"=>$fecha_nac,"tipo"=>$tipo,"correo"=>$correo,"credito"=>$credito);
        $state=false;
        foreach ($request as $key => $value) {
            if($key!="correo" && $key!="credito"){
                if(empty(trim($value))){
                    $this->view->$key=-1;
                    $state=true;
                }else
                {
                    $this->view->$key=$value;
                }
            }
           
        }
        if($state){
            $this->view->render('admin/create');
        }else{
            $response=$this->model->validateUser($request);
            if($response=="true"){
                $this->view->user2="El usuario ya existe en la base de datos intenta con otro";
                $this->view->render('admin/create');
            }else{
                $response=$this->model->create($request);
                header("location: ".constant('URL').'/administradores');
            }
        }
        
    }

    public function storeU(){
        $this->auth();
        $user=$_POST["user"];
        $password=$_POST["password"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $cedula=$_POST["cedula"];
        $fecha_nac=$_POST["fecha_nac"];
        $tipo=2;
        $correo=$_POST["correo"];
        $credito=$_POST["credito"];
        $request=array("user"=>$user,"password"=>$password,"nombre"=>$nombre,"apellido"=>$apellido,"cedula"=>$cedula,"fecha_nac"=>$fecha_nac,"tipo"=>$tipo,"correo"=>$correo,"credito"=>$credito);
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
            $this->view->render('admin/createUser');
        }else{
            $response=$this->model->validateUser($request);
            if($response=="true"){
                $this->view->user2="El usuario ya existe en la base de datos intenta con otro";
                $this->view->render('admin/createUser');
            }else{
                $response=$this->model->create($request);
                header("location: ".constant('URL').'/administradores/usuarios');
            }
        }
        
    }
    public function edit($param=null){
        $this->auth();
        $response=$this->model->searchAdmin($param[0]);
        $this->view->admin=$response;
        if(count($this->view->admin)>0){
            foreach ($this->view->admin as $key => $value) {
                $this->view->user=$value->user;
                $this->view->password=$value->password;
                $this->view->nombre=$value->nombres;
                $this->view->apellido=$value->apellidos;
                $this->view->cedula=$value->cedula;
                $this->view->fecha_nac=$value->fecha_nac;
                $this->view->tipo=$value->tipoPerfil;
                $_SESSION["idupdate"]=$value->id;
                $_SESSION["userupdate"]=$value->user;
                
            }
            $this->view->render('admin/edit');
        }else{
            header("location: ".constant('URL').'/administradores?error=no se encontro usuario');
        }
        
       
    }

    public function editU($param=null){
        $this->auth();
        $response=$this->model->searchAdmin($param[0]);
        $this->view->admin=$response;
        if(count($this->view->admin)>0){
            foreach ($this->view->admin as $key => $value) {
                $this->view->user=$value->user;
                $this->view->password=$value->password;
                $this->view->nombre=$value->nombres;
                $this->view->apellido=$value->apellidos;
                $this->view->cedula=$value->cedula;
                $this->view->fecha_nac=$value->fecha_nac;
                $this->view->tipo=$value->tipoPerfil;
                $this->view->correo=$value->correo;
                $this->view->credito=$value->credito;
                $_SESSION["idupdate"]=$value->id;
                $_SESSION["userupdate"]=$value->user;
                
            }
            $this->view->render('admin/editU');
        }else{
            header("location: ".constant('URL').'/administradores/usuarios?error=no se encontro usuario');
        }
        
       
    }

    public function update(){
        $this->auth();
        $user=$_POST["user"];
        $password=$_POST["password"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $cedula=$_POST["cedula"];
        $fecha_nac=$_POST["fecha_nac"];
        $tipo=1;
        $correo=null;
        $credito=null;
        $request=array("user"=>$user,"password"=>$password,"nombre"=>$nombre,"apellido"=>$apellido,"cedula"=>$cedula,"fecha_nac"=>$fecha_nac,"tipo"=>$tipo,"correo"=>$correo,"credito"=>$credito);
        $state=false;
        foreach ($request as $key => $value) {
            if($key!="password" && $key!="correo" && $key!="credito"){
                if(empty(trim($value))){
                    $this->view->$key=-1;
                    $state=true;
                }else
                {
                    $this->view->$key=$value;
                }
            }
            
        }
        if($state){
           $this->view->render('admin/edit');
        }else{
            $response=-1;
            if($_SESSION["userupdate"]!=$user){
            $response=$this->model->validateUser($request);
            }
            if($response=="true"){
                $this->view->user2="El usuario ya existe en la base de datos intenta con otro";
                $this->view->render('admin/edit');
            }else{
                $response=$this->model->update($request);
                unset($_SESSION["idupdate"]);
                unset($_SESSION["userupdate"]);
                header("location: ".constant('URL').'/administradores');
            }
        }
}

public function updateU(){
    $this->auth();
    $user=$_POST["user"];
    $password=$_POST["password"];
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $cedula=$_POST["cedula"];
    $fecha_nac=$_POST["fecha_nac"];
    $tipo=2;
    $correo=$_POST["correo"];
    $credito=$_POST["credito"];
    $request=array("user"=>$user,"password"=>$password,"nombre"=>$nombre,"apellido"=>$apellido,"cedula"=>$cedula,"fecha_nac"=>$fecha_nac,"tipo"=>$tipo,"correo"=>$correo,"credito"=>$credito);
    $state=false;
    foreach ($request as $key => $value) {
        if($key!="password"){
            if(empty(trim($value))){
                $this->view->$key=-1;
                $state=true;
            }else
            {
                $this->view->$key=$value;
            }
        }
        
    }
    if($state){
       $this->view->render('admin/editU');
    }else{
        $response=-1;
        if($_SESSION["userupdate"]!=$user){
        $response=$this->model->validateUser($request);
        }
        if($response=="true"){
            $this->view->user2="El usuario ya existe en la base de datos intenta con otro";
            $this->view->render('admin/editU');
        }else{
            $response=$this->model->update($request);
            unset($_SESSION["idupdate"]);
            unset($_SESSION["userupdate"]);
            header("location: ".constant('URL').'/administradores/usuarios');
        }
    }
}

public function delete($param){
   $this->model->delete($param[0]);
   header("location: ".constant('URL').'/administradores');
}
public function deleteU($param){
    $this->model->delete($param[0]);
    header("location: ".constant('URL').'/administradores/usuarios');
 }

public function usuarios(){
    $this->auth();
    $admin= $this->model->index(2);
    $this->view->admin=$admin;
    $this->view->render('admin/usuarios');
}



    


}