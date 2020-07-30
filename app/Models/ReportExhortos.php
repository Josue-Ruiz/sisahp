<?php

namespace App\Models;

use Session;
use DB;

class ReportExhortos
{

    private $mes;
    private $anio;
    private $jurisdiccion;


    private function getMes()
    {
        return $this->mes;
    }
    public function setMes($mes)
    {
        $this->mes = $mes;
    }
    private function getAnio()
    {
        return $this->anio;
    }
    public function setAnio($anio)
    {
        $this->anio = $anio;
    }
    private function getJurisdiccion()
    {
        return $this->jurisdiccion;
    }
    public function setJurisdiccion($jurisdiccion)
    {
        $this->jurisdiccion = $jurisdiccion;
    }


    public function find_jurisdictions()
    {
        $sql = "call DA_spSIVADB_get_Jurisdicciones('1','0')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }


    public function generate_report()
    {
        $sql = "call DA_spSIVADB_G_Rep_Exhortos('1','".$this->getJurisdiccion()."','".$this->getMes()."','".$this->getAnio()."')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }

    public function get_info()
    {
        $sql = "call DA_spSIVADB_G_Rep_Muest_Bactereologica('2','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }
}
