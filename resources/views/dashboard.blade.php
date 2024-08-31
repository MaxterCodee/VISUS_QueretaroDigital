<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow-xl sm:rounded-lg">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white p-4 shadow-xl sm:rounded-lg">
                            <div>
                                <button onclick="api()" class="p-2 bg-blue-600 text-white rounded">Probar API</button>
                                <button onclick="pruebaText()" class="p-2 bg-blue-600 text-white rounded">Probar Ruta</button>
                                <button onclick="api2()" class="p-2 bg-blue-600 text-white rounded">Ruta 2</button>
                                <div>
                                    <h1 id="response"></h1>
                                    <h1 id="prueba"></h1>
                                    <h1 id="prueba2"></h1>
                                    <ul id="listaTipoReserva"></ul>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
