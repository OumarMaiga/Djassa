<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <h2>Profile</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover table-responsive" style="margin-top: 2rem">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="justify-content-between icon-content">
                        <a href="{{ route('user.edit', $user->id) }}" class="col icon-action icon-edit" style="display:inline-block; margin-right:0.75rem" title="Modifier">
                            <ion-icon name="create-outline" style="font-size:24px;"></ion-icon>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
