<x-app-layout>
    @include('layouts.sidebar')

    <div style="margin-left:19rem; margin-top:6.5rem">
        
        <h2 style="margin-top:5%; margin-bottom:1rem; font-size:30px; font-weight:600">{{ $sub_sub_category->title }}</h2>

        <div class="">
        <h2 style="margin-top:1%; margin-bottom:1rem; font-size:24px; font-weight:600; color:#ec6333;">Tous les produits</h2>
            <div class="row" style="margin-right:1rem">
                @include('layouts.products-list')
            </div>
        </div>

        <x-footer></x-footer>
    </div>
</x-app-layout>
