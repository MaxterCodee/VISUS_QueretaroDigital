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



                                <script>

                                    async function api2() {
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
                                                                max-tonkens: 50;
                                                            },
                                                            {
                                                                role: 'user',
                                                                content: 'Tell me, why is the sky blue?'
                                                            }
                                                        ]
                                                    })
                                                    max-tokens: 50,
                                                });

                                                const result = await response.json();
                                                const message = result.choices[0].message.content;
                                                console.log(`Assistant: ${message}`);
                                                alert(`Assistant: ${message}`);
                                            }

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

                                    // Función principal para realizar la solicitud a la API externa
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
                                                    ]
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

                                    // Llama a la función api() al cargar la página o en el evento deseado
                                    document.addEventListener('DOMContentLoaded', (event) => {
                                        api();
                                    });


                                    async function pruebaText() {
                                        try {
                                            const response = await fetch('/tipo_reserva');
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
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
