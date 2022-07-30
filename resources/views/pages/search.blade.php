@include('layouts.sidebar')
<div style="margin-left:19rem; margin-top:6.5rem" id="container">
    <h2 style="margin-top:5%; margin-bottom:1.5rem; font-size:24px; font-weight:700">{{ count($products) }} resultat(s) pour {{ $query }}</h2>

    <div id="products-container" class="row" style="margin-right:1rem">
        @include('layouts.products-list')
    </div>
</div>