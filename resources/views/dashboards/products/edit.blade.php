<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
        <div style="margin-bottom:0.5rem">
            <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                {{ __('MODIFICATION DU PRODUIT') }}
            </h3>
        </div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
    
                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Info du product</h1>
                <!-- Email Address -->
                <div class="row mb-4">
                    <div class="form-item col-md-12">
                        <label for="title">Nom du produit</label>
                        <x-input id="title" class="form-control" type="text" name="title" value="{{ $product->title }}"  autofocus />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-12">
                        <!-- Description -->
                        <div>
                            <label for="overview">Description</label>
                            <textarea id="overview" class="form-control" name="overview" placeholder="Décrivez votre besoin" rows="6" >{{ $product->title}}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row  mb-4">
                    <div class="form-item col-md-6">
                        <label for="poids">Poids</label>
                        <x-input id="poids" class="form-control" type="number" name="poids" value="{{ $product->poids }}" step="0.1" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="litre">Litre</label>
                        <x-input id="litre" class="form-control" type="number" name="litre" value="{{ $product->litre }}" step="0.1" />
                    </div>
                </div>
                
                <div class="row  mb-4">
                    <div class="form-item col-md-6">
                        <label for="price">Entrer le prix</label>
                        <x-input id="price" class="form-control" type="number" name="price" value="{{ $product->price }}" step="5" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="quantity">Nombre disponible en stock</label>
                        <x-input id="quantity" class="form-control" type="number" name="quantity" value="{{ $product->quantity }}"  />
                    </div>
                </div>
                
                <div class="row  mb-4">
                    <div class="form-item col-md-6">
                        <label for="discount">Reduction</label>
                        <x-input id="discount" class="form-control" type="number" name="discount" value="{{ $product->discount }}" placeholder="" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="product_image">Ajouter l'image du product</label>
                        <x-input id="product_image" class="form-control" type="file" name="product_image[]" value="" multiple/>
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Email Address -->
                    <div class="form-item col-md-6">
                        <label for="rayon_id">Rayon</label>
                        <select name="rayon_id" id="rayon_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($rayons as $rayon)
                                <option value="{{ $rayon->id }}" <?= ($rayon->id == $product->rayon_id) ? "selected=true" : "" ?>>{{ $rayon->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Email Address -->
                    <div class="form-item col-md-6">
                        <label for="category_id">Categorie</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" <?= ($category->id == $product->category_id) ? "selected=true" : "" ?>>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <!-- Email Address -->
                    <div class="form-item col-md-6">
                        <label for="sub_category_id">Sous-categorie</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}" <?= ($sub_category->id == $product->sub_category_id) ? "selected=true" : "" ?>>{{ $sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Email Address -->
                    <div class="form-item col-md-6">
                        <label for="sub_sub_category_id">Sous-sous-Categorie</label>
                        <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_sub_categories as $sub_sub_category)
                                <option value="{{ $sub_sub_category->id }}" <?= ($sub_sub_category->id == $product->sub_sub_category_id) ? "selected=true" : "" ?>>{{ $sub_sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                
                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Pricipales carateristiques</h1>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="marque">Marque</label>
                        <x-input id="marque" class="form-control" type="text" name="marque" value="{{ $product->marque }}"  />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="composition">Composition</label>
                        <textarea id="composition" class="form-control" type="text" name="composition">{{ $product->composition }}</textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="emballage">Emballage</label>
                        <x-input id="emballage" class="form-control" type="text" name="emballage" value="{{ $product->emballage }}"  />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="pays_production">Pays de production</label>
                        <x-input id="pays_production" class="form-control" type="text" name="pays_production" value="{{ $product->pays_production }}"  />
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="conservation">Conservation</label>
                        <x-input id="conservation" class="form-control" type="text" name="conservation" value="{{ $product->conservation }}"  />
                    </div>
                </div>
                                
                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Valeurs nutritionnelles</h1>
                    <div class="row mb-4">
                        <div class="form-item col-md-3">
                            <label for="valeur_nutritionnelle">Ajouter des valeurs nutritionnelles</label>
                            <input id="valeur_nutritionnelle" class="form-control" type="checkbox" name="valeur_nutritionnelle" value="1" <?= $product->valeur_nutritionnelle == 1 ? "checked" : ""  ?>/>
                        </div>
                    </div>
                    <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="sodium">Sodium (mg)</label>
                        <x-input id="sodium" class="form-control" type="number" name="sodium" value="{{ $product->sodium }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="potassium">Potassium</label>
                        <x-input id="potassium" class="form-control" type="number" name="potassium" value="{{ $product->potassium }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="magnesium">Magnésium</label>
                        <x-input id="magnesium" class="form-control" type="number" name="magnesium" value="{{ $product->magnesium }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="fluorure">Fluorure</label>
                        <x-input id="fluorure" class="form-control" type="number" name="fluorure" value="{{ $product->fluorure }}" step="0.01" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="silicium_siO2">Silicium SiO2</label>
                        <x-input id="silicium_siO2" class="form-control" type="number" name="silicium_siO2" value="{{ $product->silicium_siO2 }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="cendres">Cendres</label>
                        <x-input id="cendres" class="form-control" type="number" name="cendres" value="{{ $product->cendres }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="bicarbonate">Bicarbonate</label>
                        <x-input id="bicarbonate" class="form-control" type="number" name="bicarbonate" value="{{ $product->bicarbonate }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="sels_minéraux_totaux_sels_minéraux">Sels minéraux totaux / sels minéraux</label>
                        <x-input id="sels_minéraux_totaux_sels_minéraux" class="form-control" type="number" name="sels_minéraux_totaux_sels_minéraux" value="{{ $product->sels_minéraux_totaux_sels_minéraux }}" step="0.01" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="nitrate">Nitrate</label>
                        <x-input id="nitrate" class="form-control" type="number" name="nitrate" value="{{ $product->nitrate }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="strontium">Strontium</label>
                        <x-input id="strontium" class="form-control" type="number" name="strontium" value="{{ $product->strontium }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="sulfate">Sulfate</label>
                        <x-input id="sulfate" class="form-control" type="number" name="sulfate" value="{{ $product->sulfate }}" step="0.01" />
                    </div>
                </div>

                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Autres indications</h1>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="designation_legale">Designation légale</label>
                        <x-input id="designation_legale" class="form-control" type="text" name="designation_legale" value="{{ $product->designation_legale }}"  />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="distributeur">Distributeur</label>
                        <x-input id="distributeur" class="form-control" type="text" name="distributeur" value="{{ $product->distributeur }}"  />
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="duree_conservation">Durée de conservation</label>
                        <x-input id="duree_conservation" class="form-control" type="text" name="duree_conservation" value="{{ $product->duree_conservation }}"  />
                    </div>
                </div>

                <div class="mt-4">
                    <x-button type="submit" class="">
                        {{ __('MODIFIER') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
