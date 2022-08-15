<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <h2>{{ $user->name }}</h2>
        <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
            LES CATEGORIES
        </h3>
        <a href="{{ route('dashboard.category.create') }}" style="display: inline-block; float: right; padding-top:1rem;"><x-button class="btn-custom">AJOUTER</x-button></a>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover table-responsive" style="margin-top: 2rem">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telephone</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0 ?>
                <?php $n = $n + 1 ?>
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ $user->category_title }}</td>
                        <td>{{ $user->rayon_title }}</td>
                        <td class="justify-content-between icon-content">
                            <a href="{{ route('profile.edit', $user->category_id) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem" title="Modifier">
                                <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                            </a>
                            
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
