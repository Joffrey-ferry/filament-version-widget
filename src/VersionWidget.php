<?php

namespace Neoxiel\FilamentVersionWidget;

use Carbon\Carbon;
use Filament\Widgets\Widget;

class VersionWidget extends Widget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    /**
     * @var view-string
     */
    protected string $view = 'filament-version-widget::version-widget';

    public function getDeploymentData(): array
    {
        // On cache le résultat pendant 24h (86400 secondes)
        return cache()->remember('filament_version_data', 86400, function () {
            $releaseName = 'N/A';
            $paths = [
                base_path('.dep/latest_release'),
                base_path('../.dep/latest_release'),
            ];

            foreach ($paths as $path) {
                if (file_exists($path)) {
                    $releaseName = trim(file_get_contents($path));
                    break;
                }
            }

            return [
                'date' => \Carbon\Carbon::createFromTimestamp(filemtime(base_path()))
                            ->translatedFormat('d F Y à H:i'),
                'release' => $releaseName,
                'env' => app()->environment(),
            ];
        });
    }
}
