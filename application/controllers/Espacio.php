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

$respuesta=array("Error"=>"FALSE", "DATA_CURRENT"=>$ArregloCompleto);


$this->response($respuesta);

  }  
//Este sservicio trae los detalles de un espacio 
//Es decir trae la info del espacio, sus imagenes  y los paquetes
// Aun necesita traer las fechas disponibles
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


//Este servicio realiza la consulta de espacios por filtros
//Puede recibir la ciudad o el presupuesto o el limite de personas tambien la cateogria del espacio
//PD este servicio aun necesita crecer mas debido que necesita el filtro de fechas 
public function getEspaciosFiltros_post(){

    $data= $this->post();
    $parametros= new stdClass();
$busqueda="";
    if(isset($data['ciudad'])&&$data['ciudad']!=null){
        $busqueda=  $parametros->ciudad= " municipio = '".$data['ciudad']."'"; 
        
       }
    else{
        $parametros->ciudad=null;
    }

    if(isset($data['presupuesto'])&&$data['presupuesto']!=null){
        if(strlen ( $busqueda )!=0){

$busqueda= $busqueda. $parametros->precio= " AND precio_minimo <= ".$data['presupuesto'].' '; 
        }else{
            $busqueda= $busqueda. $parametros->precio= " precio_minimo <= ".$data['presupuesto'].' '; 

        }
       }else{
        $parametros->precio= null;
    }

    if(isset($data['limite'])&& $data['limite']!=null){
        
        if(strlen ( $busqueda )!=0){
            $busqueda= $busqueda. $parametros->limite=" AND limite <= ".$data['limite'].' '; 
            
        }else{

            $busqueda= $busqueda. $parametros->limite=" limite <= ".$data['limite'].' '; 
        }
       }else{
        $parametros->limite= null;
    }

    if(isset($data['categoria'])&& $data['categoria']!=null){
        
        if(strlen ( $busqueda )!=0){
            $busqueda= $busqueda.  $parametros->categoria=" AND  categoria = '".$data['categoria']."' ";
        }else{
            $busqueda= $busqueda.  $parametros->categoria=" categoria = '".$data['categoria']."' ";

        }
       }else{
        $parametros->categoria= null;
    }



$sql= "SELECT * FROM Espacio WHERE ".$busqueda;

$query= $this->db->query($sql);




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

$respuesta= array("ERROR"=>FALSE, "DATA_CURRENT"=>$ArregloCompleto);

$this->response($respuesta);
}


//En este servicio se borra un espacio 
//Recibe la clave del espacio
public function BorrarEspacio_post(){

    $data = $this->post();

    if (isset($data['pk_espacio']) ){


        $sql = "DELETE from  espacio  WHERE pk_espacio=".$data['pk_espacio'];
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