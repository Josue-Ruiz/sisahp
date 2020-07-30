<?php

namespace App\Models;

use Session;
use DB;

class VibrioCholerae
{

    private $jurisdiccion;
    private $localidad;
    private $tipo;
    private $fecha;
    private $domicilio;
    private $resultado;
    private $id;


    private function getJurisdiccion()
    {
        return $this->jurisdiccion;
    }

    public function setJurisdiccion($jurisdiccion)
    {
        $this->jurisdiccion = $jurisdiccion;
    }

    private function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    private function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    private function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    private function getDomicilio()
    {
        return $this->domicilio;
    }

    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

    private function getResultado()
    {
        return $this->resultado;
    }

    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    private function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function all()
    {
        $sql = "call DA_spSIVADB_get_Muestreo_VibrioCholerae('1','1997-06-20','1997-06-20','".$this->getJurisdiccion()."')";
        $result = DB::select($sql,array(1,100));
        return $result;

    }
    public function save()
    {
        $sql = "call DA_spSIVADB_ABC_Muestreo_VibrioCholerae('1','".$this->getJurisdiccion()."','".$this->getLocalidad()."','".$this->getTipo()."','".$this->getFecha()."','".$this->getDomicilio()."',0,'".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function update()
    {
        $sql = "call DA_spSIVADB_ABC_Muestreo_VibrioCholerae('2','0','0','null','1997-06-21','null',".$this->getResultado().",'".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

    public function delete()
    {
        $sql = "call DA_spSIVADB_ABC_Muestreo_VibrioCholerae('3','0','0','null','1997-06-21','null',0,'".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,1));
        return $result;
    }

}
