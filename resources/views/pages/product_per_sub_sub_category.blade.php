<x-app-layout>
    @include('layouts.sidebar')

    <div class="p-2 ml-4 md:p-4 lg:p-4 md:ml-72 mt-24" id="container">
        
        <h2 style="margin-top:2%; margin-bottom:1rem; font-size:30px; font-weight:600">{{ $sub_sub_category->title }}</h2>

        <div class="md:ml-72">
        <h2 style="margin-top:1%; margin-bottom:1rem; font-size:24px; font-weight:600; color:#ec6333;">Tous les produits</h2>
            <div class="row" style="margin-right:1rem">
                @include('layouts.products-list')
            </div>
        </div>

        <x-footer></x-footer>
    </div>
</x-app-layout>
