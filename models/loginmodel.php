<?php
class loginModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function login($request){
        $pass=md5($request["pass"]);
        $query=$this->db->connect()->prepare("select * from usuario where user=:user and password=:pass");
        try{
            $query->execute(['user'=>$request["user"],
                             'pass'=>$pass]);
            
            
            $row=$query->fetch();
            if($row){
                return $row;
            }else{
                return "false";
            }
           
                
            
            
        }catch(PDOException $e){
            return false;
        }
       
    }
}