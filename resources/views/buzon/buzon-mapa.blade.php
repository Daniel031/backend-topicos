@extends('adminlte::page')

@section('title', 'Mapa de denuncias')

@section('content_header')
    <h1>Mapa de denuncias</h1>
@stop

@section('content')




  <form action="">
      @csrf

      {{-- titulo inicio--}}
      <div class="container">
          <div class="row">
            <div class="col-sm">
              
            </div>
            <div class="col-sm">
              
            </div>
          </div>
      </div>
      {{-- titulo fin--}}  


      {{-- primer fila inicio--}}
      <div class="container">
          <div class="row">
            <div class="col-sm">
              {{-- dropdown #1 inicio --}}
              <li class="list-group-item">
                  <!--aqui empieza el codigo del select-->
                  <div>
                      {{-- <i class="fa-solid fa-calendar-days fa-2xl"></i> --}}
                      <label for="fecha" class="col-form-label ">Seleccione una fecha</label>
                          <div>
                              <select class="form-control" id="fecha" name="fecha" onchange="onChangeSelect()" style="background: rgb(196, 196, 196)">
                                  <option value="1">hoy</option>
                                  <option value="2">esta semana</option>
                                  <option value="3">este mes</option>
                              </select>
                          </div>
                  </div>
                  <!--aqui termina el codigo del select-->
              </li>
              {{-- dropdown #1 final --}}
            </div>
            <div class="col-sm">
              <li class="list-group-item">
                  <!--aqui empieza el codigo del select-->
                  <div>
                      <label for="rango_fecha" class="col-form-label ">Seleccione un estado</label>
                      <div>
                          <select class="form-control" id="estado" name="estado" onchange="onChangeSelect()", style="background: rgb(196, 196, 196)">
                              <option value="1">aceptadas</option>
                              <option value="2">rechazadas</option>
                              <option value="3">pendientes</option>
                          </select>
                      </div>
                  </div>
                  <!--aqui termina el codigo del select-->
              </li>
            </div>
            <div class="col-sm">
              {{-- One of three columns --}}
            </div>
          </div>
      </div>

  </form>


  <div id="map">

  </div>



@stop

@section('css')

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <link rel="stylesheet" href="css/style.css"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<script src="https://kit.fontawesome.com/3660a3dc6d.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>


<style>
  #map { height: 600px;
        width:80%;
        margin:20px auto;
  }
</style>
<title>Document</title>

@stop

@section('js')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>

{{-- -17.782274492638184, -63.180231223785405 --}}
<script>
       function getApiUrl() {
        const url =`{{url('/')}}`;
        return url;
       }
        var map = L.map('map').setView([-17.782274492638184, -63.180231223785405], 12);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 20,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        // var marker = L.marker([-17.782274492638184, -63.180231223785405]).addTo(map);

        function denunciasFiltradas() {

        fetch(`${getApiUrl()}/api/denuncias-filtradas`)
        .then(response =>response.json().then( value=>{
          let denuncias = value.datos;
          //console.log(denuncias);
          denuncias.forEach(element => {
            dato = element['tipo_denuncia'];

            if(dato == '1'){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'blue',
                      fillColor: 'blue',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);

            }
            if(dato == '2'){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'red',
                      fillColor: 'red',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);

            }
            if(dato =='3'){

              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'green',
                      fillColor: 'green',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);
            }

            if(dato =='4'){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'black',
                      fillColor: 'black',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);

            }
            if(dato =="5"){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'purple',
                      fillColor: 'purple',
                      fillOpacity: 0.7,
                      radius: 50
                  }).addTo(map);

            }
          });
        })).catch((error)=>{

            console.log(error+"Salimos por catch");

        });
        }

        setInterval(function() {
          denunciasFiltradas();
        }, 1000);
</script>

<script src="/js/index.js"></script>

@stop