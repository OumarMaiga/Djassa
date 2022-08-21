<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <div style="margin-bottom:2rem">
                <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
                <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                    {{ __('MODIFIER UN RAYON') }}
                </h3>
            </div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.rayon.update', $rayon->slug) }}">
                @csrf
                @method('put')
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <!-- Rayon -->
                        <div>
                            <x-label for="rayon" :value="__('Entrer un nouveau rayon')" />
                            <x-input id="rayon" class="form-control" type="text" name="title" value="{{ $rayon->title }}" />
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <x-button type="submit" class="">
                        {{ __('MODIFIER') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
