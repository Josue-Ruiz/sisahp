<?php

namespace App\Models;

use Session;
use DB;


class Locations
{
    private $municipio;
    private $clave;
    private $nombre;
    private $pob_total;
    private $latitud;
    private $longitud;
    private $id;

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function getPob_total()
    {
        return $this->pob_total;
    }

    public function setPob_total($pob_total)
    {
        $this->pob_total = $pob_total;
    }
    public function getLatitud()
    {
        return $this->latitud;
    }
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }
    public function getLongitud()
    {
        return $this->longitud;
    }
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function save(){
        $sql = "call DA_spSIVADB_ABC_Localidades('1','".$this->getMunicipio()."','".$this->getClave()."','".$this->getNombre()."', '".$this->getPob_total()."' ,'".$this->getLatitud()."', '".$this->getLongitud()."' ,'".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function update(){
        $sql = "call DA_spSIVADB_ABC_Localidades('2','".$this->getMunicipio()."','".$this->getClave()."','".$this->getNombre()."', '".$this->getPob_total()."' ,'".$this->getLatitud()."', '".$this->getLongitud()."' ,'".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
    public function delete(){
        $sql = "call DA_spSIVADB_ABC_Localidades('3','0','null','null', '0' ,'0', '0' ,'".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
    public function find(){
        $sql = "call DA_spSIVADB_get_Localidades('1','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
    public function find_by_id(){
        $sql = "call DA_spSIVADB_get_Localidades('3','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function find_month()
    {
        $sql = "call DA_spSIVADB_get_Localidades('4','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }


}
