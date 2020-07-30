<?php

namespace App\Models;

use Session;
use DB;

class Munic_x_Judid
{
    private $juridiccion;
    private $municipios;
    private $id;

    public function getJuridiccion()
    {
        return $this->juridiccion;
    }
    public function setJuridiccion($juridiccion)
    {
        $this->juridiccion = $juridiccion;
        return $this;
    }

    public function getMunicipios()
    {
        return $this->municipios;
    }

    public function setMunicipios($municipios)
    {
        $this->municipios = $municipios;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function save(){
        $sql = "call DA_spSIVADB_ABC_municipio_x_jurisdiccion('1','".$this->getMunicipios()."','".$this->getJuridiccion()."','".Session::get('identity')->id."','0')";
        $result = DB::select($sql,array(1,100));
        return $result;

    }
    public function find(){
        $sql = "call DA_spSIVADB_get_Municipios_x_Jurisdiccion('1','".$this->getId()."')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }

}
