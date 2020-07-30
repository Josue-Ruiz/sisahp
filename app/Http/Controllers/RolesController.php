<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RolesFormRequest;
use App\Models\Roles;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        $roles = new Roles();
        $result = $roles->all();

        return view('components.roles.index',['registers'=>$result]);
    }


    public function create()
    {
        return view('components.roles.create');
    }


    public function store(RolesFormRequest $request)
    {
        $roles = new Roles();
        $roles->setNombre($request->input('nombre'));
        $result = $roles->save();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de rol en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('roles.index')->with('success','Rol agregado exitosamente.');
                        break;
                }
            }
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $roles = new Roles();
        $roles->setId($id);
        $result = $roles->find();

        return view('components.roles.edit',['item'=>$result[0]]);
    }


    public function update(RolesFormRequest $request, $id)
    {
        $roles = new Roles();
        $roles->setNombre($request->input('nombre'));
        $roles->setId($id);
        $result = $roles->update();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                    break;
                    case -1:   return back()->withErrors(['nombre'=>'Nombre de rol en uso. Elige otro.'])->withInput();
                        break;
                    case 1:    return redirect()->route('roles.index')->with('success','Rol actualizado exitosamente.');
                        break;
                }
            }
        }
    }


    public function destroy($id)
    {
        $rol = new Roles();
        $rol->setId($id);

        $result = $rol->delete();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case 1:    return redirect()->route('roles.index')->with('success','Rol eliminado exitosamente.');
                        break;
                }
            }
        }
    }
}
