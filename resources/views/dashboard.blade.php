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



                                <script>
                                    // Función para realizar una solicitud con reintentos en caso de error 429
                                    async function fetchWithRetry(url, options, retries = 5, delay = 1000) {
                                        try {
                                            const response = await fetch(url, options);
                                            if (response.status === 429 && retries > 0) {
                                                // Espera antes de reintentar
                                                await new Promise(res => setTimeout(res, delay));
                                                return fetchWithRetry(url, options, retries - 1, delay * 2);
                                            }
                                            if (!response.ok) {
                                                throw new Error(`HTTP error! Status: ${response.status}`);
                                            }
                                            return response;
                                        } catch (error) {
                                            if (retries > 0) {
                                                await new Promise(res => setTimeout(res, delay));
                                                return fetchWithRetry(url, options, retries - 1, delay * 2);
                                            }
                                            throw error;
                                        }
                                    }

                                    // Función para hacer una solicitud simple a la API externa
                                    async function api2() {
                                        try {
                                            const response = await fetch('https://api.aimlapi.com/v1/chat/completions', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Authorization': 'Bearer be1ee4c179f644d390fa239d1001d2f9'
                                                },
                                                body: JSON.stringify({
                                                    model: 'gpt-4o-2024-08-06',
                                                    messages: [
                                                        {
                                                            role: 'system',
                                                            content: 'You are an AI assistant who knows everything.'
                                                        },
                                                        {
                                                            role: 'user',
                                                            content: 'Tell me, why is the sky blue?'
                                                        }
                                                    ],
                                                    max_tokens: 50  // Añadir limitación de tokens
                                                })
                                            });

                                            if (!response.ok) {
                                                throw new Error(`Error fetching external API: ${response.status}`);
                                            }

                                            const result = await response.json();
                                            if (result.choices && Array.isArray(result.choices) && result.choices.length > 0) {
                                                const message = result.choices[0].message.content;
                                                console.log(`Assistant: ${message}`);
                                                alert(`Assistant: ${message}`);
                                            } else {
                                                console.error('No choices found in the response:', result);
                                                alert('No response received.');
                                            }
                                        } catch (error) {
                                            console.error('Error:', error);
                                            alert('An error occurred.');
                                        }
                                    }

                                    // Función principal para realizar la solicitud a la API externa con datos locales
                                    async function api() {
                                        try {
                                            // Primero obtenemos los datos de la API local
                                            const reservaResponse = await fetch('/tipo_reserva');
                                            if (!reservaResponse.ok) {
                                                throw new Error(`Error fetching local data: ${reservaResponse.status}`);
                                            }
                                            const data = await reservaResponse.json();
                                            const dataString = JSON.stringify(data);

                                            // Luego usamos esos datos en la solicitud a la API externa
                                            const apiResponse = await fetchWithRetry('https://api.aimlapi.com/v1/chat/completions', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Authorization': 'Bearer be1ee4c179f644d390fa239d1001d2f9'
                                                },
                                                body: JSON.stringify({
                                                    model: 'gpt-4o-2024-08-06',
                                                    messages: [
                                                        {
                                                            role: 'system',
                                                            content: 'You are an AI assistant who knows everything.'
                                                        },
                                                        {
                                                            role: 'user',
                                                            content: `Interpreta el array data: ${dataString} y dime qué es.`
                                                        }
                                                    ],
                                                    max_tokens: 50  // Limita la respuesta a 50 tokens
                                                })
                                            });

                                            if (!apiResponse.ok) {
                                                throw new Error(`Error fetching external API: ${apiResponse.status}`);
                                            }

                                            const result = await apiResponse.json();

                                            if (result.choices && Array.isArray(result.choices) && result.choices.length > 0) {
                                                const message = result.choices[0].message.content;
                                                console.log(`Assistant: ${message}`);
                                                document.getElementById('response').textContent = message;
                                            } else {
                                                console.error('No choices found in the response:', result);
                                                document.getElementById('response').textContent = 'No response received.';
                                            }
                                        } catch (error) {
                                            console.error('Error:', error);
                                            document.getElementById('response').textContent = 'An error occurred.';
                                        }
                                    }

                                    // Función para cargar datos locales y mostrarlos
                                    async function pruebaText() {
                                        try {
                                            const response = await fetch('/tipo_reserva');
                                            if (!response.ok) {
                                                throw new Error(`Error fetching local data: ${response.status}`);
                                            }
                                            const data = await response.json();

                                            // Limpiar la lista antes de agregar nuevos elementos
                                            const lista = document.getElementById('listaTipoReserva');
                                            lista.innerHTML = '';

                                            // Iterar sobre los datos obtenidos del controlador
                                            data.forEach(function(item) {
                                                console.log(item);

                                                // Crear un nuevo elemento de lista para cada item
                                                const li = document.createElement('li');
                                                li.textContent = item.nombre;  // Cambia "nombre" por la propiedad que quieras mostrar

                                                // Agregar el nuevo elemento a la lista
                                                lista.appendChild(li);
                                            });

                                            // Mostrar también el primer nombre en el <h1> con id "prueba"
                                            if (data.length > 0) {
                                                document.getElementById('prueba').textContent = data[0].nombre;
                                            } else {
                                                document.getElementById('prueba').textContent = 'No se encontraron datos.';
                                            }
                                        } catch (error) {
                                            console.error('Error al obtener los datos:', error);
                                        }
                                    }

                                    // Llama a la función api() al cargar la página o en el evento deseado
                                    document.addEventListener('DOMContentLoaded', (event) => {
                                        api();
                                        pruebaText();
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
