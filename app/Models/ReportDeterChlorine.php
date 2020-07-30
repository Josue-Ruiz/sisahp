<?php

namespace App\Models;

use Session;
use DB;

class ReportDeterChlorine
{

    private $fec_inicio;
    private $fec_final;
    private $fecales;
    private $totales;
    private $usuario;
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
    public function getFecales()
    {
        return $this->fecales;
    }
    public function setFecales($fecales)
    {
        $this->fecales = $fecales;
    }
    public function getTotales()
    {
        return $this->totales;
    }
    public function setTotales($totales)
    {
        $this->totales = $totales;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }


    public function get_info()
    {
        $sql = "call DA_spSIVADB_G_Rep_Deter_Cloro('2','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }

    public function generate_report()
    {
        $sql = "call DA_spSIVADB_G_Rep_Deter_Cloro('1','".$this->getFec_inicio()."','".$this->getFec_final()."','0')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }

    public function find_analysis()
    {
        $sql = "call DA_spSIVADB_get_Analis_Muest_Bactereologicas('1','0')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }
    public function update_analysis()
    {
        $sql = "call DA_spSIVADB_ABC_Analis_Muest_Bacteologicas('2','0',".$this->getFecales().",".$this->getTotales().",'".$this->getUsuario()."','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }
}
