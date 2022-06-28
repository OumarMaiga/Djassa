<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
            <div class="">
                <b>Commande: </b>{{ $commande->commande_code }}
            </div>
            <div class="">
                <b>Pour: </b>{{ "$commande->commande_firstname $commande->commande_lastname" }}
            </div>
            <div class="">
                <b>Produit </b><?php 
                $commande_products = DB::select("SELECT products.title as product_title, products.slug as product_slug,
                                                products.id as product_id FROM products LEFT JOIN commande_product
                                                ON products.id = commande_product.product_id WHERE commande_product.commande_id = $commande->commande_id");
                $x = 0;
                foreach ($commande_products as $commande_product) {
                    echo $x > 0 ? ", " : "";
                    echo $commande_product->product_title;
                    $x++;
                }
                ?>
            </div>
            <div><b>L'utilisateur: </b>{{ $commande->user_name }}</div>
            <div><b>Livré: </b>{!! $commande->commande_delivered ? "<b style=color:green>Oui</b>" : "<b style=color:red>Non</b>" !!}</div>
            
            @if($commande->commande_delivered != 1)
                <div><i><a href="{{ route('delivered', $commande->commande_id) }}">Marqué comme livré</a></i></div>
            @endif

        </div>
    </div>
</x-app-layout>
