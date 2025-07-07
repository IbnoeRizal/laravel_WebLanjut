<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom script -->
        <script defer src="{{ asset('js/custom.js') }}"></script>
        <script>
            const Routing = Object.freeze({
                pilihan: "{{ route('pilihan') }}",
                products: {
                    create: "{{ route('products.create') }}",
                    store: "{{ route('products.store') }}",
                    edit: "{{ route('products.edit')}}",
                    update: "{{ route('products.update', ['product' => '__ID__']) }}",
                    destroy: "{{ route('products.destroy', ['product' => '__ID__']) }}",
                    show: "{{ route('products.show', ['product' => '__ID__']) }}",
                    index: "{{ route('products.index') }}",
                },
                transactions: {
                    create: "{{ route('transactions.create') }}",
                    store: "{{ route('transactions.store') }}",
                    edit: "{{ route('transactions.edit') }}",
                    update: "{{ route('transactions.update', ['transaction' => '__ID__']) }}",
                    destroy: "{{ route('transactions.destroy', ['transaction' => '__ID__']) }}",
                    show: "{{ route('transactions.show', ['transaction' => '__ID__']) }}",
                    index: "{{ route('transactions.index') }}",
                },
                categories: {
                    create: "{{ route('categories.create') }}",
                    store: "{{ route('categories.store') }}",
                    edit: "{{ route('categories.edit') }}",
                    update: "{{ route('categories.update', ['category' => '__ID__']) }}",
                    destroy: "{{ route('categories.destroy', ['category' => '__ID__']) }}",
                    show: "{{ route('categories.show', ['category' => '__ID__']) }}",
                    index: "{{ route('categories.index') }}",
                },
            });
        </script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
