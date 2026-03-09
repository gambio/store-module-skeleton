# Modulentwicklung Anleitung

Diese Anleitung zeigt Schritt für Schritt, wie du ein Gambio GX Modul mit dem [Store Module Skeleton](https://github.com/gambio/store-module-skeleton) erstellst.

## Voraussetzungen

- Eine Gambio Shop Installation (lokal oder Testsystem)
- PHP >= 8.0
- Grundkenntnisse in PHP, HTML, CSS und JavaScript
- Ein GitHub Account (für die Veröffentlichung im Store)

## Wie Gambio Module funktionieren

Jedes Gambio Modul liegt in `src/GXModules/{Vendor}/{ModuleName}/`. Der `{Vendor}` Ordner ist dein Firmen- oder Entwicklername, `{ModuleName}` ist der Name deines Moduls.

Die einzige **Pflichtdatei** ist `GXModule.json`. Diese Datei registriert dein Modul im Module Center, wo Shop-Administratoren es installieren und deinstallieren können. Alles andere ist optional und hängt davon ab, was dein Modul tun soll.

## Schritt 1: Modulverzeichnis erstellen

```
src/GXModules/AcmeCorp/MeinModul/
```

Ersetze `AcmeCorp` durch deinen Vendornamen und `MeinModul` durch den Namen deines Moduls.

## Schritt 2: GXModule.json erstellen

Dies ist die einzige Pflichtdatei. Das Minimum:

```json
{
    "title": "mein_modul.PAGE_TITLE",
    "description": "mein_modul.DESCRIPTION"
}
```

Damit erscheint dein Modul im Module Center. Die Werte verweisen auf Übersetzungsschlüssel aus den TextPhrases-Dateien.

### Konfigurationsfelder hinzufügen

Um Administratoren eine Einstellungsseite zu geben, füge das `configuration` Array hinzu:

```json
{
    "title": "mein_modul.PAGE_TITLE",
    "description": "mein_modul.DESCRIPTION",
    "configuration": [
        {
            "title": "mein_modul.SECTION_EINSTELLUNGEN",
            "fields": {
                "featureAktivieren": {
                    "type": "checkbox",
                    "label": "mein_modul.LABEL_AKTIVIEREN"
                },
                "apiSchluessel": {
                    "type": "text",
                    "label": "mein_modul.LABEL_API_KEY",
                    "required": true
                }
            }
        }
    ]
}
```

Gambio generiert die Konfigurationsseite automatisch aus diesem JSON. Keine HTML-Templates oder Controller nötig.

Die vollständige Feldtyp-Referenz findest du in der [GXModule.json Referenz](./gxmodule-json-referenz.md).

### Lifecycle Hooks hinzufügen (Optional)

!!! note
    Lifecycle Hooks sind **komplett optional**. Wenn dein Modul nur eine einfache Konfiguration braucht (Checkboxen, Textfelder, Selects usw.), benötigst du keine PHP-Action-Dateien. Gambio speichert und liest Konfigurationswerte automatisch. Hooks brauchst du nur, wenn dein Modul bei der Installation, Deinstallation oder beim Speichern eigene Logik ausführen muss (z.B. Datenbanktabellen anlegen, Caches leeren oder Eingaben validieren).

Du kannst eigenen PHP-Code ausführen, wenn das Modul installiert, deinstalliert oder wenn Einstellungen gespeichert werden:

```json
{
    "install": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\InstallAction",
        "method": "onInstall"
    },
    "uninstall": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\InstallAction",
        "method": "onUninstall"
    },
    "save": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\SaveAction",
        "method": "onSave"
    }
}
```

**Bei Auflösung über den DI-Container** (Klasse im ServiceProvider registriert) erhält die Install/Uninstall-Methode nur die geparsten GXModule.json Daten:

```php
public function onInstall(array $gxModulesJsonData): void
```

**Bei Auflösung über MainFactory Fallback** erhält sie:

```php
public function onInstall($db, array $moduleData, $languageTextManager, $cacheControl): void
```

- `$db`: CI_DB_query_builder Datenbankinstanz
- `$moduleData`: Geparstes GXModule.json als Array
- `$languageTextManager`: LanguageTextManager für Übersetzungen
- `$cacheControl`: DataCache zum Cache leeren

Die Save-Methode erhält `($db, $configurationStorage, $languageTextManager, $cacheControl)`. Nutze sie für Cache-Invalidierung oder Validierung nach Konfigurationsänderungen.

## Schritt 3: Übersetzungen hinzufügen

Erstelle Sprachdateien, damit deine Modul-Labels übersetzbar sind:

```
Admin/TextPhrases/german/mein_modul.lang.inc.php
Admin/TextPhrases/english/mein_modul.lang.inc.php
```

Jede Datei gibt ein Key-Value Array zurück:

```php
<?php
$t_language_text_section_content_array = [
    'PAGE_TITLE'            => 'Mein Modul',
    'DESCRIPTION'           => 'Dieses Modul macht etwas Nützliches.',
    'SECTION_EINSTELLUNGEN' => 'Einstellungen',
    'LABEL_AKTIVIEREN'      => 'Feature aktivieren',
    'LABEL_API_KEY'         => 'API-Schlüssel',
];
```

Der Sektionsname ergibt sich aus dem Dateinamen (ohne `.lang.inc.php`). Verweise auf Schlüssel in GXModule.json mit dem Muster `{sektion}.{KEY}`, z.B. `mein_modul.PAGE_TITLE`.

In Smarty Templates: `{load_language_text section="mein_modul"}` dann `{$txt.KEY}`

### Shop Text Phrases

Wenn dein Modul Übersetzungen auf der Storefront benötigt (nicht nur im Admin), lege Sprachdateien in `Shop/TextPhrases/` ab:

```
Shop/TextPhrases/German/mein_modul.lang.inc.php
Shop/TextPhrases/English/mein_modul.lang.inc.php
```

Beachte, dass die Sprachordnernamen großgeschrieben werden (`German`, `English`).

## Schritt 4: Storefront-Anpassungen (Optional)

### CSS / SCSS

Erstelle eine `main.scss` Datei in `Shop/Themes/All/Css/`, um Styles für alle Themes hinzuzufügen:

```
Shop/Themes/All/Css/main.scss
```

Diese Datei wird automatisch beim Theme-Style-Build eingebunden. Du kannst Styles direkt hinzufügen oder weitere SCSS-Dateien importieren:

```scss
// main.scss
@import 'components/buttons';
@import 'components/badges';

.mein-modul-widget {
    border: 1px solid #ccc;
    padding: 1rem;
}
```

Um ein bestimmtes Theme anzusprechen, ersetze `All` durch den Theme-Namen:

```
Shop/Themes/Malibu/Css/main.scss
```

### JavaScript

Platziere JavaScript-Dateien in `Shop/Themes/All/Javascript/{seite}/`, wobei `{seite}` der Storefront-Seite entspricht:

```
Shop/Themes/All/Javascript/product_info/mein_modul.js       Produktdetailseite
Shop/Themes/All/Javascript/product_listing/mein_modul.js     Kategorieliste
Shop/Themes/All/Javascript/shopping_cart/mein_modul.js       Warenkorb
Shop/Themes/All/Javascript/index/mein_modul.js               Startseite
```

### Smarty Template Overrides

Erweitere Smarty Template-Blocks, indem du die Theme-Verzeichnisstruktur spiegelst:

```
Shop/Themes/All/snippets/footer/footer.html
```

Dies erweitert das Standard-Footer-Template für alle Themes. Siehe die [Smarty Blocks Referenz](./smarty-blocks-referenz.md) für alle verfügbaren Blocks.

## Schritt 5: Admin-Menüeintrag hinzufügen (Optional)

Erstelle `Admin/Menu/mein_modul.menu.json`, um einen Eintrag in der Admin-Seitenleiste hinzuzufügen:

```json
[{
    "id": "BOX_HEADING_MEIN_MODUL",
    "sort": 400,
    "class": "fa fa-puzzle-piece",
    "title": "mein_modul.PAGE_TITLE",
    "type": "standalone",
    "items": [{
        "sort": 10,
        "link": "admin/mein-modul",
        "title": "mein_modul.PAGE_TITLE"
    }]
}]
```

Der `link` Wert ist relativ zur Shop-Root-URL (ohne Domain). Verwende moderne Routen-Pfade (z.B. `admin/mein-modul`), die zu deinen `routes.php` Definitionen passen.

Dies ersetzt das veraltete XML-Menüformat (`menu_*.xml`). Nach dem Hinzufügen oder Ändern von Menüeinträgen muss der Modul-Cache im Gambio Admin geleert werden (**Toolbox > Cache**).

## Schritt 6: Bestehende Funktionalität mit Overloads erweitern (Optional)

Overloads erlauben dir, jede Klasse zu erweitern, die von Gambios MainFactory verwaltet wird.

### Admin Overloads

Dateien in `Admin/Overloads/{KlassenName}/` platzieren:

```php
// Admin/Overloads/OrderExtenderComponent/MeinModulOrderExtender.inc.php

class MeinModulOrderExtender extends MeinModulOrderExtender_parent
{
    public function proceed()
    {
        parent::proceed();
        // Deine eigene Logik hier
    }
}
```

Häufig verwendete Admin-Overload-Ziele:
- `OrderExtenderComponent`: Bestelldetailseite
- `AdminApplicationTopExtenderComponent`: Jede Admin-Seite (früh)
- `AdminEditProductExtenderComponent`: Produktbearbeitungsseite
- `PDFOrderExtenderComponent`: PDF-Rechnungserstellung

### Shop Overloads

Dateien in `Shop/Overloads/{KlassenName}/` platzieren:

```php
// Shop/Overloads/ApplicationTopExtenderComponent/MeinModulAppTop.inc.php

class MeinModulAppTop extends MeinModulAppTop_parent
{
    public function proceed()
    {
        parent::proceed();
        // Wird bei jedem Storefront-Seitenaufruf ausgeführt
    }
}
```

Regeln:
1. Deine Klasse **muss** `{KlassenName}_parent` erweitern (eine Pseudo-Klasse, die von MainFactory aufgelöst wird)
2. Rufe **immer** die Elternmethode auf, um die Overload-Kette zu erhalten
3. Die Datei **muss** die Endung `.inc.php` verwenden

## Schritt 7: ServiceProvider für Dependency Injection (Optional)

Erstelle `MeinModulServiceProvider.php` im Modulwurzelverzeichnis, um Services im DI-Container zu registrieren:

```php
<?php

namespace GXModules\AcmeCorp\MeinModul;

use Gambio\Core\Application\DependencyInjection\AbstractModuleBootableServiceProvider;

class MeinModulServiceProvider extends AbstractModuleBootableServiceProvider
{
    public function provides(): array
    {
        return [MeinService::class];
    }

    public function register(): void
    {
        $this->application->registerShared(MeinService::class, MeinServiceImpl::class)
            ->addArgument(\Gambio\Core\Configuration\ConfigurationService::class);
    }

    public function boot(): void
    {
        // Event Listener über Inflections registrieren
        $this->application->inflect(\Gambio\Core\Event\EventListenerProvider::class)
            ->invokeMethod('attachListener', [EinEvent::class, MeinEventListener::class]);
    }
}
```

Verwende `AbstractModuleBootableServiceProvider` wenn du `boot()` brauchst (für Event Listener). Verwende `AbstractModuleServiceProvider` wenn du nur `register()` brauchst.

## Schritt 8: Modul-Klasse für Events und Middleware (Optional)

Erstelle `MeinModulModule.php` im Modulwurzelverzeichnis. Die Datei wird automatisch erkannt, wenn sie `*Module.php` heißt:

```php
<?php

namespace GXModules\AcmeCorp\MeinModul;

use Gambio\Core\Application\Modules\AbstractModule;

class MeinModulModule extends AbstractModule
{
    public function eventListeners(): ?array
    {
        return [
            EinEvent::class => [MeinListener::class],
        ];
    }

    public function shopMiddleware(): ?array
    {
        return [MeinShopMiddleware::class];
    }

    public function adminMiddleware(): ?array
    {
        return [];
    }

    public function apiMiddleware(): ?array
    {
        return [];
    }

    public function dependsOn(): ?array
    {
        return [];
    }
}
```

## Schritt 9: HTTP-Routen hinzufügen (Optional)

Erstelle `routes.php` im Modulwurzelverzeichnis für eigene HTTP-Endpunkte:

```php
<?php

use Gambio\Core\Application\Routing\RouteCollector;

return static function (RouteCollector $routeCollector) {
    $routeCollector->get('/admin/mein-modul', UebersichtAction::class);

    $routeCollector->group('/admin/api/mein-modul', function (RouteCollector $group) {
        $group->get('', AlleAbfragenAction::class);
        $group->post('', ErstellenAction::class);
        $group->put('/{id:\d+}', AktualisierenAction::class);
        $group->delete('/{id:\d+}', LoeschenAction::class);
    });
};
```

Handler-Klassen müssen PSR-15 `RequestHandlerInterface` implementieren und sollten im ServiceProvider registriert werden.

## Schritt 10: Cronjob hinzufügen (Optional)

Registriere einen geplanten Task mit 4 Dateien in `Admin/CronjobConfiguration/`:

**MeinCronjob.json** (Konfiguration):
```json
{
    "name": "MeinCronjob",
    "title": "mein_cronjob.TITLE",
    "configuration": {
        "active": {
            "name": "active",
            "type": "checkbox",
            "label": "mein_cronjob.LABEL_AKTIV",
            "defaultValue": false
        },
        "interval": {
            "name": "interval",
            "type": "select",
            "label": "mein_cronjob.LABEL_INTERVALL",
            "defaultValue": "0 * * * *",
            "values": [
                { "value": "*/5 * * * *", "text": "mein_cronjob.ALLE_5_MINUTEN" },
                { "value": "0 * * * *",   "text": "mein_cronjob.JEDE_STUNDE" },
                { "value": "0 0 * * *",   "text": "mein_cronjob.TAEGLICH" }
            ]
        }
    }
}
```

**MeinCronjobTask.inc.php** (Ausführungslogik):
```php
class MeinCronjobTask extends AbstractCronjobTask
{
    public function run(array $cronjobStartArguments): void
    {
        $this->logger->log('Starte Synchronisation...');
        // Deine geplante Aufgabe
        $this->logger->log('Synchronisation abgeschlossen.');
    }
}
```

**MeinCronjobDependencies.inc.php** (Abhängigkeiten):
```php
class MeinCronjobDependencies extends AbstractCronjobDependencies
{
    // Getter-Methoden für Services, die der Task braucht
}
```

**MeinCronjobLogger.inc.php** (Logger):
```php
class MeinCronjobLogger extends AbstractCronjobLogger
{
    // Die Standard-Implementierung reicht in der Regel aus
}
```

Füge Übersetzungen in `Admin/TextPhrases/{sprache}/mein_cronjob.lang.inc.php` hinzu.

## Schritt 11: index.html Dateien hinzufügen

Platziere eine leere `<html></html>` Datei namens `index.html` in **jedem Verzeichnis** deines Moduls. Dies ist eine Gambio-Konvention, um Directory Listing auf Webservern zu verhindern:

```html
<html></html>
```

## Minimales vs. vollständiges Modul

Nicht jedes Modul braucht alle Extension Points. Hier einige Beispiele:

**Reines CSS-Modul** (nur Stiländerungen):
```
GXModules/AcmeCorp/PinkButtons/
    GXModule.json
    Shop/Themes/All/Css/pink_buttons.css
```

**JavaScript-Erweiterung** (kein PHP nötig):
```
GXModules/AcmeCorp/ProduktErweiterung/
    GXModule.json
    Shop/Themes/All/Javascript/product_info/erweiterung.js
```

**Vollständiges Modul** (alle Extension Points):
```
GXModules/AcmeCorp/MeinModul/
    GXModule.json
    MeinModulServiceProvider.php
    MeinModulModule.php
    routes.php
    Admin/Actions/...
    Admin/CronjobConfiguration/...
    Admin/Menu/mein_modul.menu.json
    Admin/Overloads/...
    Admin/TextPhrases/...
    Shop/Overloads/...
    Shop/Themes/All/...
```

## Nächste Schritte

- [GXModule.json Referenz](./gxmodule-json-referenz.md): Vollständige Feldtyp-Dokumentation
- [Lokal testen](./lokal-testen.md): Dein Modul testen
- [store.json Referenz](./store-json-referenz.md): Store-Metadaten-Format
- [Veröffentlichung](./veroeffentlichung-guide.md): Modul im Gambio Store einreichen
