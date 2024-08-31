<x-app-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.0/dist/cdn.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="columns-1 md:w-full md:columns-2">
        @if (!empty($alertas))
            @foreach ($alertas as $alerta)
                <div x-data="{ show: true }" x-show="show" id="alert-{{ $alerta['sensor'] }}"
                    class="flex items-center p-4 mb-4 text-fuerte rounded-lg bg-green-100 dark:bg-green-100 dark:text-fuerte"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Alert</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $alerta['mensaje'] }} - {{ $alerta['sensor'] }} ({{ $alerta['tipo'] }}): {{ $alerta['valor'] }}
                    </div>
                    <button @click="show = false"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-fuerte rounded-lg focus:ring-2 focus:ring-green-150 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-green-200 dark:text-fuerte dark:hover:bg-green-700 dark:hover:text-white"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endforeach
        @endif
    </div>
    
    
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
