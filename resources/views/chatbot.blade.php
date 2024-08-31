<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto h-screen mt-8 sm:px-6 lg:px-8">
        <div class="bg-white p-4 sm:rounded-lg">
            <div class="">
                <div class="max-w-7xl border p-2 rounded mx-auto sm:px-6 lg:px-8">
                </div>
            </div>
        </div>
    </div>

    @include('components.chatbubble')
</x-app-layout>
