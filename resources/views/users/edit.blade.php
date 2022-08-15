<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <h1 class="content-title" style="margin-bottom:2rem; padding-top:1rem; font-weight:500; font-size:20px">{{ __('REMPLISSEZ LE FORMULAIRE POUR SOUMETTRE UNE DEMANDE') }}</h1>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('put')
    
                <!-- Email Address -->
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <!-- Title -->
                        <div>
                            <x-label for="title" :value="__('Name')" />
                            <x-input id="title" class="form-control" type="text" name="title"  value="{{ $user->name }}" required autofocus />
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        
                    </div>
                </div>
                

                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <!-- Montant -->
                        <div>
                            <x-label for="email" :value="__('Email')" />
                            <x-input id="email" class="form-control" type="email" name="email"  value="{{ $user->email }}" />
                        </div>
                    </div>
                    <div class="form-item col-md-6">
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