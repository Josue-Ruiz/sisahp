<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurisdictions;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        if(Session::get('identity')->rol == 'Visor'){

            $jurid = new Jurisdictions();
            $result = $jurid->all();

            return view('components.home.index',['registers'=>$result]);
        }else{
            return view('layouts.master');
        }

    }



}
