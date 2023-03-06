@extends('app')
@section('title')
    System Court
@endsection
@section('content')

    <div id="hero">

        <div class="promo">
            <h1>Este sitio es de uso solo para personal autorizado.</h1>
            <p>puedes visitar nuestra red publica en <span>www.fiberar.tech</a></span></p>


            <a class="button-32" href="{{route('login')}}">Iniciar Sesión</a> 

        </div>

        <video autoplay loop muted>
            <source src="{{asset('frontend/assets/background.mp4')}}" type="video/mp4">
        </video>
        <div class="capa"></div>
    </div>

@endsection