
@extends('errors.layout')

@section('title') Error 403 @endsection
@section('head') @endsection

@section('content')

<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('images/master/error.png') }}" alt="sing up image" ></figure>
                
            </div>

            <div class="signin-form message-error">
                <h1 class="code-title-error">403</h1>
                <h4 class="code-desciption-error">Prohibida.</h4>

                <div class="form-group form-button">
                    <a href="javascript:history.back();">  <button class="form-submit-error">Regresar</button> </a> 
                </div>
            </div>
   
        </div>
    </div>
</section>

@endsection