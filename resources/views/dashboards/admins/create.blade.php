<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <h1 class="content-title" style="margin-bottom:2rem; padding-top:1rem; font-weight:500; font-size:20px">{{ __('AJOUTER UNE CATÉGORIE') }}</h1>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.admin.store') }}">
                @csrf
    
                <div class="row">
                    <div class="form-item col-md-6">
                        <!-- Username -->
                        <div>
                            <label for="name">Nom d'utilisateur</label>
                            <x-input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        <!-- Email -->
                        <div>
                            <label for="email">Email</label>
                            <x-input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required />
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="form-item col-md-6">
                        <!-- Password -->
                        <div>
                            <label for="password">Mot de passe</label>
                            <x-input id="password" class="form-control" type="password" name="password" value="{{ old('password') }}" required />
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="form-item col-md-6">
                        <div>
                            <label for="password_confirmation">Confirmation de mot de passe</label>
            
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>
                    </div>
                </div>
                
                    
                <div class="mt-4">
                    <x-button type="submit" class="">
                        {{ __('SOUMETTRE') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
