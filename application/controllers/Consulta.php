<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Consulta extends REST_Controller {


    public function __construct() { 
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Origin: *");
        parent:: __construct();
        $this->load->database();
    }
 
    

    
public function AgregarConsulta_post(){
$data= $this->post();

if (isset($data['fk_espacio']) && isset($data['fk_usuario']) 
) {

    $sql = "INSERT INTO Consulta (fk_espacio,fk_usuario, fecha ) VALUES (".$data['fk_espacio'] .",".$data['fk_usuario'] .",now())";

    $this->db->query($sql);


    $respuesta = array(
        "ERROR" => FALSE,
    
        "DATA_CURRENT" => $this->db->affected_rows());

}else{


    $respuesta= array("ERROR"=>TRUE, "ERROR en los datos ingresados");
}


$this->response($respuesta);

}






}