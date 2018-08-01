<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Reservacion extends REST_Controller {


    public function __construct() { 
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Origin: *");
        parent:: __construct();
        $this->load->database();
    } 
    
    


//En este metodo se obtienen todas las reservaciones de un espacio
    public function getReservacion_post()
    {
        $data = $this->post();

        if (isset($data['fk_espacio']) ) 
            {


$sql = "SELECT * from reservacion where fk_espacio=".  $data['fk_espacio'];
$query= $this->db->query($sql);


$respuesta = array(
    "ERROR" => FALSE,

    "DATA_CURRENT" => $query->result_array()
);
        } else {
            $respuesta = array(
                "ERROR" => true,
                "DATA_CURRENT" => "ERROR en los datos recibidos"
            );
        }
        $this->response($respuesta);
    }




    public function AgregarReservacion_post()
    {
        $data = $this->post();

        if (isset($data['fk_espacio']) && isset($data['fecha']) 
           ) {

// aqui se debe insertar la resrvacion

$sql = "INSERT INTO reservacion (fk_espacio, fecha ) VALUES (".$data['fk_espacio'] .",".$data['fecha'].")";
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

//En este servicio se borra una reservacion por su PK
    public function BorrarReservacion_post(){

        $data = $this->post();

        if (isset($data['pk_reservacion']) ){


            $sql = "DELETE from  reservacion  WHERE pk_reservacion=".$data['pk_reservacion'];
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