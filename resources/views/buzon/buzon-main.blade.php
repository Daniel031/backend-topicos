<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


        <h1>
            AQUI ESTA EL BUZON DE LAS DENUNCIAS ES UN VECTOR DE DENUNCIAS
        </h1>
        @for($i=0;$i<count($datos);$i++)

                {{$datos[$i]}}
                {{gettype($datos[$i])}}
                
                <br>
                <br>
     
               
                

        @endfor
</body>
</html>