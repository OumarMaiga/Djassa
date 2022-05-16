<x-app-layout>
    <div class="container">
        <div class="row">
        <div class="col s12">
            <div class="card">        
            <div class="card-content">
                <div id="wrapper">          
                @if($total)
                    <span class="card-title">Mon panier</span>            
                    @foreach ($content as $item)
                    <hr><br>
                    <div class="row">
                        <form action="{{ route('panier.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col m6 s12">{{ $item->name }}</div>
                        <div class="col m3 s12"><strong>{{ $item->quantity * $item->price }} FCFA</strong></div>
                        <div class="col m2 s12">
                            <input name="quantity" type="number" style="height: 2rem" min="1" value="{{ $item->quantity }}">
                        </div>
                        </form>
                        <form action="{{ route('panier.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="col m1 s12"><i class="material-icons deleteItem" style="cursor: pointer">delete</i></div>
                        </form>              
                    </div>
                    @endforeach
                    <hr><br>
                    <div class="row" style="background-color: lightgrey">
                    <div class="col s6">
                        Total TTC (hors livraison)
                    </div>
                    <div class="col s6">
                        <strong>{{ $total }} FCFA</strong>
                    </div>
                    </div>
                @else
                <span class="card-title center-align">Le panier est vide</span>
                @endif
                </div>        
                <div id="loader" class="hide">
                <div class="loader"></div>
                </div>
            </div>
            <div id="action" class="card-action">
                <p>
                <a  href="{{ route('products') }}">Continuer mes achats</a>
                @if($total)
                <form  method="POST" action="{{ route('commande.store') }}">
                    @csrf
                    <div class="row">
                        <div class="form-item col-md-6">
                            <label for="firstname">Prenom</label>
                            <input id="firstname" class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Prenom" />
                        </div>
                        <div class="form-item col-md-6">
                            <label for="lastname">Nom</label>
                            <input id="lastname" class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Nom" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-item col-md-6">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                        </div>
                        <div class="form-item col-md-6">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="Telephone" />
                        </div>
                    </div>
                        <button class="" type="submit">
                            Commander
                        </button>
                    </form>
                @endif
                </p>
            </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const quantities = document.querySelectorAll('input[name="quantity"]');
        quantities.forEach( input => {
            input.addEventListener('input', e => {
            if(e.target.value < 1) {
                e.target.value = 1;
            } else {
                e.target.parentNode.parentNode.submit();
                document.querySelector('#wrapper').classList.add('hide');
                document.querySelector('#action').classList.add('hide');
                document.querySelector('#loader').classList.remove('hide');
            }
            });
        }); 
        const deletes = document.querySelectorAll('.deleteItem');
        deletes.forEach( icon => {
            icon.addEventListener('click', e => {
            e.target.parentNode.parentNode.submit();
            document.querySelector('#wrapper').classList.add('hide');
            document.querySelector('#loader').classList.remove('hide');
            });
        }); 
        });
        
    </script>