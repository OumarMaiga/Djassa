<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <h2>{{ $user->name }}</h2>
        
        <form method="POST" action="{{ route('dashboard.user.destroy', $user->id) }}">
            @csrf
            @method('delete')
            <button class="text-red-600" type="submit" onclick="return confirm('Vraiment supprimer ce user ?')">
                Supprimer
            </button>
        </form>
    </div>
</x-app-layout>
