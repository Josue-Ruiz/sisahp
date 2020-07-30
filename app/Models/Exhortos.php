<?php

namespace App\Models;

use Session;
use DB;

class Exhortos
{
    private $n_oficio;
    private $municipio;
    private $edas;
    private $costo_edas;
    private $fecha;
    private $id;

    private function getNOficio()
    {
        return $this->n_oficio;
    }

    public function setNOficio($n_oficio)
    {
        $this->n_oficio = $n_oficio;
    }


    private function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    private function getEdas()
    {
        return $this->edas;
    }

    public function setEdas($edas)
    {
        $this->edas = $edas;
    }

    private function getCostoEdas()
    {
        return $this->costo_edas;
    }

    public function setCostoEdas($costo_edas)
    {
        $this->costo_edas = $costo_edas;
    }

    private function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    private function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }


    public function all()
    {
        $sql = "call DA_spSIVADB_get_Exhortos('1','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
    public function save()
    {
        $sql = "call DA_spSIVADB_ABC_Exhortos('1','".$this->getNOficio()."','".$this->getMunicipio()."','".$this->getEdas()."','".$this->getCostoEdas()."','".$this->getFecha()."','".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function update()
    {

    }

    public function delete()
    {
        $sql = "call DA_spSIVADB_ABC_Exhortos('3','0','0','0','0','1997-06-20','".Session::get('identity')->id."','".$this->getId()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

}
