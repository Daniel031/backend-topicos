<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <form action="{{route('users.formulario')}}" method="POST">
            @csrf
            @method('POST')
                <input type="text" name="email" id="email" placeholder="correo">
                <input type="text" name="mensaje" id="mensaje" placeholde="mensaje">

        </form>
</body>
</html>