<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
            <div class="">
                <span class="underline font-bold">
                    Titre:
                </span>
                <span>
                    {{ $service->title }}
                </span>
            </div>
            <div class="">
                <span class="underline font-bold">
                    Description:
                </span>
                <span>
                    {{ $service->overview }}
                </span>
            </div>
            <div class="">
                <span class="underline font-bold">
                    Etat:
                </span>
                <span>
                    {{ $service->etat }}
                </span>
            </div>
            <div class="">
                <span class="underline font-bold">
                    Montant:
                </span>
                <span>
                    {{ $service->montant }}
                </span>
            </div>
            <div class="">
                <span class="underline font-bold">
                    Utilisateur:
                </span>
                <span>
                    {{ $service->user }}
                </span>
            </div>
            <div class="">
                <span class="underline font-bold">
                    Email:
                </span>
                <span>
                    {{ $service->email }}
                </span>
            </div>
            <div class="">
                <span class="underline font-bold">
                    Telephone:
                </span>
                <span>
                    {{ $service->telephone }}
                </span>
            </div>
            <div class="justify-content-between icon-content">
                <a href="{{ route('service.show', $service->id) }}">Voir</a>
                <a href="{{ route('service.edit', $service->id) }}" class="col icon-action icon-edit">
                    Edit
                </a>
                <span class="col icon-action">
                    <form method="POST" action="{{ route('service.destroy', $service->id) }}">
                        @csrf
                        @method('delete')
                            <button class="" type="submit" onclick="return confirm('Vraiment supprimer ce service ?')">
                                Del
                            </button>
                    </form>
                </span>
            </div>
        </div>
        
    </div>
</x-app-layout>
