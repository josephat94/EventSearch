<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Imagen extends REST_Controller {


    public function __construct() { 
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Origin: *");
        parent:: __construct();
        $this->load->database();
    }



    //En el siguiente metodo se Inserta una imagen en la base de datos
    //REcibe la ruta de ubicacion
    //La llave del espacio
    //la fehca de subida
public function AgregarImagen_post(){
$data=$this->post();


if (isset($data['ruta']) && isset($data['fk_espacio']) ) {

    $sql = "INSERT INTO imagen (ruta, fk_espacio, fecha_subida ) VALUES ('".$data['ruta']."', ".$data['fk_espacio'] .", now() )";
    $this->db->query($sql);
    
    $respuesta = array(
        "ERROR" => FALSE,
    
        "DATA_CURRENT" => $this->db->affected_rows()
    );


}else{

    $respuesta=array("ERORR"=>TRUE, "MSGE"=>"Error en los datos ingresados");
}

$this-> response($respuesta);

}


// En este servicio se borra una Imagen  por us clave
//Recibe la llave de la imagen
public function BorrarImagen_post(){

    $data = $this->post();

    if (isset($data['pk_imagen']) ){


        $sql = "DELETE from  imagen  WHERE pk_imagen=".$data['pk_imagen'];
        $this->db->query($sql);

        $respuesta = array(
            "ERROR" => FALSE,
        
            "DATA_CURRENT" => $this->db->affected_rows()
        );

    }else{

        $respuesta = array(
            "ERROR" => true,
            "DATA_CURRENT" => "ERROR en los datos recibidos"
        );

    }




    $this->response($respuesta);
}


}