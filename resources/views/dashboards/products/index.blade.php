<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3 d-flex align-items-center ">
                    LES PRODUCTS
                    <a href="{{ route('dashboard.product.create') }}" class="ml-auto"><button class="btn-custom">AJOUTER</button></a>
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive-md">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantités</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($products as $product)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->overview }}</td>
                            <td>{{ $product->email }}</td>
                            <td>{{ $product->telephone }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('dashboard.product.show', $product->id) }}">Voir</a>
                                <a href="{{ route('dashboard.product.edit', $product->id) }}" class="col icon-action icon-edit">
                                    Edit
                                </a>
                                <span class="col icon-action">
                                    <form method="POST" action="{{ route('dashboard.product.destroy', $product->id) }}">
                                        @csrf
                                        @method('delete')
                                            <button class="" type="submit" onclick="return confirm('Vraiment supprimer ce product ?')">
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