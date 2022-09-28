<x-app-layout>
    <!---->
    @include('layouts.sidebar')

    <div class="p-2 md:p-4 lg:p-4 md:ml-72 mt-24" id="container">
        <!-- Banners -->
        <div class="row">
            <div class="col">
                <img src="{{ asset('images/home.jpeg') }}" alt="">
                <h2 class="xl:text-xl lg:text-lg md:text-md mt-2 font-bold text-black">Faites vos courses sur Djassa</h2>
            </div>
            <div class="col">
                <img src="{{ asset('images/concert.jpeg') }}" alt="">
                <h2 class="xl:text-xl lg:text-lg md:text-md mt-2 font-bold text-black">Acheter des billets</h2>
            </div>
        </div>

        <h2 class="text-md md:text-lg lg:text-xl mt-3 font-bold text-black">Les offres de la semaine dans les magasins</h2>

        <div id="products-container" style="position:none">
            @include('layouts.products-list')
        </div>
        
        <div style="display:flex; justify-content:center; align-items:center; margin-top:4%">
            <button id="more-products" class="text-[#ec6333] border-2 border-solid border-red-600 md:px-8 md:py-1 px-16 py-3 rounded-lg text-base font-extrabold text-center">
                Afficher plus
            </button>
        </div>
        <input type="hidden" id="page_number" value="2" />
        <div class="row gx-1" style="margin-top:5%">
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                <img class="w-full" src="images/body-lotion.jpg" alt="" style="border-radius:8px">
                <h2 class="xl:text-xl lg:text-lg md:text-md mt-2 font-bold text-black">Les imbattables de la semaine</h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                <img class="w-full" src="images/body-lotion.jpg" alt="" style="border-radius:8px">
                <h2 class="xl:text-xl lg:text-lg md:text-md mt-2 font-bold text-black">Un soin optimal et naturel</h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                <img class="w-full" src="images/care-products.jpeg" alt="" style="border-radius:8px">
                <h2 class="xl:text-xl lg:text-lg md:text-md mt-2 font-bold text-black">Du nouveau en beauté</h2>
            </div>
        </div>

        <x-footer></x-footer>
    </div>
</x-app-layout>