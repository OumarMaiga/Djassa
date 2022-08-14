<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px">
                Service en cours
            </h3>
            <div id="wrapper">          
            @if($services)
            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Beneficiare</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Date de fin</th>
                    <!--<th scope="col">Payer</th>-->
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $n = 0;
                        $cumul_montant = 0;
                    ?>
                    @foreach ($services as $service)
                    <?php
                        $n = $n + 1;
                        $cumul_montant = $cumul_montant + $service->service_montant;
                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $service->service_beneficiaire }}</td>
                            <td>{{ $service->service_title }}</td>
                            <td>{{ $service->service_user_name }}</td>
                            <td>{{ ($service->service_montant != NULL) ? $service->service_montant : 0 }}</td>
                            <td>{{ custom_date($service->service_expire) }}</td>
                            <!--<td>{!! $service->service_paid ? "<b style=color:green>Oui</b>" : "<b style=color:red>Non</b>" !!}</td>-->
                            <td>
                            <?php
                                if($service->service_etat == "request") {
                                    echo "<b style=color:red>Demande initiée</b>";
                                } elseif($service->service_etat == "inprogress") {
                                    echo "<b style=color:orange>En cours de traitement ...</b>";
                                } elseif($service->service_etat == "done") {
                                    echo "<b style=color:green>Terminer</b>";
                                }
                            ?>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.service.show', $service->service_id) }}" style="display:inline-block; margin-right:0.75rem" title="Voir">
                                    <ion-icon name="eye-outline" style="font-size:24px;"></ion-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" colspan="4">Total</th>
                        <td colspan="5"><b>{{ $cumul_montant }}</b></td>
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