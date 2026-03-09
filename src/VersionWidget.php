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


    // public function getDeploymentData(): array
    // {
    //     $releaseName = 'N/A';

    //     // On définit les chemins potentiels
    //     $paths = [
    //         base_path().'/.dep/latest_release',                 // Local ou si .dep est dans le dossier release
    //         dirname(base_path()).'/.dep/latest_release',        // Cas standard Deployer (un niveau au dessus)
    //         dirname(dirname(base_path())).'/.dep/latest_release', // Si base_path() est déjà profond
    //     ];

    //     foreach ($paths as $path) {
    //         if (file_exists($path)) {
    //             $releaseName = trim(file_get_contents($path));
    //             break; // On a trouvé le fichier, on arrête de chercher
    //         }
    //     }

    //     // Si on n'a toujours rien trouvé via le fichier .dep,
    //     // on utilise le nom du dossier actuel (releases/15 -> 15)
    //     if ($releaseName === 'N/A') {
    //         $currentFolder = basename(base_path());
    //         // On vérifie que c'est bien un chiffre (le numéro de release)
    //         if (is_numeric($currentFolder)) {
    //             $releaseName = $currentFolder;
    //         }
    //     }

    //     return [
    //         'date' => Carbon::createFromTimestamp(filemtime(base_path()))->translatedFormat('d F Y à H:i'),
    //         'release' => $releaseName,
    //         'env' => app()->environment(),
    //     ];
    // }
}
