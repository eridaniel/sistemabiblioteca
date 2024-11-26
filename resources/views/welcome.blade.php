@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BIBLIOTECA</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        
    </head>


    <body class="contenido">
        <div class="max-w-7xl mx-auto p-6 lg:p-8" style="text-align: right;">
            <h1 class= "mt-6 text-xl font-semibold text-gray-900 dark:text-dark text-center">Biblioteca Municipal Profra. "María Ballesteros"</h1>
                <div class="overflow-x-auto">  
                <img src="http://localhost/sistema-biblioteca/resources/views/ImagenBiblioteca.jpg" style="width: 87%; margin: 20px auto 20px 40px; padding-right: 30px; height:70%;">
                </div>                    
        </div>
    </body>
</html>
@endsection