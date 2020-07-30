<?php

namespace App\Models;


use DB;

class Entities 
{
    public function all(){
        $sql = "call DA_spSIVADB_get_Entidades('1','0')";
        $result = DB::select($sql,array(0,1));
        return $result; 
    }
}
