<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VibrioCholeraeFormRequest;
use App\Models\Munic_x_Judid;
use App\Models\Locations;
use App\Models\VibrioCholerae;
use Session;

class VibrioCholeraeController extends Controller

{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {
        $municipalitie = 0;
        $result_l = array();
        $municipalities = new Munic_x_Judid();
        $municipalities->setId(Session::get('identity')->jurisdiccion);
        $result = $municipalities->find();
        if($request->input('municipio'))
        {
            $municipalitie = $request->input('municipio');
            $locations = new Locations();
            $locations->setId($municipalitie);
            $result_l = $locations->find_month();
        }
        return view('components.vibrio_cholerae.index',['municipio'=>$municipalitie,'municipalities'=>$result,'locations'=>$result_l]);
    }

    public function create()
    {
        $vibrio = new VibrioCholerae();
        $vibrio->setJurisdiccion(Session::get('identity')->jurisdiccion);
        $result = $vibrio->all();
        return view('components.vibrio_cholerae.results',['registers'=>$result]);
    }

    public function store(VibrioCholeraeFormRequest $request)
    {
        if($request->ajax())
        {
            $fecha =  $request->get('fecha');
            $format =  date('Y-m-d H:i:s', strtotime($fecha));

            $vibrio = new VibrioCholerae();
            $vibrio->setJurisdiccion(Session::get('identity')->jurisdiccion);
            $vibrio->setLocalidad($request->get('localidad'));
            $vibrio->setDomicilio($request->get('domicilio'));
            $vibrio->setFecha($format);
            $vibrio->setTipo('ESPECIAL');
            $result = $vibrio->save();

            return $result;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if($request->ajax())
        {
            $vibrio = new VibrioCholerae();
            $vibrio->setResultado($request->get('resultado'));
            $vibrio->setId($id);
            $result = $vibrio->update();

            return $result;
        }
    }

    public function destroy($id)
    {
        //
    }
}
