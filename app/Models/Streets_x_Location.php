<?php

namespace App\Models;

use Session;
use DB;


class Streets_x_Location
{
    private $nombre;
    private $localidad;
    private $latitud;
    private $longitud;
    private $id;



    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
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
        $sql = "call DA_spSIVADB_ABC_Calles_x_Localidad('1','".$this->getLocalidad()."','".$this->getNombre()."','".$this->getLatitud()."','".$this->getLongitud()."', '".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,100));
        return $result;

    }

    public function update(){
        $sql = "call DA_spSIVADB_ABC_Calles_x_Localidad('2','".$this->getLocalidad()."','".$this->getNombre()."','".$this->getLatitud()."','".$this->getLongitud()."','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function delete(){
        $sql = "call DA_spSIVADB_ABC_Calles_x_Localidad('3','0','null','null','null','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function find(){
        $sql = "call DA_spSIVADB_get_Calles_x_Localidad('1','".$this->getLocalidad()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function find_by_id(){
        $sql = "call DA_spSIVADB_get_Calles_x_Localidad('2','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

}
