<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . '/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


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
}