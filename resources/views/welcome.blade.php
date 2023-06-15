<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3660a3dc6d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>


    {{-- <ul>
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    </ul>  --}}  


    <form action="">
        @csrf

        {{-- titulo inicio--}}
        <div class="container">
            <div class="row">
              <div class="col-sm">
                
              </div>
              <div class="col-sm">
                <h1 style="margin-bottom:30px"><strong> Mapa de denuncias</strong></h1>
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
                        <label for="rango_fecha" class="col-form-label ">Seleccione una fecha</label>
                            <div>
                                <select class="form-control" id="rango_fecha" name="rango_fecha" onchange="onChangeSelect()" style="background: rgb(196, 196, 196)">
                                    <option value="hoy">hoy</option>
                                    <option value="semana">esta semana</option>
                                    <option value="mes">este mes</option>
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
                            <select class="form-control" id="rango_fecha" name="rango_fecha" onchange="onChangeSelect()", style="background: rgb(196, 196, 196)">
                                <option value="hoy">aceptadas</option>
                                <option value="semana">rechazadas</option>
                                <option value="mes">pendientes</option>
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
        {{-- primer fila fin--}}

        {{--  inicio filtro checklist de tipos de desnuncias  --}}
        <div class="container">
            <div class="row">
              <div class="col">
                {{-- 1 of 3 --}}
              </div>
              <div class="col-6">
                <div class="card" style="background: rgb(58, 216, 166); margin-top: 20px">
                    <div class="card-body">

                        <div class="container">
                            <div class="row">
                              <div class="col">

                                {{-- alcantarillado --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                      Alcantarillado
                                      <i class="fa-sharp fa-solid fa-droplet fa-lg"></i>
                                    </label>
                                </div>

                                {{-- aseo urbano --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                      Aseo urbano
                                    </label>
                                </div>

                                {{-- vias publicas --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Vias publicas
                                    </label>
                                </div>


                              </div>
                              <div class="col">
                                {{-- alumbrado publico --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Alumbrado publico
                                    </label>
                                </div>


                                {{-- areas verdes --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Areas verdes
                                    </label>
                                </div>
                              </div>
                            </div>
                        </div>    
                    </div>
                  </div>
              </div>
              <div class="col">
                {{-- 3 of 3 --}}
              </div>
            </div>
        </div>    
        {{--  fin filtro checklist de tipos de desnuncias  --}}


    </form>


    <div class="map">

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>