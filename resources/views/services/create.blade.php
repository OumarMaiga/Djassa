<x-app-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('DEMANDE DE SERVICE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('service.store') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="title" required />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="overview">Description</label>
                        <textarea id="overview" class="form-control" name="overview" placeholder="overview" ></textarea>
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="email" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="telephone">Telephone</label>
                        <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="telephone" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="montant">Montant</label>
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ old('montant') }}" placeholder="montant" />
                    </div>
                </div>
    
                <div class="mt-4">
                    <button type="submit" class="">
                        {{ __('DEMANDER') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
