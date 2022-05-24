<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
            <div class="card">        
            <div class="card-content">
                <div id="wrapper">          
                @if($recettes)
                <table class="table table-hover table-responsive-md">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Code</th>
                        <th scope="col">Produits</th>
                        <th scope="col">Payer</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($recettes as $recette)
                        <?php 
                            $n = $n + 1;
                            $commande_products = DB::select("SELECT products.title as product_title, products.slug as product_slug,
                                                            products.id as product_id FROM products LEFT JOIN commande_product
                                                            ON products.id = commande_product.product_id WHERE commande_product.commande_id = $recette->commande_id");

                        ?>
                            <tr>
                                <th scope="row">{{ $n }}</th>
                                <td>{{ "$recette->commande_firstname $recette->commande_lastname" }}</td>
                                <td>{{ $recette->commande_telephone }}</td>
                                <td>{{ $recette->commande_code }}</td>
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
                                <td>{!! $recette->commande_paid ? "<b style=color:green>Oui</b>" : "<b style=color:red>Non</b>" !!}</td>
                                <td>{!! $recette->commande_delivered ? "<b style=color:green>Livré</b>" : "<b style=color:red>Non livré</b>" !!}</td>
                                <td><a href="{{ route('commande.show', $recette->commande_id) }}">Voir</a></td>
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
        </div>
    </div>
</x-app-layout>