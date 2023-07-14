@extends('adminlte::page')

@section('title', 'Usuarios Mostrar')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

<section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{route('buzon.index')}}">Mis Denuncias</a></li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{$admin->name}}</h5>
              <p class="text-muted mb-1">ADMINISTRADOR</p>
              <p class="text-muted mb-4">
                   
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Nombre</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$admin->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$admin->email}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Area</p>
                </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                        @foreach($areas as $area)
                            @if($area->id == $admin->area_id)
                                {{$area->nombre}}
                            
                            @endif
                        @endforeach
                    </p>
                  </div> 
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>
@stop

@section('css')

<style>
    .title {
        font-weight: bold
    }
    .acciones {
        margin-top: 10px
    }
</style>

@stop


@section('js')


@stop