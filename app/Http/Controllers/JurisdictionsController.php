<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JusrisdictionFormRequests;
use App\Models\Jurisdictions;

class JurisdictionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index(Request $request)
    {
        $jurid = new Jurisdictions();
        $result = $jurid->all();
        if($request->ajax())
        {
            return json_encode($result);
        }
        return view('components.jurisdictions.index',['registers'=>$result]);
    }

    public function create()
    {
        return view('components.jurisdictions.create');
    }


    public function store(JusrisdictionFormRequests $request)
    {
        $jurid = new Jurisdictions();
        $jurid->setNombre($request->input('nombre'));
        $result = $jurid->save();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de juridicción en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('jurisdicciones.index')->with('success','Jurisdiccion registrada exitosamente.');
                        break;
                }
            }
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $jurid = new Jurisdictions();
        $jurid->setId($id);
        $result = $jurid->find();

        return view('components.jurisdictions.edit',['item'=>$result[0]]);
    }



    public function update(JusrisdictionFormRequests $request, $id)
    {
        $jurid = new Jurisdictions();
        $jurid->setNombre($request->input('nombre'));
        $jurid->setId($id);
        $result = $jurid->update();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de juridicción en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('jurisdicciones.index')->with('success','Jurisdiccion actualizada exitosamente.');
                        break;
                }
            }
        }
    }

    public function destroy($id)
    {
        $jurid = new Jurisdictions();
        $jurid->setId($id);
        $result = $jurid->delete();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case 1:    return redirect()->route('jurisdicciones.index')->with('success','Jurisdiccion eliminada exitosamente.');
                        break;
                }
            }
        }
    }
}
