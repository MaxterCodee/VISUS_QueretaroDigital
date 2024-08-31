<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- RUTA DASHBOARD, USAR COMO EJEMPLO --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 rounded-lg group
                       {{ Route::is('dashboard') ? 'text-gray-900 bg-blue-100 dark:text-white dark:bg-gray-700' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="fa-solid fa-gauge"></i>

                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- RUTA PERFIL --}}
            <li>
                <a href="{{ route('profile.show') }}"
                    class="flex items-center p-2 rounded-lg group
                       {{ Route::is('profile.show') ? 'text-gray-900 bg-blue-100 dark:text-white dark:bg-gray-700' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="fa-solid fa-user"></i>

                    <span class="ms-3">Perfil</span>
                </a>
            </li>
            {{-- RUTAS DE ADMINI --}}
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4"/>
                      </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Administrador</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{route('indexTipoReserva')}}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tipo de Reservas</a>
                    </li>
                    <li>
                        <a href="{{route('indexReserva')}}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Reservas</a>
                    </li>
                    <li>
                        <a href="{{route('indexTipoSensor')}}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tipo de sensores</a>
                    </li>
                    <li>
                        <a href="{{route('indexSensor')}}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sensores</a>
                    </li>
                    <li>
                        <a href="{{route('resultados')}}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Predicciones</a>
                    </li>


                </ul>
            </li>

            <div class="border-t border-gray-300 dark:border-gray-700"></div>

            {{-- RUTA LOGOUT --}}
            <li>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center p-2 rounded-lg group">
                    @csrf
                    <button type="submit"
                        class="flex items-center p-2 rounded-lg group w-full text-left {{ Route::is('logout') ? 'text-gray-900 bg-blue-100 dark:text-white dark:bg-gray-700' : 'text-gray-900 dark:text-white hover:bg-red-100 dark:hover:bg-gray-700' }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="ms-3">Cerrar sesión</span>
                    </button>
                </form>
            </li>


        </ul>
    </div>
</aside>
