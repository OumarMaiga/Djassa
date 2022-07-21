<x-app-layout>
    @include('layouts.sidebar')

    <div style="margin-left:19rem; margin-top:6.5rem" id="container">
        <!-- Banners -->
        <div class="row" style="margin-right:1rem">
            <div class="col">
                <img src="{{ asset('images/home.jpeg') }}" alt="">
                <h2 class="text-xl font-bold text-black" style="margin-top:2%; font-size:20px; font-weight:700">Faites vos courses sur Djassa</h2>
            </div>
            <div class="col">
                <img src="{{ asset('images/concert.jpeg') }}" alt="">
                <h2 class="text-xl font-bold text-black" style="margin-top:2%; font-size:20px; font-weight:700">Acheter des billets</h2>
            </div>
        </div>

        <h2 style="margin-top:5%; margin-bottom:1.5rem; font-size:24px; font-weight:700">Les offres de la semaine dans les magasins</h2>

        <div id="">
            <div id="products-container" class="row" style="margin-right:1rem">
                @include('layouts.products-list')
            </div>
        </div>
        
        <div style="display:flex; justify-content:center; align-items:center; margin-top:4%">
            <button id="more-products" style="color:#ec6333; border:2px solid #ec6333; padding:0.75em 4.5em; border-radius:0.5em; font-size:18px; font-weight:800; text-align:center;">
                Afficher plus
            </button>
        </div>
        <input type="hidden" id="page_number" value="1" />
        <div class="row gx-1" style="margin-top:5%">
            <div class="col">
                <img src="images/body-lotion.jpg" alt="" style="border-radius:8px">
                <h2 class="text-xl font-bold text-black" style="margin-top:2%; font-size:20px; font-weight:700">Les imbattables de la semaine</h2>
            </div>
            <div class="col">
                <img src="images/body-lotion.jpg" alt="" style="border-radius:8px">
                <h2 class="text-xl font-bold text-black" style="margin-top:2%; font-size:20px; font-weight:700">Un soin optimal et naturel</h2>
            </div>
            <div class="col">
                <img src="images/care-products.jpeg" alt="" style="border-radius:8px">
                <h2 class="text-xl font-bold text-black" style="margin-top:2%; font-size:20px; font-weight:700">Du nouveau en beauté</h2>
            </div>
        </div>

        <x-footer></x-footer>
    </div>
</x-app-layout>