<?php

namespace App\Models;

use Session;
use DB;

class Municipalities
{
    private $clave;
    private $entidad;
    private $nombre;
    private $pob_total;
    private $pob_agua;
    private $presidente;
    private $delegado;
    private $id;


    public function getClave()
    {
        return $this->clave;
    }
    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function getEntidad()
    {
        return $this->entidad;
    }
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPobTotal()
    {
        return $this->pob_total;
    }
    public function setPobTotal($pob_total)
    {
        $this->pob_total = $pob_total;
    }

    public function getPobAgua()
    {
        return $this->pob_agua;
    }
    public function setPobAgua($pob_agua)
    {
        $this->pob_agua = $pob_agua;
    }

    public function getPresidente()
    {
        return $this->presidente;
    }

    public function setPresidente($presidente)
    {
        $this->presidente = $presidente;
    }

    public function getDelegado()
    {
        return $this->delegado;
    }

    public function setDelegado($delegado)
    {
        $this->delegado = $delegado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id; 
    }


    public function all(){
        $sql = "call DA_spSIVADB_get_Municipios('1','0')";
        $result = DB::select($sql,array(0,1));
        return $result; 
    }

    public function save(){
        $sql = "call DA_spSIVADB_ABC_Municipios('1','".$this->getClave()."', '".$this->getPresidente()."','".$this->getDelegado()."','".$this->getNombre()."','".$this->getPobTotal()."','".$this->getPobAgua()."', '".$this->getEntidad()."','".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(0,1));
        return $result; 
    }

    public function find(){
        $sql = "call DA_spSIVADB_get_Municipios('2','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result; 
        
    }
    public function update(){
        $sql = "call DA_spSIVADB_ABC_Municipios('2','".$this->getClave()."', '".$this->getPresidente()."','".$this->getDelegado()."','".$this->getNombre()."','".$this->getPobTotal()."','".$this->getPobAgua()."','".$this->getEntidad()."','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result; 
    }

    public function delete(){
        $sql = "call DA_spSIVADB_ABC_Municipios('3','0','null','null','null','0','0','0','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result; 
    }

}
