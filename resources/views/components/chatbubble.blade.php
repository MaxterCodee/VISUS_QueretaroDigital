<div class="bg-gray-100 flex items-center justify-center ">
    <div class="fixed z-10 top-0 right-0 m-4 w-full max-w-lg">
        <div class="formbold-form-wrapper mx-auto hidden w-full max-w-[550px] rounded-lg border border-[#e0e0e0] bg-white">
            <div class="flex items-center mt-10 justify-between rounded-t-lg bg-[#6A64F1] py-4 px-9">
                <h3 class="text-xl font-bold text-white">Pregunta sobre cualquier dato</h3>
                <button onclick="chatboxToogleHandler()" class="text-white">
                    <svg width="17" height="17" viewBox="0 0 17 17" class="fill-current">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.474874 0.474874C1.10804 -0.158291 2.1346 -0.158291 2.76777 0.474874L16.5251 14.2322C17.1583 14.8654 17.1583 15.892 16.5251 16.5251C15.892 17.1583 14.8654 17.1583 14.2322 16.5251L0.474874 2.76777C-0.158291 2.1346 -0.158291 1.10804 0.474874 0.474874Z"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.474874 16.5251C-0.158291 15.892 -0.158291 14.8654 0.474874 14.2322L14.2322 0.474874C14.8654 -0.158292 15.892 -0.158291 16.5251 0.474874C17.1583 1.10804 17.1583 2.1346 16.5251 2.76777L2.76777 16.5251C2.1346 17.1583 1.10804 17.1583 0.474874 16.5251Z"/>
                    </svg>
                </button>
            </div>
            <div id="chatbox" class="w-full max-w-lg h-96 overflow-y-scroll bg-white border border-gray-300 rounded-lg p-4 mb-4 shadow-md">
                <!-- Mensajes se mostrarán aquí -->
            </div>
            <form id="chat-form" class="w-full max-w-lg flex items-center bg-white border border-gray-300 rounded-lg p-2 shadow-md" onsubmit="return handleSubmit(event)">
                <input type="text" id="user-input" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe tu mensaje..." required />
                <button type="submit" class="text-white rounded-lg px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Enviar</button>
            </form>
        </div>
        <div class="mx-auto mt-12 flex max-w-[550px] items-center justify-end space-x-5">
            <button class="flex h-[70px] w-[70px] items-center justify-center rounded-full bg-[#6A64F1] text-white" onclick="chatboxToogleHandler()">
                <span class="cross-icon hidden">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.474874 0.474874C1.10804 -0.158291 2.1346 -0.158291 2.76777 0.474874L16.5251 14.2322C17.1583 14.8654 17.1583 15.892 16.5251 16.5251C15.892 17.1583 14.8654 17.1583 14.2322 16.5251L0.474874 2.76777C-0.158291 2.1346 -0.158291 1.10804 0.474874 0.474874Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.474874 16.5251C-0.158291 15.892 -0.158291 14.8654 0.474874 14.2322L14.2322 0.474874C14.8654 -0.158292 15.892 -0.158291 16.5251 0.474874C17.1583 1.10804 17.1583 2.1346 16.5251 2.76777L2.76777 16.5251C2.1346 17.1583 1.10804 17.1583 0.474874 16.5251Z" fill="white"/>
                    </svg>
                </span>
                <span class="chat-icon">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.8333 14.0002V3.50016C19.8333 3.19074 19.7103 2.894 19.4915 2.6752C19.2728 2.45641 18.976 2.3335 18.6666 2.3335H3.49992C3.1905 2.3335 2.89375 2.45641 2.67496 2.6752C2.45617 2.894 2.33325 3.19074 2.33325 3.50016V19.8335L6.99992 15.1668H18.6666C18.976 15.1668 19.2728 15.0439 19.4915 14.8251C19.7103 14.6063 19.8333 14.3096 19.8333 14.0002ZM24.4999 7.00016H22.1666V17.5002H6.99992V19.8335C6.99992 20.1429 7.12284 20.4397 7.34163 20.6585C7.56042 20.8772 7.85717 21.0002 8.16659 21.0002H20.9999L25.6666 25.6668V8.16683C25.6666 7.85741 25.5437 7.56066 25.3249 7.34187C25.1061 7.12308 24.8093 7.00016 24.4999 7.00016Z" fill="white"/>
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <script>
        const formWrapper = document.querySelector(".formbold-form-wrapper");
        const crossIcon = document.querySelector(".cross-icon");
        const chatIcon = document.querySelector(".chat-icon");

        function chatboxToogleHandler() {
            formWrapper.classList.toggle("hidden");
            crossIcon.classList.toggle("hidden");
            chatIcon.classList.toggle("hidden");
        }

        async function fetchWithRetry(url, options, retries = 5, delay = 1000) {
            try {
                // Obtén el token CSRF del meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch(url, {
                    ...options,
                    headers: {
                        ...options.headers,
                        'X-CSRF-TOKEN': csrfToken // Incluye el token CSRF en los encabezados
                    }
                });

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

        async function handleSubmit(event) {
            event.preventDefault(); // Evitar el refresco de la página

            const userMessage = document.getElementById('user-input').value;
            document.getElementById('user-input').value = ''; // Limpiar el campo de entrada

            try {
                // Obtener datos de la base de datos
                const dataResponse = await fetch('/database_data');
                if (!dataResponse.ok) {
                    throw new Error(`Error fetching local data: ${dataResponse.status}`);
                }
                const data = await dataResponse.json();
                const dataString = JSON.stringify(data);

                // Enviar datos a la API de chat
                const apiResponse = await fetchWithRetry('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        userMessage: `Interpreta el siguiente array de datos: ${dataString} y responde a esta pregunta: ${userMessage}`
                    })
                });

                if (!apiResponse.ok) {
                    throw new Error(`Error fetching chat API: ${apiResponse.status}`);
                }

                const result = await apiResponse.json();
                const message = result.response || 'No response received.';

                // Mostrar el mensaje de la IA en el chatbox
                const chatbox = document.getElementById('chatbox');
                chatbox.innerHTML += `<div class="ai-message bg-gray-100 text-left p-2 mb-2 rounded">${message}</div>`;
                chatbox.scrollTop = chatbox.scrollHeight; // Desplazar hacia abajo

            } catch (error) {
                console.error('Error:', error);
                const chatbox = document.getElementById('chatbox');
                chatbox.innerHTML += `<div class="ai-message bg-gray-100 text-left p-2 mb-2 rounded">An error occurred.</div>`;
                chatbox.scrollTop = chatbox.scrollHeight;
            }
        }

        document.getElementById('chat-form').addEventListener('submit', handleSubmit);
    </script>
</div>

<style>
    #chatbox {
        z-index: 3000; /* Adjust as needed */
    }
</style>


{{--


                                    // // Función para hacer una solicitud simple a la API externa (Esta es la del chatbot funcional)
                                    // async function api2() {
                                        //     try {
                                        //         const response = await fetch('https://api.aimlapi.com/v1/chat/completions', {
                                        //             method: 'POST',
                                        //             headers: {
                                        //                 'Content-Type': 'application/json',
                                        //                 'Authorization': 'Bearer be1ee4c179f644d390fa239d1001d2f9'
                                        //             },
                                        //             body: JSON.stringify({
                                        //                 model: 'gpt-4o-2024-08-06',
                                        //                 messages: [
                                        //                     {
                                        //                         role: 'system',
                                        //                         content: 'You are an AI assistant who knows everything.'
                                        //                     },
                                        //                     {
                                        //                         role: 'user',
                                        //                         content: 'Tell me, why is the sky blue?'
                                        //                     }
                                        //                 ],
                                        //                 max_tokens: 50  // Añadir limitación de tokens
                                        //             })
                                        //         });

                                        //         if (!response.ok) {
                                        //             throw new Error(`Error fetching external API: ${response.status}`);
                                        //         }

                                    //         const result = await response.json();
                                    //         if (result.choices && Array.isArray(result.choices) && result.choices.length > 0) {
                                    //             const message = result.choices[0].message.content;
                                    //             console.log(`Assistant: ${message}`);
                                    //             alert(`Assistant: ${message}`);
                                    //         } else {
                                    //             console.error('No choices found in the response:', result);
                                    //             alert('No response received.');
                                    //         }
                                    //     } catch (error) {
                                    //         console.error('Error:', error);
                                    //         alert('An error occurred.');
                                    //     }
                                    // }

                                    // Función principal para realizar la solicitud a la API externa con datos locales
                                    {{-- async function api() {
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
                                </script> --}}

