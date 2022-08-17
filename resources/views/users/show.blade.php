<x-app-layout>
    
    <div class="container" style="margin-top: 6rem">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
        <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
            Mon profil
        </h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="font-size:19px; font-weight:600;">
                        <p style="float:left;">Informations personnelles</p>
                        <div style="float:right;">
                            <a href="{{ route('user.edit', $user->id) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem" title="Modifier">
                                <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="margin-bottom:2rem;">
                            <div style="display:inline-block; margin-right:3rem;">
                                <h4 style="font-weight:600; margin-bottom:0.5rem;">Nom & Prénom</h4>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div style="display:inline-block; margin-right:0.75rem;">
                                <h4 style="font-weight:600;; margin-bottom:0.5rem;">Email</h4>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
