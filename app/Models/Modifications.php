<?php

namespace App\Models;

use Session;
use DB;

class Modifications
{
    private $fec_inicio;
    private $fec_final;
    private $localidad;

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
    private function getLocalidad()
    {
        return $this->localidad;
    }
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    public function get_residual_chlorine()
    {
        $sql = "call DA_spSIVADB_get_Modificaciones('1','".$this->getLocalidad()."','".$this->getFec_inicio()."','".$this->getFec_final()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function get_vibrio_sampling()
    {
        $sql = "call DA_spSIVADB_get_Modificaciones('2','".$this->getLocalidad()."','".$this->getFec_inicio()."','".$this->getFec_final()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }

    public function get_exhortos()
    {
        $sql = "call DA_spSIVADB_get_Modificaciones('3','".$this->getLocalidad()."','".$this->getFec_inicio()."','".$this->getFec_final()."')";
        $result = DB::select($sql,array(1,100));
        return $result;
    }
}
