<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3 d-flex align-items-center ">
                    LES CATEGORIES
                    <a href="{{ route('category.create') }}" class="ml-auto"><button class="btn-custom">AJOUTER</button></a>
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive-md">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($categories as $category)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $category->title }}</td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('category.show', $category->id) }}">Voir</a>
                                <a href="{{ route('category.edit', $category->id) }}" class="col icon-action icon-edit">
                                    Edit
                                </a>
                                <span class="col icon-action">
                                    <form method="POST" action="{{ route('category.destroy', $category->id) }}">
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