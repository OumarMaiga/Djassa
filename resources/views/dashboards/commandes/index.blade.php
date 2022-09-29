<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px">
                Commande en cours
            </h3>
            <div id="wrapper">          
            @if($commandes)
            <div class="table-responsive">
            <table class="table table-hover" style="margin-top: 0.5rem">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Code</th>
                    <th scope="col">Produits</th>
                    <th scope="col">Montant du</th>
                    <th scope="col">Montant payer</th>
                    <!--<th scope="col">Etat</th>-->
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $n = 0;
                        $cumul_montant_du = 0;
                        $cumul_montant_payer = 0;   
                    ?>
                    @foreach ($commandes as $commande)
                    <?php
                        $n = $n + 1;
                        $cumul_montant_du = $cumul_montant_du + $commande->commande_montant_du;
                        $cumul_montant_payer = $cumul_montant_payer + $commande->commande_montant_payer;  
                        $commande_products = DB::select("SELECT products.title as product_title, products.slug as product_slug,
                                                        products.id as product_id FROM products LEFT JOIN commande_product
                                                        ON products.id = commande_product.product_id WHERE commande_product.commande_id = $commande->commande_id");

                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ "$commande->commande_firstname $commande->commande_lastname" }}</td>
                            <td>{{ $commande->commande_telephone }}</td>
                            <td>{{ $commande->commande_code }}</td>
                            <td>
                                <?php 
                                $x = 0;
                                foreach ($commande_products as $commande_product) {
                                    echo $x > 0 ? ", " : "";
                                    echo $commande_product->product_title;
                                    $x++;
                                }
                                ?>
                            </td>
                            <td>{{ ($commande->commande_montant_du != NULL) ? $commande->commande_montant_du : 0 }}</td>
                            <td>{{ ($commande->commande_montant_payer != NULL) ? $commande->commande_montant_payer : 0 }}</td>
                            <!--<td>{!! $commande->commande_delivered ? "<b style=color:green>Livré</b>" : "<b style=color:red>Non livré</b>" !!}</td>-->
                            <td>
                                <a href="{{ route('dashboard.commande.show', $commande->commande_code) }}" style="display:inline-block; margin-right:0.75rem" title="Voir">
                                    <ion-icon name="eye-outline" style="font-size:24px;"></ion-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" colspan="5">Total</th>
                        <td><b>{{ $cumul_montant_du }}</b></td>
                        <td colspan="3"><b>{{ $cumul_montant_payer }}</b></td>
                    </tr>
                </tbody>
            </table>
            @else
            <span class="card-title center-align">Aucune vente pour ce mois</span>
            @endif
            </div>        
            <div id="loader" class="hide">
                <div class="loader"></div>
            </div>
            {{ $commandes->links() }}
        </div>
        </div>
    </div>
</x-app-layout>