<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <h1 class="content-title" style="margin-bottom:2rem; padding-top:1rem; font-weight:500; font-size:20px">{{ __('AJOUTER UN RAYON') }}</h1>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.rayon.store') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <!-- Rayon -->
                        <div>
                            <x-label for="rayon" :value="__('Entrer un nouveau rayon')" />
                            <x-input id="rayon" class="form-control" type="text" name="title" value="{{ old('title') }}" required autofocus />
                        </div>
                    </div>
                </div>
                    
                <div class="mt-4">
                    <x-button type="submit" class="">
                        {{ __('AJOUTER') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
