@extends('admin.app-layout')
@section('title')
    Generar Activación
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 mx-2">Admin Generar Corte</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active " aria-current="page">Generar Corte</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <p>Este método puede durar hasta 10 minutos, por favor aguarde con paciencia mientras el sistema se encarga de realizar los cortes a los impagos.</p>
                    
                    </div>



                    <div class="col">
                        <form id="submitCortes" method="POST" action="{{route('generar-cortes-post')}}">
                            @csrf

                            <input type="submit" value="Generar Cortes" class="btn btn-danger px-5 radius-30"></input>
                        </form>
                        
                        <div class="p-4" id="spinner-result">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection