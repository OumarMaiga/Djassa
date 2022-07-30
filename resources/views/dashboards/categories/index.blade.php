<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                LES CATEGORIES
            </h3>
            <a href="{{ route('dashboard.category.create') }}" style="display: inline-block; float: right; padding-top:1rem;"><x-button class="btn-custom">AJOUTER</x-button></a>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Rayon</th>
                        <th scope="col">Action</th>
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
                                <!-- <a href="{{ route('dashboard.category.show', $category->category_id) }}">Voir</a> -->
                                <a href="{{ route('dashboard.category.edit', $category->category_id) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem">
                                    <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                                </a>
                                <span class="col icon-action" style="display:inline-block">
                                    <form method="POST" action="{{ route('dashboard.category.destroy', $category->category_id) }}">
                                        @csrf
                                        @method('delete')
                                            <button class="" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
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