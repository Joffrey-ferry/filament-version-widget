<x-filament-widgets::widget class="fi-filament-info-widget">
    @php
        $data = $this->getDeploymentData();
    @endphp

    <x-filament::section>
        <div class="fi-filament-info-widget-main">
            <div class="flex items-center gap-x-4">
                <div class="flex-1">
                    <a href="{{ config('app.url') }}" target="_blank" class="text-sm font-bold tracking-tight text-gray-950 dark:text-white hover:underline">
                        {{ config('app.name') }}
                    </a>
                    
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Environnement : <span class="font-mono {{ $data['env'] === 'production' ? 'text-danger-600' : 'text-success-600' }}">{{ $data['env'] }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="fi-filament-info-widget-links space-y-1 border-t border-gray-100 dark:border-white/5">
            
            {{-- Ligne Déploiement --}}
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center gap-x-2 text-gray-500">
                    <x-filament::icon
                        icon="heroicon-m-calendar-days"
                        class="h-4 w-4 text-gray-400"
                    />
                    <span>Déploiement :</span>
                </div>
                <span class="font-medium text-gray-700 dark:text-gray-300">{{ $data['date'] }}</span>
            </div>
            
            {{-- Ligne Release --}}
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center gap-x-2 text-gray-500">
                    <x-filament::icon
                        icon="heroicon-m-tag"
                        class="h-4 w-4 text-gray-400"
                    />
                    <span>Release :</span>
                </div>
                <span class="font-mono bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded text-primary-600 dark:text-primary-400">
                    {{ $data['release'] }}
                </span>
            </div>
            
        </div>
    </x-filament::section>
</x-filament-widgets::widget>