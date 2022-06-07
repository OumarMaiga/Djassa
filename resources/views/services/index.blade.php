<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <h3 class="mb-3 d-flex align-items-center ">
                    LES SERVICES DEMANDES
                    <a href="{{ route('service.create') }}" class="ml-auto"><button class="btn-custom">AJOUTER</button></a>
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
                    <th scope="col">Montant</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($services as $service)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->overview }}</td>
                            <td>{{ $service->email }}</td>
                            <td>{{ $service->telephone }}</td>
                            <td>{{ $service->montant }}</td>
                            <td>{{ $service->etat }}</td>
                            <td class="justify-content-between icon-content">
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
                                @if ($service->etat === "request")
                                    <a href="{{ route('service.inprogress', $service->id) }}">In proccess</a>
                                @endif
                                @if ($service->etat === "inprogress")
                                    <!--<a href="{{ route('service.done', $service->id) }}">Done</a>-->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>