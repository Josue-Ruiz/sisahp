@extends('layouts.login')

@section('content')

<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('images/ss_logo.png') }}" alt="sing up image"></figure>
                
            </div>

            <div class="signin-form">
                <h2 class="form-title">Recuperar cuenta</h2>
                <form method="POST" action="{{ route('verify_email') }}">

                    @csrf
                    <div class="form-group">
                        <label for="correo"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input id="correo" type="text" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}"  autocomplete="off" autofocus placeholder="Correo Electronico">
                    </div>
                        @error('err')
                            <span class="invalid-feedback" role="alert">
                                <strong class="msg-error">{{ $message }}</strong>
                            </span>        
                        @enderror
                        @if(Session::has('success'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="msg-success">{{ Session::get('success') }}</strong>
                            </span>        
                        @endif

                        <p>Podemos ayudarte a restablecer tu contraseña y la información de seguridad. Primero escribe tu cuenta de correo Electronico.</p>
                        

                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Siguiente"/>
                    </div>
                </form>
               
                <div class="social-login">
                
                    <a href="{{ route('home') }}" class="signup-image-link">Iniciar sesión</a>
                    
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
