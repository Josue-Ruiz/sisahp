<?php

namespace App\Models;

use Session;
use DB;

class ReportJurisdictionWeeKly
{
    private $fec_inicio;
    private $fec_final;
    private $jurisdiccion;


    private function getFec_inicio()
    {
        return $this->fec_inicio;
    }
    public function setFec_inicio($fec_inicio)
    {
        $this->fec_inicio = $fec_inicio;
    }
    private function getFec_final()
    {
        return $this->fec_final;
    }
    public function setFec_final($fec_final)
    {
        $this->fec_final = $fec_final;
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
        $sql = "call DA_spSIVADB_G_Rep_Jurisdiccion('1','".$this->getJurisdiccion()."','".$this->getFec_inicio()."','".$this->getFec_final()."')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }
}
