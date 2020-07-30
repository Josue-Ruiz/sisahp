<?php

namespace App\Helpers;
use Storage;
use DB;
use Session;
use Illuminate\Http\Response;

class Content{

    public static function get_municipalities($id)
    {
        $sql = "call DA_spSIVADB_get_Municipios_x_Jurisdiccion('1','".$id."')";
        $result = DB::select($sql,array(0,100));
        return $result;
    }

    public static function get_image_profile()
    {
        $img = Storage::disk('users')->get('2.png');
        return new Response($img,200);
    }

    public static function verify_route($path)
    {
        $result = false;
        $module = '';
        $full_path =  explode('/',$path);

        $module = $full_path[0] == 'reporte' ? $full_path[0].'/'.$full_path[1] : $full_path[0];

        $result = in_array($module,  Session::get('modules')) ? true : false;


        return $result;
    }
}
