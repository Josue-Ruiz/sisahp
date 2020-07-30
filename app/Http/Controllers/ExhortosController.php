<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhortosFormRequest;
use App\Models\Exhortos;

class ExhortosController extends Controller
{

    public function index()
    {
        $exhortos = new Exhortos();
        $registers = $exhortos->all();
        return view('components.exhortos.index',\compact('registers'));
    }


    public function create()
    {

    }


    public function store(ExhortosFormRequest $request)
    {
        if($request->ajax()){
            $fecha =  $request->get('fecha');
            $format =  date('Y-m-d H:i:s', strtotime($fecha));

            $exhortos = new Exhortos();
            $exhortos->setNOficio($request->get('n_oficio'));
            $exhortos->setMunicipio($request->get('municipio'));
            $exhortos->setEdas($request->get('edas'));
            $exhortos->setCostoEdas($request->get('costo_edas'));
            $exhortos->setFecha($format);

            $result = $exhortos->save();
            return $result;

        }else{
            \abort(500);
        }




    }

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
        //
    }

    public function destroy($id)
    {
        //
    }
}
