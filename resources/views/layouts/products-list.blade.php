    @foreach ($products as $product) 
        <div class="col-2 mt-4">
            <div class="card shadow-sm">
                <a href="{{ route('product.detail', $product->product_id) }}" class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%; cursor:pointer">Voir l'offre</a>
                <img src="{{ asset($product->files_file_path) }}" class="img-responsive mx-3" style="margin-bottom:10%;height:75px;object-fit:cover;" alt="...">
                <div class="card-body">
                    @if($product->product_discount != null &&  $product->product_discount > 0)
                    <p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">-{{ $product->product_discount }}%</p>
                    @endif
                    <p class="item-offre-title" style="font-size:13px; font-weight:600">{{$product->product_title }}</p>
                </div>
            </div>
        </div>
    @endforeach
