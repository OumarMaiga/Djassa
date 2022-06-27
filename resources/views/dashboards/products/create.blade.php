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
    
                <!-- Email Address -->
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <x-label for="title" :value="__('Nom du produit')" />
                        <x-input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" required autofocus />
                    </div>
                    <div class="form-item col-md-6">
                        
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item">
                        <!-- Description -->
                        <div>
                            <label for="overview">Description</label>
                            <textarea id="overview" class="form-control" name="overview" placeholder="Décrivez votre besoin" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-item col-md-6">
                        <x-label for="price" :value="__('Entrer le prix')" />
                        <x-input id="price" class="form-control" type="text" name="price" value="{{ old('price') }}" required />
                    </div>
                    <div class="form-item col-md-6">
                        <x-label for="quantity" :value="__('Nombre disponible en stock')" />
                        <x-input id="quantity" class="form-control" type="number" name="quantity" value="{{ old('quantity') }}" required />
                    </div>
                </div>
                
                <div class="row" style="margin-top: 0.75rem">
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
                
                <div class="row" style="margin-top: 0.75rem">
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
                    <div class="form-item col-md-6" id="sub_sub_category_id_container">
                        <label for="sub_sub_category_id">Sous-sous-Categorie</label>
                        <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_sub_categories as $sub_sub_category)
                                <option value="{{ $sub_sub_category->id }}">{{ $sub_sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row" style="margin-top: 0.75rem">
                    <div class="form-item col-md-6">
                        <label for="product_image">Ajouter l'image du product</label>
                        <input id="product_image" class="form-control" type="file" name="product_image[]" value="" placeholder="" multiple/>
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
