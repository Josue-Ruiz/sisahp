<?php

namespace App\Models;

use Session;
use DB;

class ReportVibrioSampling
{
    private $fec_inicio;
    private $fec_final;
    private $id;

    public function getFec_inicio()
    {
        return $this->fec_inicio;
    }

    public function setFec_inicio($fec_inicio)
    {
        $this->fec_inicio = $fec_inicio;
    }
    public function getFec_final()
    {
        return $this->fec_final;
    }
    public function setFec_final($fec_final)
    {
        $this->fec_final = $fec_final;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function generate_report()
    {
        $sql = "call DA_spSIVADB_G_Rep_Muestreo_VibrioCholerae('1','".$this->getFec_inicio()."','".$this->getFec_final()."','".Session::get('identity')->jurisdiccion."')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }
}
