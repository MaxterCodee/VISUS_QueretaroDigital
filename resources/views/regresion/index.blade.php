<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <form method="GET" action="{{ route('resultados') }}" class="flex items-center space-x-4 p-4">
        <label for="dias" class="text-gray-700">Selecciona el número de días:</label>
        <select name="dias" id="dias" class="border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @for($i = 10; $i <= 100; $i += 10)
                <option value="{{ $i }}" {{ $i == $dias ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Actualizar</button>
    </form>


    <div class="grid md:grid-cols-2 gap-8 p-4">
        @foreach($resultados as $resultado)
        <div class="border shadow rounded-lg p-4">
            <h2 class="text-2xl font-bold text-gray-900">
                <span class="font-semibold">{{ $resultado['reserva_name'] }}</span> - {{ $resultado['sensor_name'] }}
            </h2>
            <strong>Valor predicho para {{$dias}} días</strong>  {{$resultado['predicted_value']}}
            <canvas id="chart-{{ $resultado['sensor_id'] }}" width="400" height="200"></canvas>
        </div>

        <script>
            // Obtener samples y targets del resultado actual
            var samples = @json(array_column($resultado['samples'], 0));
            var targets = @json($resultado['targets']);

            // Configuración de la gráfica
            var ctx = document.getElementById('chart-{{ $resultado['sensor_id'] }}').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: [{
                        label: '',
                        data: samples.map((sample, index) => {
                            return { x: sample, y: targets[index] };
                        }),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        showLine: true, // Mostrar línea que une los puntos
                        fill: false, // No rellenar debajo de la línea
                        tension: 0 // Tensión de la curva (0 para línea recta)
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom',
                            title: {
                                display: true,
                                text: '{{ $resultado['unidad_medida'] }}'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Targets'
                            }
                        }
                    }
                }
            });
        </script>
        @endforeach
    </div>


</x-app-layout>
