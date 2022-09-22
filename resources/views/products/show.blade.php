<x-app-layout>
    <?php
    if (empty($images[0]->file_path)) {
        $image_path = "images/pomme-de-terre.webp";
    } else {
        $image_path = $images[0]->file_path;
    }
        //$image_path = "images/pomme-de-terre.webp";
    ?>
    <div class="container" style="margin-top: 7rem">
    <p class="text-sm md:text-md lg:text-lg font-medium">Djassa > {{ ($rayon->title != null) ? $rayon->title : "Rayon" }} > {{ ($category->title != null) ? $category->title : "categorie" }} > {{ $product->title }}</p>
        <div class="row" style="margin-top:3%; margin-bottom:5%;">
            <div class="col-md-7" style="display:flex; justify-content:center">
                <img src="{{ asset($image_path) }}" alt="" style="width:480px; height:360px; object-fit:cover;">
            </div>
            <div class="col-md-5" style="margin-top:5%">
                <div class="card shadow-sm" style="border-radius:15px;display:flex; align-items:center; padding:1.5rem">
                    <div class="card-body">
                        <form  method="POST" action="{{ route('panier.store') }}">
                            @csrf
                                <input type="hidden" id="id" name="id" value="{{ $product->id }}">
                            <p class="py-1 mt-2" style="font-weight:700;font-size:18px">{{ $product->title }}</p>
                            <?php
                                if($product->discount != null &&  $product->discount > 0) 
                                {
                            ?>
                                <p class="py-3" style="font-weight:700;font-size:18px">{{ $product->discount_price() }} FCFA<span style="margin-left:5.8rem">Qté:&nbsp;<input id="quantity" name="quantity" type="number" value="1" min="1" style="width:5rem"></span></p>
                            
                                <p class="py-3" style="font-weight:600;font-size:14px">au lieu de {{ $product->price; }} FCFA</p>
                            <?php
                                } else {
                            ?>
                                    <p class="py-3" style="font-weight:700;font-size:18px">{{ $product->price }} FCFA<span style="margin-left:5.8rem">Qté:&nbsp;<input id="quantity" name="quantity" type="number" value="1" min="1" style="width:5rem"></span></p>
                            <?php    
                                }
                            ?>
                            <button type="submit" id="addcart" class="bg-[#ec6333] text-[#fff] py-3 px-16 rounded font-extrabold text-base text-center">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active font-semibold text-sm md:text-lg lg-text-xl text-[#1A1A1A]" id="principales_caracteristiques-tab" data-bs-toggle="tab" data-bs-target="#principales_caracteristiques" type="button" role="tab" aria-controls="principales_caracteristiques" aria-selected="true">Principales caractéristiques</button>
            </li>
            @if($product->valeur_nutritionnelle == 1) 
                <li class="nav-item" role="presentation">
                    <button class="nav-link font-semibold text-sm md:text-lg lg-text-xl text-[#1A1A1A]" id="valeurs_nutritionnelles-tab" data-bs-toggle="tab" data-bs-target="#valeurs_nutritionnelles" type="button" role="tab" aria-controls="valeurs_nutritionnelles" aria-selected="false">Valeurs nutritionnelles</button>
                </li>
            @endif
            <li class="nav-item" role="presentation">
                <button class="nav-link font-semibold text-sm md:text-lg lg-text-xl text-[#1A1A1A]" id="autres_indications-tab" data-bs-toggle="tab" data-bs-target="#autres_indications" type="button" role="tab" aria-controls="autres_indications" aria-selected="false">Autres indications</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="margin-bottom:2rem">
            <div class="tab-pane fade show active" id="principales_caracteristiques" role="tabpanel" aria-labelledby="principales_caracteristiques-tab" style="margin-top:3%">
                @if($product->marque != "") 
                    <h3 style="font-weight:700;font-size:18px">
                        Marque & labels 
                        <span style="font-weight:400;font-size:17PX; margin-left:6.5%">{{ $product->marque }}</span>
                    </h3>
                @endif
                @if($product->composition != "") 
                    <h3 style="font-weight:700;font-size:18px; margin-top:2rem">
                        Propriétés 
                        <span style="font-weight:400;font-size:17PX; margin-left:10.4%">{{ $product->composition }}</span>
                    </h3>
                @endif
                @if($product->pays_production != "") 
                    <h3 style="font-weight:700;font-size:18px; margin-top:2rem">
                        Pays de production 
                        <span style="font-weight:400;font-size:17PX; margin-left:4.7%">{{ $product->pays_production }}</span>
                    </h3>
                @endif
                @if($product->conservation != "") 
                    <h3 style="font-weight:700;font-size:18px; margin-top:2rem">
                        Conservation
                        <span style="font-weight:400;font-size:17PX; margin-left:8.5%">{{ $product->conservation }}</span>
                    </h3>
                @endif
                @if($product->emballage != "") 
                    <h3 style="font-weight:700;font-size:18px; margin-top:2rem">
                        Emballage 
                        <span style="font-weight:400;font-size:17PX; margin-left:10%">{{ $product->emballage }}</span>
                    </h3>
                @endif
            </div>

            @if($product->valeur_nutritionnelle == 1) 
                <div class="tab-pane fade" id="valeurs_nutritionnelles" role="tabpanel" aria-labelledby="valeurs_nutritionnelles-tab" style="margin-top:3%"> 
                    <ul>
                        @if($product->sodium != "") 
                            <li style="display:inline">
                                <span style="font-weight:700;font-size:18px">Sodium</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->sodium }}</span>
                            </li>
                        @endif
                        @if($product->potassium != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Potassium</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->potassium }}</span>
                            </li>
                        @endif
                        @if($product->magnesium != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Magnesium</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->magnesium }}</span>
                            </li>
                        @endif
                        @if($product->fluorure != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Fluorure</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->fluorure }}</span>
                            </li>
                        @endif
                    </ul>
                    <ul style="margin-top:2%">
                        @if($product->silicium_siO2 != "") 
                            <li style="display:inline">
                                <span style="font-weight:700;font-size:18px">Silicium_siO2</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->silicium_siO2 }}</span>
                            </li>
                        @endif
                        @if($product->cendres != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Cendres</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->cendres }}</span>
                            </li>
                        @endif
                        @if($product->bicarbonate != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Bicarbonate</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->bicarbonate }}</span>
                            </li>
                        @endif
                        @if($product->sels_minéraux_totaux_sels_minéraux != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Sels minéraux totaux et sels minéraux</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->sels_minéraux_totaux_sels_minéraux }}</span>
                            </li>
                        @endif
                    </ul>
                    <ul style="margin-top:2%">
                        @if($product->nitrate != "") 
                            <li style="display:inline">
                                <span style="font-weight:700;font-size:18px">Nitrate</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->nitrate }}</span>
                            </li>
                        @endif
                        @if($product->strontium != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Strontium</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->strontium }}</span>
                            </li>
                        @endif
                        @if($product->sulfate != "") 
                            <li style="display:inline; margin-left:3%">
                                <span style="font-weight:700;font-size:18px">Sulfate</span>
                                <span style="font-weight:400;font-size:17PX; margin-left:2%">{{ $product->sulfate }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif

            <div class="tab-pane fade" id="autres_indications" role="tabpanel" aria-labelledby="autres_indications-tab" style="margin-top:3%">
                
                @if($product->designation_legale != "") 
                    <p>
                    <span style="font-weight:700;font-size:18px">Désignation légale</span>
                    <span style="font-weight:400;font-size:17PX; margin-left:6.5%">{{ $product->designation_legale }}</span>
                    </p>
                @endif
                @if($product->distributeur != "") 
                    <p style="margin-top:2rem">
                    <span style="font-weight:700;font-size:18px; margin-top:2rem">Distributeur</span>
                    <span style="font-weight:400;font-size:17PX; margin-left:10.8%">{{ $product->distributeur }}</span>
                    </p> 
                @endif
                @if($product->duree_conservation != "") 
                    <p style="margin-top:2rem">
                    <span style="font-weight:700;font-size:18px; margin-top:2rem">Duree de conservation</span>
                    <span style="font-weight:400;font-size:17PX; margin-left:4%">{{ $product->duree_conservation }}</span>
                    </p> 
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
