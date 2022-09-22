    @foreach ($products as $product) 
        <div class="col-md-6 col-lg-2 mt-4">
            <div class="card shadow-sm">
                <a href="{{ route('product.detail', $product->product_slug) }}" class="py-2 mt-2 mx-3 bg-[#F6F6F6] text-center rounded font-bold mb-[8%] md:mb-[20%] lg:mb-[20%] cursor-pointer">Voir l'offre</a>
                <img src="{{ asset($product->files_file_path) }}" class="img-responsive mx-3 mb-[4%] md:mb-[10%] lg:mb-[10%] h-44 md:h-20 lg:h-20 object-cover" alt="...">
                <div class="card-body">
                    @if($product->product_discount != null &&  $product->product_discount > 0)
                    <p class="px-2 bg-[#ec6333] text-center md:text-left lg:text-left font-extrabold text-sm text-[#fff] mx-auto w-[20%] md:w-[40%] lg:w-[40%]">-{{ $product->product_discount }}%</p>
                    @endif
                    <p class="item-offre-title text-center md:text-left lg:text-left text-lg md:text-sm lg:text-sm font-semibold">{{$product->product_title }}</p>
                </div>
            </div>
        </div>
    @endforeach
