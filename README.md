# Filament Version Widget

Un widget simple et efficace pour afficher les informations de déploiement (via **Deployer**) et l'environnement actuel directement sur votre tableau de bord Filament.

## 🌟 Fonctionnalités

* 🚀 Affiche le numéro de la **dernière release** (détecte automatiquement le dossier ou le fichier `.dep/latest_release`).
* 📅 Affiche la **date et l'heure** du dernier déploiement.
* 🌐 Indique l'**environnement** actuel (`production`, `local`, etc.) avec un code couleur dynamique.
* ⚡ **Optimisé** avec un système de cache pour ne pas impacter les performances.

## 📦 Installation

Ajoutez le chemin du package dans le `composer.json` de votre projet Laravel :

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Joffrey-ferry/filament-version-widget"
    }
],

```

Puis installez-le :

```bash
composer require neoxiel/filament-version-widget

```

## 🛠️ Configuration

Ajoutez simplement le widget à votre panel Filament (généralement dans `app/Providers/Filament/AdminPanelProvider.php`) :

```php
use DoeJhon\FilamentVersionWidget\VersionWidget;

public function panel(Panel $panel): Panel
{
    return $panel
        ->widgets([
            VersionWidget::class,
        ]);
}

```

## 🎨 Personnalisation

Si vous souhaitez modifier le design du widget sans toucher au code du package, vous pouvez publier la vue :

```bash
php artisan vendor:publish --tag=filament-version-widget-views

```

La vue sera alors disponible dans `resources/views/vendor/filament-version-widget/version-widget.blade.php`.

## ⚙️ Fonctionnement technique

Le widget cherche les informations dans cet ordre :

1. Fichier `.dep/latest_release` (standard Deployer).
2. Nom du dossier racine (si c'est un numéro de release).
3. Date de modification du dossier de base pour la date de déploiement.
