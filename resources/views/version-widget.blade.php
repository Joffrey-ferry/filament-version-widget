<x-filament-widgets::widget class="fi-filament-info-widget">
    @php
        $data = $this->getDeploymentData();
        $isProd = $data['env'] === 'production';
    @endphp

    <x-filament::section>
        {{-- Conteneur Principal avec un Hack CSS Inline pour le Responsive --}}
        <div class="deployment-widget-flex" style="display: flex; flex-wrap: wrap; gap: 20px;">
            
            {{-- BLOC 1 : HEADER (Gauche/Haut) --}}
            <div style="flex: 1; min-width: 200px;">
                {{-- Ligne 1 : Nom --}}
                <div style="margin-bottom: 8px;">
                    <a href="{{ config('app.url') }}" target="_blank" class="text-sm font-bold dark:text-white hover:underline" style="text-decoration: none;">
                        {{ config('app.name') }}
                    </a>
                </div>
                {{-- Ligne 2 : Icone + Badge --}}
                <div style="display: flex; align-items: center; gap: 8px;">
                    <x-filament::icon icon="heroicon-m-server" class="h-5 w-5 text-gray-400" />
                    <x-filament::badge :color="$isProd ? 'danger' : 'success'" size="sm">
                        {{ strtoupper($data['env']) }}
                    </x-filament::badge>
                </div>
            </div>

            {{-- BLOC 2 : INFOS (Droite/Bas) --}}
            <div style="flex: 1; min-width: 240px; display: flex; flex-direction: column; gap: 10px;">
                {{-- Ligne 1 : Déploiement --}}
                <div style="display: flex; align-items: center; gap: 8px; white-space: nowrap;">
                    <x-filament::icon icon="heroicon-m-calendar-days" class="h-4 w-4 text-gray-400" style="flex-shrink: 0;" />
                    <span style="font-size: 0.75rem; color: #6b7280;">Déploiement :</span>
                    <span style="font-size: 0.75rem; font-weight: 600;" class="dark:text-white">{{ $data['date'] }}</span>
                </div>

                {{-- Ligne 2 : Version --}}
                <div style="display: flex; align-items: center; gap: 8px; white-space: nowrap;">
                    <x-filament::icon icon="heroicon-m-tag" class="h-4 w-4 text-gray-400" style="flex-shrink: 0;" />
                    <span style="font-size: 0.75rem; color: #6b7280;">Version :</span>
                    <span style="font-size: 0.75rem; font-weight: 600; font-family: monospace;" class="text-primary-600 dark:text-primary-400">
                        {{ $data['release'] }}
                    </span>
                </div>
            </div>

        </div>
    </x-filament::section>

    {{-- Ce style garantit la séparation visuelle sur mobile si les blocs s'empilent --}}
    <style>
        @media (max-width: 639px) {
            .deployment-widget-flex > div:last-child {
                border-top: 1px solid rgba(156, 163, 175, 0.2);
                padding-top: 15px;
            }
        }
    </style>
</x-filament-widgets::widget>