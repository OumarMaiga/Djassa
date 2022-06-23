<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3 d-flex align-items-center ">
                    LES SOUS-SOUS-CATEGORIES
                    <a href="{{ route('dashboard.sub_sub_category.create') }}" class="ml-auto"><button class="btn-custom">AJOUTER</button></a>
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive-md">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Sous-categorie</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Rayon</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($sub_sub_categories as $sub_sub_category)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $sub_sub_category->sub_sub_category_title }}</td>
                            <td>{{ $sub_sub_category->sub_category_title }}</td>
                            <td>{{ $sub_sub_category->category_title }}</td>
                            <td>{{ $sub_sub_category->rayon_title }}</td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('dashboard.sub_sub_category.show', $sub_sub_category->sub_sub_category_id) }}">Voir</a>
                                <a href="{{ route('dashboard.sub_sub_category.edit', $sub_sub_category->sub_sub_category_id) }}" class="col icon-action icon-edit">
                                    Edit
                                </a>
                                <span class="col icon-action">
                                    <form method="POST" action="{{ route('dashboard.sub_sub_category.destroy', $sub_sub_category->sub_sub_category_id) }}">
                                        @csrf
                                        @method('delete')
                                            <button class="" type="submit" onclick="return confirm('Vraiment supprimer ce category ?')">
                                                Del
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