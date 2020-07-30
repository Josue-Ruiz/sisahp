<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\AutenticacionFormRequest;
use App\Models\Autentication;
use App\Events\SendMailUser;
use Session;

class AutenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('authentication')->only('logout');
        $this->middleware('verify_session')->except('logout');
    }


    public function index(){

        return view('components.autentication.acceso');

    }

    public function auth(AutenticacionFormRequest $request){

        $auth = new Autentication();
        $auth->setUsuario($request->input('usuario'));
        $auth->setPassword($request->input('password'));
        $result = $auth->auth();

        if(!empty($result)){

            if(isset($result[0]->Result)){

                switch($result[0]->Result){
                    case -10: return back()->withErrors(['err'=>'Se presentaron problemas en el servidor, intentalo mas tarde.']);
                        break;
                    case -1:  return back()->withErrors(['err'=>'Las credenciales no coinciden con ningún registro.'])->withInput();
                        break;
                }
            }else{
                Session::put('identity',$result[0]);
                $auth->setRol($result[0]->rol);
                $this->verify_modules($auth->get_modules());
                return redirect()->route('home');
            }
        }else{
            return back()->withErrors(['err'=>'Se presentaron problemas en el servidor, intentalo mas tarde.']);
        }
    }

    public function recover_acount(){
        return view('components.autentication.recuperar');
    }

    public function verify_email(Request $request){

        $this->validate($request,['correo'   => ['required','email','max:100']]);
        $token = Str::random(100);

        $auth = new Autentication();
        $auth->setCorreo($request->input('correo'));
        $auth->setToken($token);
        $result = $auth->verify_email();


        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['err','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['err'=>'El correo introducido no coincide con ningún registro.'])->withInput();
                }
            }else{
                $datos = array('nombre'=>$result[0]->nombre,'token'=>$result[0]->token,'correo'=>$result[0]->correo);
                event(new SendMailUser($datos));
                return back()->with('success','Hemos enviado un link a tu correo electronico con el cual podras restablecer tu contraseña');
            }
        }

    }

    public function recover_password(Request $request, $token){
        return view('components.autentication.cambiar_contrasenia',['token'=>$token]);
    }

    public function update_password(Request $request){

        $this->validate($request,['password' => ['required','string','max:255','confirmed','min:6'],'password_confirmation' => ['required','string','max:255'],]);

        $auth = new Autentication();
        $auth->setPassword($request->input('password'));
        $auth->setToken($request->input('token'));
        $result = $auth->update_password();


        if (!empty($result)) {

            if(isset($result[0]->Result)){
                switch($result[0]->Result){
                    case -10:  return back()->withErrors(['err','Se presentaron problemas en el servidor, intentalo mas tarde.']);
                      break;
                    case -1:   return back()->withErrors(['err'=>'El token de seguridad no es valido o ha expirado.'])->withInput();
                        break;
                }
            }else{
                Session::put('identity',$result[0]);
                $auth->setRol($result[0]->rol);
                $this->verify_modules($auth->get_modules());
                return redirect()->route('home');
            }
        }
    }

    protected function verify_modules($modules)
    {
        $items = array();
        foreach ($modules as  $item) {
            array_push($items,$item->nombre);
        }
        Session::put('modules',$items);

    }

    public function logout(Request $request){
        Session::forget('identity');
        return redirect()->route('home');
    }
}
