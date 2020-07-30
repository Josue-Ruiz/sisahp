<?php

namespace App\Models;

use Session;
use DB;

class ReportEpidWeek
{

    private $id;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function find_weeks()
    {
        $sql = "call DA_spSIVADB_get_Calendario('2','0')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }

    public function generate_report()
    {
        $sql = "call DA_spSIVADB_G_Rep_Semana_Epidemiologica('1','".$this->getId()."')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }

    public function get_info()
    {
        $sql = "call DA_spSIVADB_G_Rep_Semana_Epidemiologica('2','".$this->getId()."')";
        $result = DB::select($sql,array(0,1));
        return $result;
    }
}
