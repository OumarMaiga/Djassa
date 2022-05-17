<x-app-layout>
    @include('layouts.sidebar')

    <div style="margin-left:19rem; margin-top:6.5rem">
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

        <div class="">
        <div class="row" style="margin-right:1rem">
                <div class="col-2">
                    <div class="card shadow-sm">
                        <a :href="route('dashboard/product/1')" class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%; cursor:pointer">Voir les offres</a>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4" style="margin-right:1rem">
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow-sm">
                        <p class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%">Voir les offres</p>
                        <img src="images/lunettes.webp" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
                        <div class="card-body">
                            <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">30%</p>
                            <p style="font-size:13px; font-weight:600">Some quick example text to build on the card title and make up</p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex; justify-content:center; align-items:center; margin-top:4%">
                <button style="color:#ec6333; border:2px solid #ec6333; padding:0.75em 4.5em; border-radius:0.5em; font-size:18px; font-weight:800; text-align:center;">
                    Afficher plus
                </button>
            </div>
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
        </div>

        <x-footer></x-footer>
    </div>
</x-app-layout>