<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingDataFormRequets;
use App\Http\Requests\SettingResetPasswordFormRequets;
use App\Models\Settings;
use Session;
use Storage;
use Image;
use File;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication');
    }

    public function profile(){
        return view('components.settings.profile');
    }

    public function update_datas(SettingDataFormRequets $request){

        $setting = new Settings();
        $setting->setNombre($request->input('nombre'));
        $setting->setApellido_p($request->input('apellido_p'));
        $setting->setApellido_m($request->input('apellido_m'));
        $setting->setCorreo($request->input('correo'));
        $setting->setUsuario($request->input('usuario'));
        $setting->setId(Session::get('identity')->id);

        $result = $setting->update_datas();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['usuario'=>'Nombre de Usuario en uso. Elige otro.'])->withInput();
                        break;
                    case -2:   return back()->withErrors(['correo'=>'Correo Electronico en uso. Elige otro.'])->withInput();
                        break;
                }
            }else{
                Session::put('identity',$result[0]);
                return back()->with('success','Información actualizada exitosamente.');
            }
        }

    }

    public function reset_password(){
        return view('components.settings.reset_password');
    }

    public function update_password(SettingResetPasswordFormRequets $request){
        $setting = new Settings();
        $setting->setContra_actual($request->input('actual'));
        $setting->setContrasenia($request->input('contrasenia'));
        $setting->setId(Session::get('identity')->id);

        $result = $setting->update_password();

        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['error'=>'Tu Contrasena actual no coincide.'])->withInput();
                        break;
                    case 1:    return back()->with('success','Contraseña actualizada exitosamente.');
                        break;

                }
            }
        }

    }

    public function photo_profile(Request $request){

        if($request->input('foto') !=null){
                echo var_dump($request->file('foto')); die();
        }

        return view('components.settings.photo_profile');

    }

    public function update_photo(Request $request){

        $request->validate(['foto'=>['required','image','mimes:png,jpeg,jpg']]);

        $file = $request->file('foto');

        $result = Image::make($file)->resize(64,64)->stream();

        $file_name = trim(Session::get('identity')->nombre.'_'.time().'_'.$file->getClientOriginalName());
        Storage::disk('users')->put($file_name,$result->__toString());

        $setting = new Settings();
        $setting->setImagen($file_name);
        $setting->setId(Session::get('identity')->id);

        $result = $setting->update_profile();


        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['error','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case 1:    Session::get('identity')->imagen= $file_name;
                               return back()->with('success','Foto de perfil actualizada exitosamente.');
                        break;
                }
            }
        }

    }




}
