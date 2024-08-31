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
                            <section class="maps">
                                @foreach ($reservas as $reserva)
                                    {{-- {{ dd($reserva->coordenadas) }} --}}
                                    <div id="map-{{ $reserva->id }}-{{ $reserva->tipo_reserva_id }}"
                                        style="height: 400px; width: 100%;"></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            // Incluir la biblioteca Leaflet
                                            var link = document.createElement('link');
                                            link.rel = 'stylesheet';
                                            link.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
                                            document.head.appendChild(link);

                                            var script = document.createElement('script');
                                            script.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
                                            script.onload = function() {
                                                var map = L.map('map-{{ $reserva->id }}-{{ $reserva->tipo_reserva_id }}');

                                                var defaultCoordinates =
                                                {!! json_encode($reserva->coordenadas) !!}; // Pasar las coordenadas desde PHP a JavaScript
                                                console.log("Default Coordinates:", defaultCoordinates);

                                                var latLng = defaultCoordinates.split(',').map(Number);
                                                console.log("Parsed Coordinates:", latLng);

                                                if (Array.isArray(latLng) && latLng.length === 2 && !isNaN(latLng[0]) && !isNaN(latLng[1])) {
                                                    map.setView(latLng, 19);
                                                } else {
                                                    console.error("Coordinates are not in the correct format: [lat, lng]");
                                                }

                                                // Añadir capa base al mapa
                                                L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                                                    attribution: 'Google'
                                                }).addTo(map);
                                            };
                                            document.body.appendChild(script);
                                        });
                                    </script>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
