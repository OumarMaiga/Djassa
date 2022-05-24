<x-app-layout>
    <div class="container" style="margin-top: 7rem">
    <p style="font-size:18px; font-weight:500">Djassa > Fruits & Légumes > Légumes à racine > Pommes de terre</p>
        <div class="row" style="margin-top:3%; margin-bottom:5%">
            <div class="col-7" style="display:flex; justify-content:center">
                <img src="{{ asset('images/pomme-de-terre.webp') }}" alt="">
            </div>
            <div class="col-5" style="margin-top:5%">
                
                <div class="card shadow-sm" style="border-radius:15px;display:flex; align-items:center; padding:1.5rem">
                    <div class="card-body">
                        <form  method="POST" action="{{ route('panier.store') }}">
                            @csrf
                                <input type="hidden" id="id" name="id" value="{{ $product->id }}">
                            <p class="py-1 mt-2" style="font-weight:700;font-size:18px">{{ $product->title }}</p>
                            <p class="py-3" style="font-weight:700;font-size:18px">{{ $product->price }} FCFA<span style="margin-left:5.8rem">Qté:&nbsp;<input id="quantity" name="quantity" type="number" value="1" min="1" style="width:5rem"></span></p>
                            <button type="submit" id="addcart" style="background-color:#ec6333; color:#fff; padding:0.75em 4.5em; border-radius:0.3em; font-size:18px; font-weight:800; text-align:center;">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="font-weight:600; font-size:20px; color:#1A1A1A">Principales caractéristiques</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="font-weight:600;font-size:20px; color:#1A1A1A">Conservation et utilisation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" style="font-weight:600;font-size:20px; color:#1A1A1A">Autres indications</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="margin-bottom:2rem">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="margin-top:3%"> 
                <h3 style="font-weight:700;font-size:18px">Marque & labels <span style="font-weight:400;font-size:17PX; margin-left:6.5%">BELLE FRANCE</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Propriétés <span style="font-weight:400;font-size:17PX; margin-left:10.4%">Bio</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Pays de production <span style="font-weight:400;font-size:17PX; margin-left:4.7%">France</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Variété <span style="font-weight:400;font-size:17PX; margin-left:12.4%">Dita, Annabelle, Charlotte</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Stockage à domicile <span style="font-weight:400;font-size:17PX; margin-left:4.1%">Conserver au frais, mais pas au réfrigérateur</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Procédé de production <span style="font-weight:400;font-size:17PX; margin-left:2.4%">Production biologique</span></h3>
                <h3 style="font-weight:700;font-size:18px; margin-top:2rem">Emballage <span style="font-weight:400;font-size:17PX; margin-left:10%">Emballé</span></h3>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="margin-top:3%"> 
                <p>
                <span style="font-weight:700;font-size:18px">Conservation</span><span style="font-weight:400;font-size:17PX; margin-left:9%">Conserver les pommes de terre à l'abri de la lumière et ailleurs qu'au réfrigérateur. Température conseillée: 8 à 10 °C environ.</span>
                </p>
                <p style="margin-top:2rem">
                <span style="font-weight:700;font-size:18px; margin-top:2rem">Renseignements<br> pratiques</span><span style="font-weight:400;font-size:17PX; margin-left:11.4%">Idéales pour poêlée et aussi confites à la provençale</span>
                </p> 
                <p style="margin-top:2rem">
                <span style="font-weight:700;font-size:18px; margin-top:2rem">Complément d'info</span><span style="font-weight:400;font-size:17PX; margin-left:4.7%">
                    Plutôt petite, mais pleine de goût, cette variété se présente sous une forme fine et délicate qui dissimule une chair étonnamment ferme. <br> <span style="margin-left:14rem">Elle s’accorde avec les raclettes, les plateaux de fromages et donne de savoureuses salades.</span></span>
                </p>
                
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" style="margin-top:3%">
                <p>
                <span style="font-weight:700;font-size:18px">Désignation légale</span><span style="font-weight:400;font-size:17PX; margin-left:6.5%">Pommes de terre bio, à consommer cuites</span>
                </p>
                <p style="margin-top:2rem">
                <span style="font-weight:700;font-size:18px; margin-top:2rem">Numéro d’article</span><span style="font-weight:400;font-size:17PX; margin-left:7.5%">
274486308500</span>
                </p> 
            </div>
        </div>
    </div>
</x-app-layout>
