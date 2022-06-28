<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <ul>
            <li>
                <a href="{{ route('dashboard.rayon.index') }}">Rayon</a>
            </li>
            <li>
                <a href="{{ route('dashboard.category.index') }}">Categories</a>
            </li>
            <li>
                <a href="{{ route('dashboard.sub_category.index') }}">Sous-categories</a>
            </li>
            <li>
                <a href="{{ route('dashboard.sub_sub_category.index') }}">Sous-sous-categories</a>
            </li>
        </ul>
    </div>
</x-app-layout>
