<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kasir Toko') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-bold mb-4 dark:text-gray-100">Aplikasi Kasir Sederhana</h2>
                        <div class="min-w-7 min-h-16 py-4 dark:bg-gray-50 my-4" >

                            <div id="mainform123" class="overflow-auto"></div>

                        </div>

                        <div class="space-x-2">

                            <a href="#" id="load-btn" class="btn btn-blue">Load</a>
                            <a href="#" id="Insert-btn" class="btn btn-green">Insert</a>
                            <a href="#" id="update-btn" class="btn btn-green">update</a>
                            <a href="#" id="delete-btn" class="btn btn-red">delete</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
