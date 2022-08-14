<x-app-layout>
    <div class="" style="margin-top: 6rem">
        <div class="container">
        <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                UTILISATEURS
            </h3>
            @if($users)
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
                    @foreach ($users as $user)
                    <?php 
                        $n = $n + 1;
                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <?php
                                    if($user->etat == "disabled") {
                                        echo "<b style=color:red>Inactif</b>";
                                    } elseif($user->etat == "enabled") {
                                        echo "<b style=color:green>Actif</b>";
                                    } elseif($user->etat == "blocked") {
                                        echo "<b style=color:red>Bloqué</b>";
                                    }
                                ?>        
                            </td>
                            <td>
                                <a href="{{ route('dashboard.user.blocked', $user->id) }}" title="Bloquer">
                                    <ion-icon name="remove-circle-outline" style="font-size:24px; color:red;"></ion-icon>
                                </a>
                                <a href="{{ route('dashboard.user.unblocked', $user->id) }}" title="Débloquer">
                                    <ion-icon name="arrow-up-circle-outline" style="font-size:24px; color:green;"></ion-icon>
                                </a>                            
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