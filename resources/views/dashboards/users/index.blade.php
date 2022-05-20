<x-app-layout>
    <div class="container" style="margin-top: 6rem">
        <div class="row">
        <div class="col s12">
            <div class="card">        
            <div class="card-content">
                <div id="wrapper">          
                @if($users)
                <table class="table table-hover table-responsive-md">
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
                                    <a href="{{ route('dashboard.user.blocked', $user->id) }}">Bloqué</a>
                                    <a href="{{ route('dashboard.user.unblocked', $user->id) }}">Debloqué</a>
                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="card-title center-align">La liste de vos commande est vide</span>
                @endif
                </div>        
                <div id="loader" class="hide">
                    <div class="loader"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>