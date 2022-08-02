<x-app-layout>
    <div class="dashboard-content" style="margin-top: 6rem">
        <div class="container content">
            <div style="margin-bottom:1rem">
            <span class="mr-2" style="float: left; display: inline-block; padding-top:0.5rem; cursor: pointer;" id="go-back"><ion-icon name="return-up-back-outline" style="font-size:36px;"></ion-icon></span>
            <h3 class="mb-3" style="display: inline-block; padding-top:1rem; font-weight:500; font-size:20px"">
                {{ __('AJOUTER UNE CATÉGORIE') }}
            </h3>
        </div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('dashboard.category.store') }}">
                @csrf
    
                <div class="row">
                    <div class="form-item col-md-6">
                        <!-- Category -->
                        <div>
                            <x-label for="category" :value="__('Entrer une nouvelle catégorie')" />
                            <x-input id="category" class="form-control" type="text" name="title" value="{{ old('title') }}" required autofocus />
                        </div>
                    </div>
                </div>
                
                <div class="row" style="margin-top: 0.75rem">
                    <div class="form-item col-md-6">
                        <select name="rayon_id" class="form-control">
                            <option value="">-- SELECTIONNEZ UN RAYON --</option>
                            @foreach($rayons as $rayon)
                                <option value="{{ $rayon->id }}">{{ $rayon->title }}</option>
                            @endforeach
                        </select>
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
