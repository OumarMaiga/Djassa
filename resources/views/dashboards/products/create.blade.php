<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
        <h1 class="content-title" style="margin-bottom:2rem; padding-top:1rem; font-weight:500; font-size:20px">{{ __('AJOUTER UN PRODUIT') }}</h1>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.product.store') }}" enctype="multipart/form-data">
                @csrf
    
                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Info du product</h1>
                <!-- Email Address -->
                <div class="row mb-4">
                    <div class="form-item col-md-12">
                        <label for="title">Nom du produit</label>
                        <x-input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}"  autofocus />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-12">
                        <!-- Description -->
                        <div>
                            <label for="overview">Description</label>
                            <x-textarea id="overview" class="form-control" name="overview" placeholder="Décrivez votre besoin" rows="6" :value="__('')"></x-textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row  mb-4">
                    <div class="form-item col-md-6">
                        <label for="poids">Poids</label>
                        <x-input id="poids" class="form-control" type="number" name="poids" value="{{ old('poids') }}" step="0.1" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="litre">Litre</label>
                        <x-input id="litre" class="form-control" type="number" name="litre" value="{{ old('litre') }}" step="0.1" />
                    </div>
                </div>
                
                <div class="row  mb-4">
                    <div class="form-item col-md-6">
                        <label for="price">Entrer le prix</label>
                        <x-input id="price" class="form-control" type="number" name="price" value="{{ old('price') }}" step="5" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="quantity">Nombre disponible en stock</label>
                        <x-input id="quantity" class="form-control" type="number" name="quantity" value="{{ old('quantity') }}"  />
                    </div>
                </div>
                
                <div class="row  mb-4">
                    <div class="form-item col-md-6">
                        <label for="discount">Reduction</label>
                        <x-input id="discount" class="form-control" type="number" name="discount" value="{{ old('discount') }}" placeholder="" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="product_image">Ajouter l'image du product</label>
                        <x-input id="product_image" class="form-control" type="file" name="product_image[]" value="" multiple/>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="rayon_id">Rayon</label>
                        <select name="rayon_id" id="rayon_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($rayons as $rayon)
                                <option value="{{ $rayon->id }}">{{ $rayon->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Catégorie -->
                    <div class="form-item col-md-6" id="category_id_container">
                        <label for="category_id">Categorie</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <!-- Sous catégorie -->
                    <div class="form-item col-md-6" id="sub_category_id_container">
                        <label for="sub_category_id">Sous-categorie</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Sous sous catégorie -->
                    <div class="form-item col-md-6 mb-4" id="sub_sub_category_id_container">
                        <label for="sub_sub_category_id">Sous-sous-Categorie</label>
                        <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_sub_categories as $sub_sub_category)
                                <option value="{{ $sub_sub_category->id }}">{{ $sub_sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    
                
                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Pricipales carateristiques</h1>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="marque">Marque</label>
                        <x-input id="marque" class="form-control" type="text" name="marque" value="{{ old('marque') }}"  />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="composition">Composition</label>
                        <x-textarea id="composition" class="form-control" type="text" name="composition" value="" >{{ old('composition') }}</x-textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="emballage">Emballage</label>
                        <x-input id="emballage" class="form-control" type="text" name="emballage" value="{{ old('emballage') }}"  />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="pays_production">Pays de production</label>
                        <x-input id="pays_production" class="form-control" type="text" name="pays_production" value="{{ old('pays_production') }}"  />
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="conservation">Conservation</label>
                        <x-input id="conservation" class="form-control" type="text" name="conservation" value="{{ old('conservation') }}"  />
                    </div>
                </div>
                                
                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Valeurs nutritionnelles</h1>
                <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="valeur_nutritionnelle">Ajouter des valeurs nutritionnelles</label>
                        <x-input id="valeur_nutritionnelle" class="form-control" type="checkbox" name="valeur_nutritionnelle" value="1" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="sodium">Sodium (mg)</label>
                        <x-input id="sodium" class="form-control" type="number" name="sodium" value="{{ old('sodium') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="potassium">Potassium</label>
                        <x-input id="potassium" class="form-control" type="number" name="potassium" value="{{ old('potassium') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="magnesium">Magnésium</label>
                        <x-input id="magnesium" class="form-control" type="number" name="magnesium" value="{{ old('magnesium') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="fluorure">Fluorure</label>
                        <x-input id="fluorure" class="form-control" type="number" name="fluorure" value="{{ old('fluorure') }}" step="0.01" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="silicium_siO2">Silicium SiO2</label>
                        <x-input id="silicium_siO2" class="form-control" type="number" name="silicium_siO2" value="{{ old('silicium_siO2') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="cendres">Cendres</label>
                        <x-input id="cendres" class="form-control" type="number" name="cendres" value="{{ old('cendres') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="bicarbonate">Bicarbonate</label>
                        <x-input id="bicarbonate" class="form-control" type="number" name="bicarbonate" value="{{ old('bicarbonate') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="sels_minéraux_totaux_sels_minéraux">Sels minéraux totaux / sels minéraux</label>
                        <x-input id="sels_minéraux_totaux_sels_minéraux" class="form-control" type="number" name="sels_minéraux_totaux_sels_minéraux" value="{{ old('sels_minéraux_totaux_sels_minéraux') }}" step="0.01" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-3">
                        <label for="nitrate">Nitrate</label>
                        <x-input id="nitrate" class="form-control" type="number" name="nitrate" value="{{ old('nitrate') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="strontium">Strontium</label>
                        <x-input id="strontium" class="form-control" type="number" name="strontium" value="{{ old('strontium') }}" step="0.01" />
                    </div>
                    <div class="form-item col-md-3">
                        <label for="sulfate">Sulfate</label>
                        <x-input id="sulfate" class="form-control" type="number" name="sulfate" value="{{ old('sulfate') }}" step="0.01" />
                    </div>
                </div>

                <h3 class="content-title" style="margin-bottom:1rem; padding-top:2rem; font-weight:500; font-size:20px">Autres indications</h1>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="designation_legale">Designation légale</label>
                        <x-input id="designation_legale" class="form-control" type="text" name="designation_legale" value="{{ old('designation_legale') }}"  />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="distributeur">Distributeur</label>
                        <x-input id="distributeur" class="form-control" type="text" name="distributeur" value="{{ old('distributeur') }}"  />
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <label for="duree_conservation">Durée de conservation</label>
                        <x-input id="duree_conservation" class="form-control" type="text" name="duree_conservation" value="{{ old('duree_conservation') }}"  />
                    </div>
                </div>

                <div class="mt-4">
                    <x-button type="submit" class="">
                        {{ __('AJOUTER') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
