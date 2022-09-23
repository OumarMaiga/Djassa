<x-app-layout>
 
    <section style="height:100%; margin-top:6.5rem" class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7">
                @if($total)
                <h5 class="mb-3">
                    <a href="{{ route('welcome') }}" style="font-size:18px; font-weight:600">
                        <i class="fas fa-long-arrow-alt-left me-2"></i>Continuer mes achats
                    </a>
                </h5>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="mb-1">Mon panier</p>
                        <p class="mb-0">Vous avez {{ count($content) }} article(s) dans votre panier</p>
                    </div>
                    <div>
                        <p class="mb-0"><span class="text-muted">Trier:</span> <a href="#!"
                            class="text-body">prix <i class="fas fa-angle-down mt-1"></i></a></p>
                    </div>
                </div>
                @foreach ($content as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="row w-full">
                                <form action="{{ route('panier.update', $item->id) }}" method="POST" class="d-flex flex-row align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-2" style="display:inline-block">
                                        <img
                                            src="{{ asset($item->attributes->image) }}"
                                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                    </div>
                                    <div class="col-7 ms-3">
                                        <h5>{{ $item->name }}</h5>
                                    </div>
                                    <div class="col-2">
                                        <input name="quantity" type="number" style="height: 2rem; width: 4rem" min="1" value="{{ $item->quantity }}">
                                        <span class="">{{ $item->quantity * $item->price }} F</span>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <form action="{{ route('panier.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <div style="color: #d9402b;"><i class="fas fa-trash-alt deleteItem" style="cursor: pointer"></i></div>
                                </form>  
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @else
                <span class="card-title center-align">Le panier est vide</span>
                @endif
                <a  href="{{ route('welcome') }}" style="margin-top:1rem; display:block; color:#ec6333">Continuer mes achats</a>
            </div>
            <div class="col-lg-5">
                <div class="card text-gray-900 rounded-3" style="background-color:#F6F6F6">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0" style="font-size:20px; font-weight:600">Poursuivre ma commande</h5>
                        </div>

                        <p class="small mb-3" style="font-size:16px; font-weight:600">Moyens de paiement disponible</p>
                        <a href="#!" type="submit" class="text-gray-900"><i
                            class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                        <a href="#!" type="submit" class="text-gray-900"><i
                            class="fab fa-cc-visa fa-2x me-2"></i></a>
                        <a href="#!" type="submit" class="text-gray-900"><i
                            class="fab fa-cc-amex fa-2x me-2"></i></a>
                        <a href="#!" type="submit" class="text-gray-900"><i class="fab fa-cc-paypal fa-2x"></i></a>

                        @if($total)
                            <form  method="POST" action="{{ route('commande.store') }}" style="margin-top:2.5rem">
                                @csrf
                                <div class="form-outline form-white mb-4">
                                    <input id="firstname" class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Prenom" required />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input id="lastname" class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Nom" required />
                                </div>

                                <!-- <div class="form-outline form-white mb-4">
                                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                                </div> -->

                                <div class="form-outline form-white mb-4">
                                    <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="Telephone" required />
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Sous-total</p>
                                    <p class="mb-2">{{ $total }} FCFA</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Livraison</p>
                                    <p class="mb-2">1000 FCFA</p>
                                </div>

                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-2" style="font-weight:600">Total(taxes incluses)</p>
                                    <p class="mb-2" style="font-weight:600">{{ $total + 1000 }} FCFA</p>
                                    <input type="hidden" name="montant_du" id="montant_du" value="{{ $total + 1000 }}">
                                </div>

                                <button type="submit" class="btn btn-block btn-lg" style="background-color:#ec6333">
                                    <div class="d-flex justify-content-between">
                                        <span style="font-weight:600; color:#fff">COMMANDER <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                    </div>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
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