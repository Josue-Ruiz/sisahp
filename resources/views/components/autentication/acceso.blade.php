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
                <h2 class="form-title">Iniciar sesión</h2>
                <form method="POST" action="{{ route('auth') }}">

                    @csrf
                    <div class="form-group">
                        <label for="usuario"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}"  autofocus  autocomplete="off" placeholder="Correo Electronico o Usuario">

                        @error('usuario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   placeholder="Contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="label-agree-term"><span><span></span></span>Mantener la sesión iniciada</label>
                    </div>
                    @error('err')
                        <strong class="msg-error">{{ $message }}</strong>
                    @enderror
                   
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Iniciar sesión"/>
                    </div>
                </form>
               
                <div class="social-login">
                
                <a href="{{ route('recover_acount') }}" class="signup-image-link">¿Has Olvidado tu contraseña?</a>
                
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
