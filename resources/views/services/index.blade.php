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
                
                @foreach($services as $service)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                {{ $service->service_title}}
                            </div>
                            <div class="card-body">
                                <!-- <h5 class="card-title">Special title treatment</h5> -->
                                <p class="card-text">{{ $service->service_overview }}</p><br>
                                <a href="{{ route('service.show', $service->service_id) }}" class="btn" style="background-color: #ec8333; color: #fff">Voir les détails</a>
                            </div>
                            <div class="card-footer text-muted">
                                Prend fin le {{ custom_date($service->service_expire) }}
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>