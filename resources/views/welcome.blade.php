<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-gray-200">
        <nav class="flex justify-end px-5 py-3">
            <a href="{{route('register')}}" class="text-md text-blue-500 mr-4 hover:text-blue-700">
                Registrarse
            </a>
            <a href="{{route('login')}}" class="text-md text-gray-500 mr-4 hover:text-gray-700">
                Iniciar sesión
            </a>
        </nav>

        <section class="m-8">
            <ul class="bg-white border-r border-gray-300 shadow-xl">
                @forelse ($repositories as $repository)
                    <li class="flex items-center text-black p-2 hover:bg-gray-300">
                        <img
                            src="{{$repository->user->profile_photo_url}}"
                            alt="photo user"
                            class="w-12 h-12 rounded-full mr-2"
                        >
                        <div class="flex justify-between w-full">
                            <div class="flex-1">
                                <h2 class="text-sm font-semibold text-black">{{$repository->url}}</h2>
                                <p>{{$repository->description}}</p>
                            </div>
                        </div>

                        <span class="text-xs font-medium text-gray-600">{{$repository->created_at->diffForHumans()}}</span>

                    </li>

                @empty
                    <li>
                        <h1>Upss aun no tenemos agregado repositorios</h1>
                        <small>No hay repositorios</small>
                    </li>
                @endforelse
            </ul>

        </section>
    </body>
</html>
