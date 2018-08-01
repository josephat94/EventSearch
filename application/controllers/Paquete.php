<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . '/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

//Esta es la clase del Paquete misma que incluye los servicios para manipular dicho modelo
class Paquete extends REST_Controller
{


    public function __construct()
    {
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->database();
    }


    public function AgregarPaquete_post()
    {
        $data = $this->post();

        if (isset($data['fk_espacio']) && isset($data['nombre']) &&
            isset($data['descripcion']) && isset($data['precio']) && isset($data['personas'])) {

// aqui se debe insertar el paquete para el espacio

$sql = "INSERT INTO paquete (nombre, descripcion, precio,personas, fk_espacio, fecha_creacion ) VALUES ('".$data['nombre']."', '".$data['descripcion']."', ".$data['precio'].", ".$data['personas'].", ".$data['fk_espacio'] .", now() )";
$this->db->query($sql);


$respuesta = array(
    "ERROR" => FALSE,

    "DATA_CURRENT" => $this->db->affected_rows()
);
        } else {
            $respuesta = array(
                "ERROR" => true,
                "DATA_CURRENT" => "ERROR en los datos recibidos"
            );
        }
        $this->response($respuesta);
    }



//En este servicio se obtienen todas la reservacionoes por espacio
//Recibe la llave del espacio
public function getPaquetesEspacio_post(){

$data=$this->post();

if (isset($data['fk_espacio']) ) {

    $sql = "SELECT * FROM paquete WHERE fk_espacio= ". $data['fk_espacio'];
  $query=   $this->db->query($sql);
  $respuesta = array(
    "ERROR" => FALSE,
    "DATA_CURRENT" => $query->result_array()
);

}else{

    $respuesta = array(
        "ERROR" => TRUE,
        "DATA_CURRENT" => "ERROR en los datos recibidos"
    );

}
$this->response($respuesta);
}


// En este servicio se borra un paquete por us clave
//Recibe la llave del Paquete
public function BorrarPaquete_post(){

    $data = $this->post();

    if (isset($data['pk_paquete']) ){


        $sql = "DELETE from  paquete  WHERE pk_paquete=".$data['pk_paquete'];
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