<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Login extends REST_Controller {


    public function __construct() { 
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Origin: *");
        parent:: __construct();
        $this->load->database();
    }

    //Este servicio realiza el login recibe el correo y la contraseña del usuario
public function index_post(){


    $data= $this->post();

    if(!isset($data['correo']) OR !isset($data['pass'])){

        $respuesta= array("ERROR"=>TRUE, "MSGE"=> "La informacion proporcionada no es valida");

        $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        return;
    }else{

        //SI llegaron las variables necesarias
$condiciones= array('correo'=> $data['correo'], 
'pass'=> $data['pass']);
$query= $this->db->get_where('usuario',$condiciones );
$usuario= $query->row();

if(!isset($usuario)){

    $respuesta= array("ERROR"=>TRUE, "MSGE"=> "Usuario y/o contraseña invalidos");

    $this->response($respuesta);
    return;
}else{
//USuario y contraseña validos
//TOKEN

$token= bin2hex(openssl_random_pseudo_bytes(20));
//$token= hash('ripemd160', $data['correo']);



//Guardar token 
$this->db->reset_query();
$actualizar_token= array('token'=>$token);

$this->db->where( "pk_usuario", $usuario->pk_usuario);

$hecho = $this->db->update('usuario', $actualizar_token);



$respuesta= array("ERROR"=>FALSE, "Token"=> $token, "pk_usuario"=> $usuario->pk_usuario, "correo"=> $usuario->correo, "nombre"=> $usuario->nombre);

$this->response($respuesta);
return;
}

    }

}
//Aqui se hace un registro simple de un usuario
public function singleRegister_post(){

    $data= $this->post();

    if(!isset($data['correo']) OR !isset($data['pass'] ) OR !isset($data['nombre'] ) OR !isset($data['categoria'] ) ){
        $respuesta= array("ERROR"=>TRUE, "MSGE"=> "La informacion proporcionada no es valida");
        $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        return;
    }else{
        $sql = "INSERT INTO usuario (correo, nombre, pass,categoria ) VALUES ('".$data['correo']."', '".$data['nombre']."', '".$data['pass']."', '".$data['categoria']."' )";
        $this->db->query($sql);
        $respuesta= array("ERROR"=>FALSE, "MSGE"=>$this->db->affected_rows() );
        $this->response($respuesta);
        return;
    }


}



}