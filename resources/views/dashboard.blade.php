<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                             
               <!-- component -->
                <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                            <header class="px-5 py-4 border-b border-gray-100">
                                <h2 class="font-semibold text-gray-800">Dashboard</h2>
                            </header>
                     
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
