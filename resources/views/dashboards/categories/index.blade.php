<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <div class="row" style="margin-bottom: 2rem">
                <div class="col-4 mt-3">
                    <a href="{{ route('dashboard.sub_category.index') }}">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <center>
                                    <div class="mt-2"><ion-icon name="file-tray-stacked-outline" style="font-size:32px"></ion-icon></div>
                                    <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:16px"">
                                        SOUS-CATÉGORIE
                                    </h2>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4 mt-3">
                    <a href="{{ route('dashboard.sub_sub_category.index') }}">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <center>
                                    <div class="mt-2"><ion-icon name="file-tray-stacked-outline" style="font-size:32px"></ion-icon></div>
                                    <h2 class="mb-2" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:16px"">
                                        SOUS SOUS-CATÉGORIE
                                    </h2>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                LES CATEGORIES
            </h3>
            <a href="{{ route('dashboard.category.create') }}" style="display: inline-block; float: right; padding-top:1rem;"><x-button class="btn-custom">AJOUTER</x-button></a>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="table-responsive w-full">
                <table class="table table-hover" style="margin-top: 2rem">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Rayon</th>
                            <th scope="col" style="min-width:140px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($categories as $category)
                        <?php $n = $n + 1 ?>
                            <tr>
                                <th scope="row">{{ $n }}</th>
                                <td>{{ $category->category_title }}</td>
                                <td>{{ $category->rayon_title }}</td>
                                <td class="justify-content-between icon-content">
                                    <!-- <a href="{{ route('dashboard.category.show', $category->category_slug) }}">Voir</a> -->
                                    <a href="{{ route('dashboard.category.edit', $category->category_slug) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem" title="Modifier">
                                        <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                                    </a>
                                    <span class="col icon-action" style="display:inline-block">
                                        <form method="POST" action="{{ route('dashboard.category.destroy', $category->category_slug) }}">
                                            @csrf
                                            @method('delete')
                                                <button class="" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')" title="Supprimer">
                                                    <ion-icon name="trash-outline" style="font-size:24px; color:red;"></ion-icon>
                                                </button>
                                        </form>
                                    </span>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>