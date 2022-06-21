<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                    MES DEMANDES DE SERVICE
            </h3>
            <a href="{{ route('service.create') }}" style="display: inline-block; float: right; padding-top:1rem;"><x-button class="btn-custom">AJOUTER</x-button></a>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="row" style="margin-top: 2rem">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Titre du service
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><br>
                            <a href="#" class="btn" style="background-color: #ec8333; color: #fff">Voir les détails</a>
                        </div>
                        <div class="card-footer text-muted">
                            Prend fin le 17 juillet 2022
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Titre du service
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><br>
                            <a href="#" class="btn" style="background-color: #ec8333; color: #fff">Voir les détails</a>
                        </div>
                        <div class="card-footer text-muted">
                            Prend fin le 17 juillet 2022
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                <div class="card">
                        <div class="card-header">
                            Titre du service
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><br>
                            <a href="#" class="btn" style="background-color: #ec8333; color: #fff">Voir les détails</a>
                        </div>
                        <div class="card-footer text-muted">
                            Prend fin le 17 juillet 2022
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>