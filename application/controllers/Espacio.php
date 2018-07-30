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
        $query= $this->db->query('SELECT * FROM `imagen` WHERE fk_espacio = '.$llave.' limit 1' );
        $Imagenes= $query->result_array();
        $obj= new stdClass();
        $obj->Espacio= $espacio;
        $obj->Imagenes= $Imagenes;

array_push($ArregloCompleto,$obj);

    }

$respuesta=array("Error"=>"FALSE", "Espacios"=>$ArregloCompleto);


$this->response($respuesta);

  }  

public function getDetalleEspacio_get($pk_Espacio){
//Se selecciona espacio por llave
    $query= $this->db->query('SELECT * FROM `Espacio` WHERE pk_espacio='. $pk_Espacio);

 $Espacios= $query->result_array();


    $array_final=array();
    $obj= new stdClass();
    foreach($Espacios as $espacio){

        //Se guarda el espacio en el objeto 

        $obj->Espacio= $espacio;

        $llave=$espacio['pk_espacio'];
        //SE obtienen las imagenes del espacio seleccionado y se guarda en el objeto
        $query= $this->db->query('SELECT * FROM `imagen` WHERE fk_espacio = '.$llave);
        $Imagenes= $query->result_array();
        $obj->Imagenes= $Imagenes;
        
        //Se obtienen los paquetes del espacio Seleecionado y se guarda en el objeto
        $query2= $this->db->query('SELECT * FROM `paquete` WHERE fk_espacio = '.$llave);
        $Paquetes= $query2->result_array();
        $obj->Paquetes= $Paquetes;
    
  

    }

    //Se guarda el objeto en el array para retornarlo
    array_push($array_final, $obj);

    //Se retorna el array final con  los elementos añadidos (espacio, imagenes y paquetes)
    $respuesta= array("ERROR"=>FALSE, "DATA_CURRENT"=>$array_final);
$this->response($respuesta);

}

    
}