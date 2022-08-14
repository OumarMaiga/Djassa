<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="font-size:19px; font-weight:600;">
                        <p style="float:left;">{{ $service->title }}</p>
                        <div style="float:right;">
                            <a href="{{ route('service.edit', $service->id) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem" title="Modifier">
                                <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                            </a>
                            <span class="col icon-action" style="display:inline-block">
                                <form method="POST" action="{{ route('service.destroy', $service->id) }}">
                                    @csrf
                                    @method('delete')
                                        <button class="" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce service?')" title="Supprimer">
                                            <ion-icon name="trash-outline" style="font-size:24px; color:red;"></ion-icon>
                                        </button>
                                </form>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display:inline-block;margin-bottom:2rem;margin-right:1.5rem;">
                            <p class="" style="display:inline-block;font-weight:600;">Etat: &nbsp;</p><span class="btn btn-secondary" style="display:inline-block;">{{ $service->etat }}</span><br>
                        </div>
                        <div style="display:inline-block;margin-bottom:2rem;">
                            <p class="" style="display:inline-block;font-weight:600;">Montant: &nbsp;</p><span class="btn btn-secondary" style="display:inline-block;">{{ $service->montant }}</span><br>
                        </div>
                        
                        
                        <h3 style="font-size:18px; font-weight:600; margin-bottom:1rem;">Bénéficiaire</h3>
                        <div style="margin-bottom:2rem;">
                            <div style="display:inline-block; margin-right:3rem;">
                                <h4 style="font-weight:600;">Nom & Prénom</h4>
                                <p>{{ $service->user }} Ursule Idylle</p>
                            </div>
                            <div style="display:inline-block; margin-right:2rem;">
                                <h4 style="font-weight:600;">Contact</h4>
                                <p>{{ $service->telephone }}</p>
                                <p>{{ $service->email }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 style="font-size:18px; font-weight:600;">Description du service</h3>
                            <p>{{ $service->overview }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if ($service->etat === "inprogress")
            <div class="col-md-12" style="margin-top:3rem;">
                <div class="card">
                    <div class="card-header" style="font-size:19px; font-weight:600;">
                        <h2 style="float:left;">Valider le service</h2>
                    </div>
                    <div class="card-body">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
    
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('dashboard.service.done', $service->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div style="margin-bottom:2rem;">
                                <label for="proof" style="font-size:18px; font-weight:600; margin-bottom:1rem;">Fiche justificative</label>
                                <input type="file" name="proof" id="proof" class="form-control" />
                            </div>
                            <button type="submit" class="btn" style="background-color:#ec8333;color:white;">
                                Terminer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        
        @if ($service->etat === "done" && $file != null)
        <div class="row">
            <h2>Voir le justificatif</h2>
            <a target="_blank" href="{{ $file->file_path }}">Voir</a>
        </div>
        @endif
    </div>
</x-app-layout>
