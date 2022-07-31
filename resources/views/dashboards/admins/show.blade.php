<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <h2>{{ $admin->name }}</h2>
        
        <form method="POST" action="{{ route('dashboard.admin.destroy', $admin->id) }}">
            @csrf
            @method('delete')
            <button class="text-red-600" type="submit" onclick="return confirm('Vraiment supprimer ce admin ?')">
                Supprimer
            </button>
        </form>
    </div>
</x-app-layout>
