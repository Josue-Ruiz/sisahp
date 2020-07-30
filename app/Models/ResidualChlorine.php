<?php

namespace App\Models;

use Session;
use DB;

class ResidualChlorine
{
    private $id;
    private $municipio;
    private $localidad;
    private $calle;
    private $fecha;
    private $valor;
    private $sin_servicio;
    private $causas;
    private $acciones;
    private $muestras;


    private function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    private function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    private function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    private function getCalle()
    {
        return $this->calle;
    }

    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    private function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    private function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    private function getSin_servicio()
    {
        return $this->sin_servicio;
    }

    public function setSin_servicio($sin_servicio)
    {
        $this->sin_servicio = $sin_servicio;
    }

    private function getCausas()
    {
        return $this->causas;
    }

    public function setCausas($causas)
    {
        $this->causas = $causas;
    }

    private function getAcciones()
    {
        return $this->acciones;
    }

    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;
    }

    private function getMuestras()
    {
        return $this->muestras;
    }

    public function setMuestras($muestras)
    {
        $this->muestras = $muestras;
    }

    public function all(){
        $sql = "call DA_spSIVADB_get_Notificacion_Clororesidual('1','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function find(){
        $sql = "call DA_spSIVADB_get_Notificacion_Clororesidual('2','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function save(){
        $sql = "call DA_spSIVADB_ABC_Notificacion_Clororesidual('1','".$this->getMunicipio()."','".$this->getLocalidad()."','".$this->getCalle()."','".$this->getFecha()."','".$this->getValor()."',".$this->getSin_servicio().",'".$this->getCausas()."','".$this->getAcciones()."',".$this->getMuestras().",'1','0')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function update(){
        $sql = "call DA_spSIVADB_ABC_Notificacion_Clororesidual('2','".$this->getMunicipio()."','".$this->getLocalidad()."','".$this->getCalle()."','".$this->getFecha()."','".$this->getValor()."',".$this->getSin_servicio().",'".$this->getCausas()."','".$this->getAcciones()."',".$this->getMuestras().",'".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function delete(){
        $sql = "call DA_spSIVADB_ABC_Notificacion_Clororesidual('3','0','0','0','2019-01-01 00:00:00','null',0,'null','null',0,'".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }


}
