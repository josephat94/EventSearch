<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Espacio extends REST_Controller {


    public function __construct() { 
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Origin: *");
        parent:: __construct();
        $this->load->database();
    }




 
    
    
//Este metodo retorna una pagina de espacios en conteo de 10 en 10 recibe el numero de la pagina que necesitas
  public function getEspacios_get($index=0){
    
$pagina= $index*10;
    $diez=10;


    $query= $this->db->query('SELECT * FROM `Espacio` limit '.$pagina.','.$diez);


    $Espacios= $query->result_array();
$ArregloCompleto= array();

    foreach ($Espacios as $espacio) {

     $llave=$espacio['pk_espacio'];
        $query= $this->db->query('SELECT * FROM `imagen` WHERE fk_espacio = '.$llave);
        $Imagenes= $query->result_array();
        $obj= new stdClass();
        $obj->Espacio= $espacio;
        $obj->Imagenes= $Imagenes;

array_push($ArregloCompleto,$obj);

    }

$respuesta=array("Error"=>"FALSE", "Espacios"=>$ArregloCompleto);


$this->response($respuesta);

  }  




    
}