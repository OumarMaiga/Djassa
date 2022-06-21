<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <div class="content-title">{{ __('AJOUT DE PRODUCT') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.product.store') }}" enctype="multipart/form-data">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="title" required />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="overview">Description</label>
                        <textarea id="overview" class="form-control" name="overview" placeholder="overview" ></textarea>
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="price">Prix</label>
                        <input id="price" class="form-control" type="text" name="price" value="{{ old('price') }}" placeholder="price" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="quantity">quantité</label>
                        <input id="quantity" class="form-control" type="text" name="quantity" value="{{ old('quantity') }}" placeholder="quantity" />
                    </div>
                </div>
                
                <div class="row">
                    <!-- Email Address -->
                    <div class="form-item col-md-6">
                        <label for="rayon_id">Rayon</label>
                        <select name="rayon_id" id="rayon_id">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($rayons as $rayon)
                                <option value="{{ $rayon->id }}">{{ $rayon->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Email Address -->
                    <div class="form-item col-md-6" id="category_id_container">
                        <label for="category_id">Categorie</label>
                        <select name="category_id" id="category_id">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Email Address -->
                    <div class="form-item col-md-6" id="sub_category_id_container">
                        <label for="sub_category_id">Sous-categorie</label>
                        <select name="sub_category_id" id="sub_category_id">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Email Address -->
                    <div class="form-item col-md-6" id="sub_sub_category_id_container">
                        <label for="sub_sub_category_id">Sous-sous-Categorie</label>
                        <select name="sub_sub_category_id" id="sub_sub_category_id">
                            <option value="">-- SELECTIONNEZ ICI --</option>
                            @foreach($sub_sub_categories as $sub_sub_category)
                                <option value="{{ $sub_sub_category->id }}">{{ $sub_sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row">
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

    <script>
        jQuery(document).ready(function(){
            jQuery('#rayon_id').change(function(e){
                e.preventDefault();
                var id = document.getElementById('rayon_id').value;
                if (id == "") {
                    var category_id_container = $('#category_id_container');
                    category_id_container.hide();
                    var category_id = $('#category_id');
                    category_id.empty();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "/dashboard/rayon/" +id + "/categories",
                    method: 'get',
                    success: function(result){
                        var data = result['categories'];
                        var category_id = $('#category_id');
                        category_id.empty();
                        category_id.append(
                            '<option value="">-- SELECTIONNEZ ICI --</option>'
                        )
                        for (var i = 0; i < data.length; i++) {
                            category_id.append(
                                '<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>'
                            );
                        }
                        var category_id_container = $('#category_id_container');
                        category_id_container.show();
                   }
                });
            });
            
            jQuery('#category_id').change(function(e){
                e.preventDefault();
                var id = document.getElementById('category_id').value;
                if (id == "") {
                    var sub_category_id_container = $('#sub_category_id_container');
                    sub_category_id_container.hide();
                    var sub_category_id = $('#sub_category_id');
                    sub_category_id.empty();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "/dashboard/category/" +id + "/sub_categories",
                    method: 'get',
                    success: function(result){
                        var data = result['sub_categories'];
                        var sub_category_id = $('#sub_category_id');
                        sub_category_id.empty();
                        sub_category_id.append(
                            '<option value="">-- SELECTIONNEZ ICI --</option>'
                        )
                        for (var i = 0; i < data.length; i++) {
                            sub_category_id.append(
                                '<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>'
                            );
                        }
                        var sub_category_id_container = $('#sub_category_id_container');
                        sub_category_id_container.show();
                   }
                });
            });
            
            jQuery('#sub_category_id').change(function(e){
                e.preventDefault();
                var id = document.getElementById('sub_category_id').value;
                if (id == "") {
                    var sub_sub_category_id_container = $('#sub_sub_category_id_container');
                    sub_sub_category_id_container.hide();
                    var sub_sub_category_id = $('#sub_sub_category_id');
                    sub_sub_category_id.empty();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "/dashboard/sub_category/" +id + "/sub_sub_categories",
                    method: 'get',
                    success: function(result){
                        var data = result['sub_sub_categories'];
                        var sub_sub_category_id = $('#sub_sub_category_id');
                        sub_sub_category_id.empty();
                        sub_sub_category_id.append(
                            '<option value="">-- SELECTIONNEZ ICI --</option>'
                        )
                        for (var i = 0; i < data.length; i++) {
                            sub_sub_category_id.append(
                                '<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>'
                            );
                        }
                        var sub_sub_category_id_container = $('#sub_sub_category_id_container');
                        sub_sub_category_id_container.show();
                   }
                });
            });
        });

    </script>
</x-app-layout>
