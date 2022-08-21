<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px">
                Vente du mois de <?= custom_month_year(date('m/d/Y')) ?>
            </h3>
            <div id="wrapper">          
            @if($sells)
            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Code</th>
                    <th scope="col">Produits</th>
                    <th scope="col">Montant du</th>
                    <th scope="col">Montant payer</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $n = 0;
                        $cumul_montant_du = 0;
                        $cumul_montant_payer = 0;    
                    ?>
                    @foreach ($sells as $sell)
                    <?php 
                        $n = $n + 1;
                        $cumul_montant_du = $cumul_montant_du + $sell->commande_montant_du;
                        $cumul_montant_payer = $cumul_montant_payer + $sell->commande_montant_payer;  
                        $commande_products = DB::select("SELECT products.title as product_title, products.slug as product_slug,
                                                        products.id as product_id FROM products LEFT JOIN commande_product
                                                        ON products.id = commande_product.product_id WHERE commande_product.commande_id = $sell->commande_id");

                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ "$sell->commande_firstname $sell->commande_lastname" }}</td>
                            <td>{{ $sell->commande_telephone }}</td>
                            <td>{{ $sell->commande_code }}</td>
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
                            <td>{{ ($sell->commande_montant_du != NULL) ? $sell->commande_montant_du : 0 }}</td>
                            <td>{{ ($sell->commande_montant_payer != NULL) ? $sell->commande_montant_payer : 0 }}</td>
                            <td>{!! $sell->commande_delivered ? "<b style=color:green>Livré</b>" : "<b style=color:red>Non livré</b>" !!}</td>
                            <td>
                                <a href="{{ route('dashboard.commande.show', $sell->commande_code) }}" style="display:inline-block; margin-right:0.75rem" title="Voir">
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
        </div>
        </div>
    </div>
</x-app-layout>