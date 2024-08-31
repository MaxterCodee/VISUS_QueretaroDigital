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
                    <div id="chatbox" class="w-full max-w-lg h-96 bg-white border border-gray-300 rounded-lg p-4 mb-4 shadow-md">
                        <!-- Mensajes se mostrarán aquí -->
                    </div>
                    <form id="chat-form" class="w-full max-w-lg flex items-center bg-white border border-gray-300 rounded-lg p-2 shadow-md">
                        <input type="text" id="user-input" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe tu mensaje..." required />
                        <button type="submit" class=" text-white rounded-lg px-4 py-2 bg-blue-600 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Enviar</button>
                    </form>
                    <script >
                        document.addEventListener('DOMContentLoaded', () => {
                        const form = document.getElementById('chat-form');
                        const input = document.getElementById('user-input');
                        const chatbox = document.getElementById('chatbox');

                        form.addEventListener('submit', async (event) => {
                            event.preventDefault();

                            const userMessage = input.value;
                            if (!userMessage.trim()) return;

                            // Mostrar el mensaje del usuario en el chatbox
                            chatbox.innerHTML += `<div class="user-message bg-blue-100 text-right p-2 mb-2 rounded">${userMessage}</div>`;
                            chatbox.scrollTop = chatbox.scrollHeight; // Desplazar hacia abajo

                            // Limpiar el campo de entrada
                            input.value = '';

                            try {
                                // Enviar la solicitud a la API
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
                                                content: userMessage
                                            }
                                        ],
                                        max_tokens: 50
                                    })
                                });

                                if (!response.ok) {
                                    throw new Error(`Error fetching external API: ${response.status}`);
                                }

                                const result = await response.json();
                                if (result.choices && Array.isArray(result.choices) && result.choices.length > 0) {
                                    const aiMessage = result.choices[0].message.content;

                                    // Mostrar la respuesta de la IA en el chatbox
                                    chatbox.innerHTML += `<div class="ai-message bg-gray-100 text-left p-2 mb-2 rounded">${aiMessage}</div>`;
                                    chatbox.scrollTop = chatbox.scrollHeight; // Desplazar hacia abajo
                                } else {
                                    console.error('No choices found in the response:', result);
                                    chatbox.innerHTML += `<div class="ai-message bg-gray-100 text-left p-2 mb-2 rounded">No response received.</div>`;
                                    chatbox.scrollTop = chatbox.scrollHeight;
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                chatbox.innerHTML += `<div class="ai-message bg-gray-100 text-left p-2 mb-2 rounded">An error occurred.</div>`;
                                chatbox.scrollTop = chatbox.scrollHeight;
                            }
                        });
                    });

                    </script>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
