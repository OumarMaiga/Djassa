<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <div class="content-title">{{ __('MODIFICATION DE PRODUCT') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ $product->title }}" placeholder="title" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="overview">Description</label>
                        <textarea id="overview" class="form-control" name="overview" placeholder="overview" >{{ $product->overview }}</textarea>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="price">Prix</label>
                        <input id="price" class="form-control" type="text" name="price" value="{{ $product->price }}" placeholder="price" required />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="quantity">quantité</label>
                        <input id="quantity" class="form-control" type="text" name="quantity" value="{{ $product->quantity }}" placeholder="quantity" required />
                    </div>
                </div>

                <div class="row">
                    <!-- Email Address -->
                    <div class="form-item col-md-6">
                        <select name="category_id">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" <?= ($category->id == $product->category_id) ? "selected=true" : "" ?>>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-item col-md-6">
                        <label for="product_image">Ajouter l'image du product</label>
                        <input id="product_image" class="form-control" type="file" name="product_image[]" value="" placeholder="" multiple/>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="">
                        {{ __('AJOUTER') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
