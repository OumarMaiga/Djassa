<x-app-layout>
    @include('layouts.sidebar')
    <div class="p-2 md:p-4 lg:p-4 md:ml-72 mt-24" id="container">
        <h2 class="text-lg md:text-lg lg:text-xl font-bold">{{ count($products) }} resultat(s) pour {{ $query }}</h2>

        <div id="products-container" class="mt-2">
            @include('layouts.products-list')
        </div>
    </div>
</x-app-layout>