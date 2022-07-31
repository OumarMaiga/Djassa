<x-app-layout>

    <div class="container" style="margin-top:6.5rem">
        <div class="row">
        
            <div class="col-4 mt-3">
                <a href="{{ route('dashboard.product.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <center>
                                <div class="mt-2"><ion-icon name="cube-outline" style="font-size:36px"></ion-icon></div>
                                <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                                    PRODUITS
                                </h2>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="col-4 mt-3">
                <a href="http://127.0.0.1:8000/dashboard/recettes">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <center>
                                <div class="mt-2"><ion-icon name="cash-outline" style="font-size:36px"></ion-icon></div>
                                <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                                    RECETTES
                                </h2>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="{{ route('dashboard.admin.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <center>
                                <div class="mt-2"><ion-icon name="people-outline" style="font-size:36px"></ion-icon></div>
                                <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                                    ADMINISTRATEURS
                                </h2>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="{{ route('dashboard.user.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <center>
                                <div class="mt-2"><ion-icon name="people-outline" style="font-size:36px"></ion-icon></div>
                                <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                                    UTILISATEURS
                                </h2>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="{{ route('dashboard.rayon.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <center>
                                <div class="mt-2"><ion-icon name="file-tray-stacked-outline" style="font-size:36px"></ion-icon></div>
                                <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                                    RAYONS
                                </h2>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</x-app-layout>

