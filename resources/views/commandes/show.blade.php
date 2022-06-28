<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                ETAT DE LA COMMANDE
            </h3>
            <div class="col-6 mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <b>Commande: </b>{{ $commande->commande_code }}
                            </div>
                            <div class="col-6 mb-3">
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
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3"><b>De la part de: </b>{{ $commande->user_name }}</div>
                            <div class="col-6 mb-3">
                                <b>Pour: </b>{{ "$commande->commande_firstname $commande->commande_lastname" }}
                            </div>
                        </div>
                        <div class="mb-3"><b>Livré: </b>{!! $commande->commande_delivered ? "<b style=color:green>Oui</b>" : "<b style=color:red>Non</b>" !!}</div>

                        @if($commande->commande_delivered != 1)
                            <div class="mb-3"><i><a href="{{ route('delivered', $commande->commande_id) }}">Marqué comme livré</a></i></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
