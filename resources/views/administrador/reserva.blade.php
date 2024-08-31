<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrador->Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Modal para crear --}}

            <div class="justify-between align-bottom pb-5">
                <!-- Modal toggle -->
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Crear reserva
                </button>
            </div>
            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Crear reserva
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="#">
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nombre de la reserva
                                    </label>
                                    <input type="text" name="nombre"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Descripción
                                    </label>
                                    <input type="text" name="descripcion"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tipo de reserva
                                    </label>
                                    <select name="tipo_reserva"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required>
                                        <option value="1">Tipo 1</option>
                                        <option value="2">Tipo 2</option>
                                        <option value="3">Tipo 3</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Coordenadas
                                    </label>
                                    <input type="text" name="coordenadas"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                                <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Crear tipo de reserva
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fin de modal --}}

            {{-- MOdal para editar --}}
            <div id="modal-editar" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Crear tipo de reserva
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="modal-editar">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="#">
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nombre de la reserva
                                    </label>
                                    <input type="text" name="nombre"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Descripción
                                    </label>
                                    <input type="text" name="descripcion"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tipo de reserva
                                    </label>
                                    <select name="tipo_reserva"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required>
                                        <option value="1">Tipo 1</option>
                                        <option value="2">Tipo 2</option>
                                        <option value="3">Tipo 3</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Coordenadas
                                    </label>
                                    <input type="text" name="coordenadas"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                                <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Crear tipo de reserva
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fin de modal  --}}

            {{-- Tabla --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Descripción
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Coordenadas
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reserva->isEmpty())
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4" colspan="4">
                                        No hay reservas
                                    </td>
                                </tr>
                            @endif
                            @foreach ($reserva as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->nombre }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->descripcion }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->tipos->nombre }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->coordenadas }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a data-modal-target="modal-editar" data-modal-toggle="modal-editar"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($reserva as $reservas)
                <div class="bg-white p-4 shadow-xl sm:rounded-lg hover:translate-y-1 pb-10">
                    <section class="maps">
                        <div class="">
                            <h2 class="text-center text-4xl">{{ $reservas->nombre }}</h2>
                        </div>
                        <div id="map-{{ $reservas->id }}-{{ $reservas->tipo_reserva_id }}"
                            style="height: 400px; width: 100%;"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var link = document.createElement('link');
                                link.rel = 'stylesheet';
                                link.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
                                document.head.appendChild(link);

                                var script = document.createElement('script');
                                script.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
                                script.onload = function() {
                                    var map = L.map('map-{{ $reservas->id }}-{{ $reservas->tipo_reserva_id }}');

                                    var defaultCoordinates =
                                        {!! json_encode($reservas->coordenadas) !!}; // Pasar las coordenadas desde PHP a JavaScript
                                    console.log("Default Coordinates:", defaultCoordinates);

                                    var latLng = defaultCoordinates.split(',').map(Number);
                                    console.log("Parsed Coordinates:", latLng);

                                    if (Array.isArray(latLng) && latLng.length === 2 && !isNaN(latLng[0]) && !isNaN(latLng[1])) {
                                        map.setView(latLng, 19);
                                    } else {
                                        console.error("Coordinates are not in the correct format: [lat, lng]");
                                    }

                                    L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                                        attribution: 'Google'
                                    }).addTo(map);
                                };
                                document.body.appendChild(script);
                            });
                        </script>
                    </section>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
