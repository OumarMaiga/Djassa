<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
            <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                ADMINISTRATEURS
            </h3>
            <a href="{{ route('dashboard.admin.create') }}" style="display: inline-block; float: right; padding-top:1rem;"><x-button class="btn-custom">AJOUTER</x-button></a>

            @if($admins)
            <table class="table table-hover table-responsive" style="margin-top: 2rem">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($admins as $admin)
                    <?php 
                        $n = $n + 1;
                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <?php
                                    if($admin->etat == "disabled") {
                                        echo "<b style=color:red>Inactif</b>";
                                    } elseif($admin->etat == "enabled") {
                                        echo "<b style=color:green>Actif</b>";
                                    } elseif($admin->etat == "blocked") {
                                        echo "<b style=color:red>Bloqué</b>";
                                    }
                                ?>        
                            </td>
                            <td>
                                <a href="{{ route('dashboard.admin.edit', $admin->id) }}" title="Modifier">
                                    <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                                </a>
                                <a href="{{ route('dashboard.admin.blocked', $admin->id) }}" title="Bloquer">
                                    <ion-icon name="remove-circle-outline" style="font-size:24px; color:red;"></ion-icon>
                                </a>
                                <a href="{{ route('dashboard.admin.unblocked', $admin->id) }}" title="Débloquer">
                                    <ion-icon name="arrow-up-circle-outline" style="font-size:24px; color:green;"></ion-icon>
                                </a>
                                <form method="POST" action="{{ route('dashboard.admin.destroy', $admin->id) }}" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                        <button class="" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette admin ?')">
                                            <ion-icon name="trash-outline" style="font-size:24px; color:red;"></ion-icon>
                                        </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <span class="card-title center-align">Aucun utilisateur enrégistré</span>
            @endif      
            <div id="loader" class="hide">
                <div class="loader"></div>
            </div>
        </div>
    </div>
</x-app-layout>