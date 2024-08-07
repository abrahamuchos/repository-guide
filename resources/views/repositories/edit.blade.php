<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Repositorios
        </h2>
    </x-slot>

    {{-- Breadcrumbs --}}
    <div class="pt-5">
        <nav class="flex mx-5 mb-6">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('dashboard')}}"
                       class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{route('repositories.index')}}"
                           class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Repositorios
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <p class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400 w-[70%] h-[1.1em] truncate">Editar - {{$repository->description}}</p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    {{-- End Breadcrumbs --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{route('repositories.update', $repository)}}" method="POST" class="max-w-mg" id="form-edit">
                    @csrf
                    @method('PATCH')

                    <label class="block font-medium text-sm text-gray-700">URL *</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="text" name="url" value="{{$repository->url}}">

                    <label class="block font-medium text-sm text-gray-700">Description *</label>
                    <textarea class="form-input w-full rounded-md shadow-sm" name="description">{{$repository->description}}</textarea>

                </form>

                <hr class="my-4">

                <div class="flex w-full justify-center">
                    <input type="submit" value="Editar" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md cursor-pointer hover:bg-blue-700">
                    <form action="{{route('repositories.destroy', $repository)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Eliminar" class="bg-gray-400 text-white font-bold py-2 px-4 rounded-md ml-5 cursor-pointer hover:bg-red-700">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
