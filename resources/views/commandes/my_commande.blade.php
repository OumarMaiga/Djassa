<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                MES COMMANDES
            </h3>
            <div id="wrapper">          
            @if($commandes)
            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Code</th>
                    <th scope="col">Produits</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Montant dû</th>
                    <th scope="col">Montant payer</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($commandes as $commande)
                    <?php 
                        $n = $n + 1;
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
                            <td>{{ $commande->user_name }}</td>
                            <td>{{ $commande->commande_montant_du }}</td>
                            <td>{{ $commande->commande_montant_payer }}</td>
                            <td>{!! $commande->commande_delivered ? "<b style=color:green>Livré</b>" : "<b style=color:red>Non livré</b>" !!}</td>
                            <td>
                                @if($commande->commande_paid)
                                    <b style=color:green>Solder</b>
                                @else
                                    <a href="{{ route('commande.create_paiement', $commande->commande_id) }}">Payer</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <span class="card-title center-align">La liste de vos commande est vide</span>
            @endif
            </div>        
            <div id="loader" class="hide">
                <div class="loader"></div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>