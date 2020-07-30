<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UsersFormRequest;
use App\Models\Jurisdictions;
use App\Models\Municipalities;
use App\Models\Roles;
use App\Models\Users;
use Session;
use Storage;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function index()
    {
        $users = new Users();
        $result = $users->all();
        return view('components.users.index',["users"=>$result]);
    }

    public function create()
    {
        $jurisdictions = new Jurisdictions();
        $r_jurisdictions = $jurisdictions->all();

        $roles = new Roles();
        $r_roles = $roles->all();

        return view('components.users.create',['jurisdictions'=>$r_jurisdictions,'roles'=>$r_roles]);
    }

    public function store(UsersFormRequest $request)
    {
        $jurisdiccion = $request->input('jurisdiccion') ? $request->input('jurisdiccion') : 0;
        $municipio = $request->input('municipio') ? $request->input('municipio') : 0;

        $users = new Users();
        $users->setRol($request->input('rol'));
        $users->setJurisdiccion($jurisdiccion);
        $users->setMunicipio($municipio);
        $users->setNombre($request->input('nombre'));
        $users->setApellido_p($request->input('apellido_p'));
        $users->setApellido_m($request->input('apellido_m'));
        $users->setCorreo($request->input('correo'));
        $users->setUsuario($request->input('usuario'));
        $users->setContrasenia($request->input('contrasenia'));
        $result = $users->save();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['usuario'=>'Nombre de Usuario en uso. Elige otro.'])->withInput();
                        break;
                    case -2:   return back()->withErrors(['correo'=>'Correo Electronico en uso. Elige otro'])->withInput();
                        break;
                    case 1:    return redirect()->route('usuarios.index')->with('success','Usuario agregado exitosamente.');
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
        $users =  new Users();
        $users->setId($id);
        $result = $users->find();


        if($result[0]->id_jurisdiccion > 0)
        {
            $jurisdictions = new Jurisdictions();
            $regsiters = $jurisdictions->all();
        }else{
            $munic = new Municipalities();
            $regsiters = $munic->all();
        }


        $roles = new Roles();
        $r_roles = $roles->all();

        return view('components.users.edit',['item'=>$result[0],'registers'=>$regsiters,'roles'=>$r_roles]);

    }


    public function update(UsersFormRequest $request, $id)
    {
        $jurisdiccion = $request->input('jurisdiccion') ? $request->input('jurisdiccion') : 0;
        $municipio = $request->input('municipio') ? $request->input('municipio') : 0;

        $users = new Users();
        $users->setRol($request->input('rol'));
        $users->setJurisdiccion($jurisdiccion);
        $users->setMunicipio($municipio);
        $users->setNombre($request->input('nombre'));
        $users->setApellido_p($request->input('apellido_p'));
        $users->setApellido_m($request->input('apellido_m'));
        $users->setCorreo($request->input('correo'));
        $users->setUsuario($request->input('usuario'));
        $users->setContrasenia($request->input('contrasenia'));
        $users->setId($id);
        $result = $users->update();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['usuario'=>'Nombre de Usuario en uso. Elige otro.'])->withInput();
                        break;
                    case -2:   return back()->withErrors(['correo'=>'Correo Electronico en uso. Elige otro'])->withInput();
                        break;
                    case 1:    return redirect()->route('usuarios.index')->with('success','Usuario actualizado exitosamente.');
                        break;
                }
            }
        }
    }


    public function destroy($id)
    {
        $users =  new Users();
        $users->setId($id);

        $result = $users->delete();

        if(isset($result[0]->Result)){
            switch($result[0]->Result){
                case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                  break;
                case 1:    return redirect()->route('usuarios.index')->with('success','Usuario eliminado exitosamente.');
                    break;
            }
        }
    }


    public static function get_image_profile($name){
        $img = Storage::disk('users')->get($name);
        return new Response($img,200);

    }

}
