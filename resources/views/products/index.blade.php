<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3 d-flex align-items-center ">
                    LES PRODUCTS
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantités</th>
                        <th scope="col" style="min-width:140px">Action</th>
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
                                    <span>
                                        <form  method="POST" action="{{ route('panier.store') }}">
                                            @csrf
                                                <input type="hidden" id="id" name="id" value="{{ $product->slug }}">
                                                <input id="quantity" name="quantity" type="number" value="1" min="1">
                                                <label for="quantity">Quantité</label>        
                                                <p>
                                                    <button class="" style="width:100%" type="submit" id="addcart">
                                                        Ajouter au panier
                                                    </button>
                                                </p>
                                        </form>
                                    </span>
                                    <a href="{{ route('product.destroy', $product->slug) }}">Del_panier</a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>