<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                RECETTES
            </h3>
            <div id="wrapper">          
            @if($recettes)
            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Commande</th>
                        <th scope="col">Service</th>
                        <th scope="col">Moyen de paiement</th>
                        <th scope="col">Methode de paiement</th>
                        <th scope="col">Operation ID</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Devise</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 0;
                        $cumul_montant = 0;
                    ?>
                    @foreach ($recettes as $recette)
                    <?php 
                        $n = $n + 1;
                        $cumul_montant = $cumul_montant + $recette->montant;
                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>
                                @if($recette->commande_id != NULL)
                                    <a href="{{ route('user.show', $recette->user_id) }}">{{ $recette->user_name }}</a>
                                @endif
                            </td>
                            <td>
                                @if($recette->commande_id != NULL)
                                    <a href="{{ route('dashboard.commande.show', $recette->commande_code) }}">{{ $recette->commande_code }}</a></td>
                                @endif
                                <td>
                                @if($recette->service_id != NULL)
                                    <a href="{{ route('dashboard.service.show', $recette->service_slug) }}">{{ $recette->service_title }}</a>
                                @endif
                            </td>
                            <td>{{ $recette->paiement_from }}</td>
                            <td>{{ $recette->payment_method }}</td>
                            <td>{{ $recette->operator_id }}</td>
                            <td>{{ $recette->montant }}</td>
                            <td>{{ $recette->currency }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <th scope="row" colspan="7">Total</th>
                            <td colspan="2"><b>{{ $cumul_montant }} F CFA</b></td>
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
    </div>
</x-app-layout>