<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size:20px; font-weight:600;">
                    {{ $service->title }}
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
                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                    <div>
                        <p class="card-text" style="font-size:18px;display:inline-block;margin-right:2rem;">Etat &nbsp;<span class="btn btn-secondary">{{ $service->etat }}</span></p> 
                        <p class="card-text" style="font-size:18px;display:inline-block;">Montant:&nbsp;<span style="font-size:18px; font-weight:600;">{{ $service->montant }} FCFA</span></p> 
                    </div>

                    <div style="margin-top: 2rem">
                        <p style="font-size:18px; font-weight:600;margin-bottom:1rem;">Bénéficiaire</p>
                        <div style="display:inline-block;">
                            <p style="font-size:16px; font-weight:600;margin-bottom:O.5rem;">Nom & Prénom</p>
                            <p style="display:inline-block;margin-right:2rem;">{{ $service->user }}Damien ursule</p>
                        </div>
                        <div style="display:inline-block;">
                            <p style="font-size:16px; font-weight:600;margin-bottom:O.5rem;">Téléphone</p>
                            <p style="display:inline-block;margin-right:2rem;">{{ $service->telephone }}</p>
                        </div>
                    </div>
                    
                    <div style="margin-top: 2rem">
                        <p style="font-size:18px; font-weight:600;">Description du service</p>
                        <p>{{ $service->overview }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="justify-content-between icon-content">
                
                @if ($service->etat === "request")
                    <a href="{{ route('service.inprogress', $service->id) }}">In proccess</a>
                @endif
            </div>
        </div>

        @if ($service->etat === "inprogress")
        <div class="row">
            <h2>Valider le service</h2>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('service.done', $service->id) }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="proof">Fiche justificatif</label>
                    <input type="file" name="proof" id="proof" />
                </div>
                <button type="submit" class="">
                    Terminer
                </button>
            </form>
        </div>
        @endif

        
        @if ($service->etat === "done")
        <div class="row">
            <h2>Voir le justificatif</h2>
            <a target="_blank" href="{{ $file->file_path }}">Voir</a>
        </div>
        @endif
    </div>
</x-app-layout>
