<x-app-layout>
    <div class="container" style="margin-top: 10rem">
        <div class="row" style="margin-top:3%">
            <div class="col-8">
                <img src="images/pomme-de-terre.webp" alt="">
                <img src="images/concert.jpeg" class="img-responsive mx-3" style="margin-bottom:10%" alt="...">
            </div>
            <div class="col-4">
                
                <div class="card shadow-sm py-3 px-6" style="border-radius:15px">
                    <div class="card-body">
                        <p class="py-1 mt-2" style="font-weight:700;">{{ $product->title }}</p>
                        <p class="py-3" style="font-weight:700;font-size:18px">3 500 F CFA</p>
                        <button style="background-color:#ec6333; color:#fff; padding:0.75em 4.5em; border-radius:0.3em; font-size:18px; font-weight:800; text-align:center;">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="font-weight:600; font-size:20px">Principales caractéristiques</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="font-weight:600;font-size:20px">Conservation et utilisation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" style="font-weight:600;font-size:20px">Autres indications</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="margin-top:4%"> 
                <h3 style="font-weight:700;font-size:18px">Marque & labels <span style="font-weight:400;font-size:17PX; margin-left:6.5%">BELLE FRANCE</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Propriétés <span style="font-weight:400;font-size:17PX; margin-left:10.4%">Bio</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Pays de production <span style="font-weight:400;font-size:17PX; margin-left:4.7%">France</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Variété <span style="font-weight:400;font-size:17PX; margin-left:12.4%">Dita, Annabelle, Charlotte</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Stockage à domicile <span style="font-weight:400;font-size:17PX; margin-left:4.1%">Conserver au frais, mais pas au réfrigérateur</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Procédé de production <span style="font-weight:400;font-size:17PX; margin-left:2.4%">Production biologique</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Emballage <span style="font-weight:400;font-size:17PX; margin-left:10%">Emballé</span></h3>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Conservation et utilisation</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Autres indications</div>
        </div>
    </div>
</x-app-layout>
