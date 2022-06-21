<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <h1 class="content-title" style="margin-bottom:2rem; padding-top:1rem; font-weight:500; font-size:20px">{{ __('REMPLISSEZ LE FORMULAIRE POUR SOUMETTRE UNE DEMANDE') }}</h1>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('service.store') }}">
                @csrf

                
    
                <!-- Email Address -->
                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <!-- Title -->
                        <div>
                            <x-label for="title" :value="__('Titre')" />
                            <x-input id="title" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        
                    </div>
                </div>
                
                <div class="row mb-4">
                    <h3>Bénéficiaire</h3><br>
                    <div class="form-item col-md-6">
                        <!-- recipient -->
                        <div>
                            <x-label for="recipient" :value="__('Nom et prénom')" />
                            <x-input id="recipient" class="form-control" type="text" name="name" :value="old('name')" required />
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        <!-- recipient's number -->
                        <div>
                            <x-label for="phonenumber" :value="__('Contact')" />
                            <x-input id="phonenumber" class="form-control" type="number" name="name" :value="old('name')" required />
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="form-item col-md-6">
                        <!-- Montant -->
                        <div>
                            <x-label for="montant" :value="__('Montant')" />
                            <x-input id="montant" class="form-control" type="number" name="name" :value="old('name')" required />
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        <!-- deadline -->
                        <div>
                            <x-label for="deadline" :value="__('Date limite')" />
                            <x-input id="deadline" class="form-control" type="date" name="name" :value="old('name')" required />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-item">
                        <!-- Description -->
                        <div>
                            <label for="overview">Description</label>
                            <textarea id="overview" class="form-control" name="overview" placeholder="Décrivez votre besoin" rows="6"></textarea>
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
