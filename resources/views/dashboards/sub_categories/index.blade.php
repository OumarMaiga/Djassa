<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <div class="row" style="margin-bottom: 2rem">
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
                LES SOUS-CATEGORIES
            </h3>
            <a href="{{ route('dashboard.sub_category.create') }}" style="display: inline-block; float: right; padding-top:1rem;"><x-button class="btn-custom">AJOUTER</x-button></a>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Rayon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($sub_categories as $sub_category)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $sub_category->sub_category_title }}</td>
                            <td>{{ $sub_category->category_title }}</td>
                            <td>{{ $sub_category->rayon_title }}</td>
                            <td class="justify-content-between icon-content">
                                <!-- <a href="{{ route('dashboard.sub_category.show', $sub_category->sub_category_id) }}">Voir</a> -->
                                <a href="{{ route('dashboard.sub_category.edit', $sub_category->sub_category_id) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem" title="Modifier">
                                    <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                                </a>
                                <span class="col icon-action" style="display:inline-block">
                                    <form method="POST" action="{{ route('dashboard.sub_category.destroy', $sub_category->sub_category_id) }}">
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
</x-app-layout>