<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                PAIEMENT
            </h3>
            <div id="wrapper">          
            @if($commande)
                <table class="table table-hover table-responsive" style="margin-top: 2rem">
                    <thead>
                        <tr>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Code</th>
                        <th scope="col">Produits</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $commande->user_name }}</td>
                                <td>{{ $commande->code }}</td>
                                <td>
                                    <?php 
                                    $x = 0;
                                    foreach ($products as $product) {
                                        echo $x > 0 ? ", " : "";
                                        echo $product->product_title;
                                        $x++;
                                    }
                                    ?>
                                </td>
                                <td>{!! $commande->delivered ? "<b style=color:green>Livré</b>" : "<b style=color:red>Non livré</b>" !!}</td>
                                <td>
                                    @if($commande->paid)
                                        <b style=color:green>Solder</b>
                                    @else
                                        <a href="{{ route('commande.create_paiement', $commande->id) }}">Payer</a>
                                    @endif
                                </td>
                            </tr>
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
        <div class="row">
            
            <div class="col s12">
                <form method="POST" action="{{ route('commande.store_paiement', $commande->id) }}" id="paiement-form">
                    @csrf
                    <!-- Montant -->
                    <div class="row">
                        <div class="form-item col-md-4">
                            <label for="montant">Montant</label>
                            <input id="montant" class="form-control" type="text" name="montant" value="{{ $commande->montant_du }}" readonly />
                            <!--<input id="montant" class="form-control" type="text" name="montant" value="100" readonly />-->
                            <input id="commande_id" class="form-control" type="hidden" name="commande_id" value="{{ $commande->id }}" readonly />
                            <input id="customer_name" class="form-control" type="hidden" name="customer_name" value="Joe" readonly />
                            <input id="customer_surname" class="form-control" type="hidden" name="customer_surname" value="Down" readonly />
                            <input id="customer_email" class="form-control" type="hidden" name="customer_email" value="down@test.com" readonly />
                            <input id="customer_phone_number" class="form-control" type="hidden" name="customer_phone_number" value="088767611" readonly />
                            <input id="customer_address" class="form-control" type="hidden" name="customer_address" value="BP 0024" readonly />
                            <input id="customer_city" class="form-control" type="hidden" name="customer_city" value="Antananarivo" readonly />
                            <input id="customer_country" class="form-control" type="hidden" name="customer_country" value="CM" readonly />
                            <input id="customer_state" class="form-control" type="hidden" name="customer_state" value="CM" readonly />
                            <input id="customer_zip_code" class="form-control" type="hidden" name="customer_zip_code" value="06510" readonly />
                            
                            <x-button type="submit" class="mt-4">
                                {{ __('Payez') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>