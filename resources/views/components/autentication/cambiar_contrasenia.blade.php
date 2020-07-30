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
                <h2 class="form-title">Restablecer Contraseña</h2>
                <form method="POST" action="{{ route('update_password') }}">

                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  placeholder="Nueva Contraseña">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"><i class="zmdi zmdi-lock"></i></label>
                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}"  placeholder="Confirmar Contraseña">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                        
                    @error('err')
                        <strong>{{ $message }}</strong>
                    @enderror

                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Restablecer"/>
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
