<x-app-layout>
    @include('layouts.sidebar')

    <div class="p-2 ml-4 md:p-4 lg:p-4 md:ml-72 mt-24" id="container">
        
        <h2 style="margin-top:2%; margin-bottom:1rem; font-size:30px; font-weight:600">{{ $sub_category->title }}</h2>
        
        <!-- Cards -->
        <div class="row gx-1" style="margin-bottom:3%">
            <div id="products-container">
                @foreach ($sub_sub_categories as $sub_sub_category)
                <div class="col-3 mb-3">
                    <div class="card shadow-sm" style="width:17rem">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-8">
                        <!--<img src="{{ asset('images/vegetables01.jpeg') }}" class="img-responsive" style="width:100%; height:6em" alt="...">-->
                        </div>
                    </div>
                        
                        <div class="card-body" style="width:17rem">
                            <p class="" style="font-weight:700; font-size:18px;">
                                <a href="{{ route('product_per_sub_sub_category', [$category->slug, $sub_category->slug, $sub_sub_category->slug]) }}">{{ $sub_sub_category->title }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="ml-4 md:ml-72">
        <h2 style="margin-top:1%; margin-bottom:1rem; font-size:24px; font-weight:600; color:#ec6333;">Tous les produits</h2>
            <div class="row" style="margin-right:1rem">
                @include('layouts.products-list')
            </div>
        </div>

        <x-footer></x-footer>
    </div>
</x-app-layout>
