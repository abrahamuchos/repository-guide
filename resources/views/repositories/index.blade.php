<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Repositorios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-5 me-7">
                <a  href="{{route('repositories.create')}}"
                    class="h-full bg-blue-600 cursor-pointer px-3 py-2 text-white font-semibold rounded-md hover:bg-blue-700"
                >

                    Añadir
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Enlace</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($repositories as $repository)
                            <tr>
                                <td class="border px-4 py-2">{{$repository->id}}</td>
                                <td class="border px-4 py-2">{{$repository->url}}</td>
                                <td class="border px-4 py-2 ">
                                    <div class="flex justify-around">
                                        <a href="{{route('repositories.show', $repository)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        <a href="{{route('repositories.edit', $repository)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h1>No hay repositorios </h1>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
