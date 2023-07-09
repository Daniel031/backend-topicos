<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    <style> 
		body {
			background-color:white;
			color: black;
		}
		.header {
			height: 5rem;
			background-color: green;
			box-shadow: 0px 0px 10px 5px #888888;
			padding: 2rem 2rem 0rem 0rem;
		}
		.enlace {
			font-weight: bold;
			color: white;
			display: flex;
			justify-content: flex-end;
		}
		.enlace a {
			margin-left: 2rem;
			color:white;
			font-size:1.4rem;
			text-decoration: none;
		}
		.main {
			display: flex;
			justify-content: center;
			height: 30rem;
			align-items: center;
		}
		img {
		}
		.container {
			display: flex;
			flex-direction: column;
		}
		.title {
			display:flex;
			margin-top: 1rem;
		    font-size: 25px;
		    font-weight: bold;	
		}
		.footer {
			background-color: green;
			display: flex;
			justify-content: center;
            align-content: flex-end;
			padding: 1rem 0rem 1rem 0rem;
			font-size: 20px;
			font-weight: bold;
			color: white;
		}
		body{
			/* background-image:url('/m') */
		}
    </style>
</head>
<body> 
    <div class="header">
		<div class="enlace">
			<a href="{{ route('login') }}">Iniciar Sesi&oacute;n</a>
			<a href="{{route('publico')}}" >Ver Mapa</a> 
            
		</div>
    </div>
    <div class="main">
		<div class="container">
			<img src="/img/LogoSantaCruz.png" alt="logo santa cruz" />
			<div class="title">
				Atencion publica de denuncias
			</div>
		</div>
    </div>
    <div class="footer">
		Gobernacion de Santa Cruz
    </div>
</body>
</html>
