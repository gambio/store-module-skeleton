# GXModule.json Referenz

Die `GXModule.json` Datei ist das zentrale Manifest für jedes Gambio Modul. Sie registriert das Modul im Module Center und kann automatisch eine Konfigurationsseite generieren, ohne HTML oder Controller.

## Speicherort

```
src/GXModules/{Vendor}/{Modul}/GXModule.json
```

## Minimales Beispiel

```json
{
    "title": "mein_modul.PAGE_TITLE",
    "description": "mein_modul.DESCRIPTION"
}
```

Das reicht aus, damit das Modul im Module Center erscheint.

## Vollständiges Schema

| Schlüssel | Typ | Beschreibung |
|-----------|-----|--------------|
| `title` | string | Übersetzungsschlüssel für den Modultitel |
| `description` | string | Übersetzungsschlüssel für die Modulbeschreibung |
| `sortOrder` | number | Position in der Module Center Liste (Standard: 0) |
| `forceIncludingFiles` | boolean | Moduldateien auch laden wenn nicht installiert (Standard: false) |
| `config_url` | string | Eigene URL für die Konfigurationsseite (überschreibt die automatisch generierte) |
| `install` | object | *(Optional)* PHP-Hook beim Installieren |
| `uninstall` | object | *(Optional)* PHP-Hook beim Deinstallieren |
| `save` | object | *(Optional)* PHP-Hook nach dem Speichern der Konfiguration |
| `configuration` | array | Konfigurationssektionen mit Formularfeldern |

## Lifecycle Hooks (Optional)

!!! note
    Lifecycle Hooks sind **komplett optional**. Wenn dein Modul nur eine einfache Konfigurationsseite braucht, musst du keine `install`, `uninstall` oder `save` Hooks definieren. Gambio speichert und liest Konfigurationswerte automatisch. Füge Hooks nur hinzu, wenn dein Modul eigene Logik benötigt (z.B. Datenbanktabellen anlegen, Caches leeren oder Eingaben validieren).

### install / uninstall

```json
{
    "install": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\InstallAction",
        "method": "onInstall"
    },
    "uninstall": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\InstallAction",
        "method": "onUninstall"
    }
}
```

**Auflösungsreihenfolge:**
1. Die Klasse wird zuerst im DI-Container gesucht (wenn per ServiceProvider registriert)
2. Fallback: Auflösung über MainFactory

**Methodensignatur (DI-Container):**

Wenn die Klasse über den DI-Container aufgelöst wird, erhält die Methode nur die geparsten GXModule.json Daten:

```php
public function onInstall(array $gxModulesJsonData): void
```

**Methodensignatur (MainFactory Fallback):**

Wenn die Klasse über MainFactory aufgelöst wird, erhält die Methode vier Parameter:

```php
public function onInstall($db, array $moduleData, $languageTextManager, $cacheControl): void
```

- `$db`: CI_DB_query_builder Datenbankinstanz
- `$moduleData`: Geparstes GXModule.json als Array
- `$languageTextManager`: LanguageTextManager für Übersetzungen
- `$cacheControl`: DataCache zum Cache leeren

Wenn kein `uninstall` Hook definiert ist, werden bei der Deinstallation automatisch alle Konfigurationswerte gelöscht.

!!! info
    Gambio hat kein automatisches Datenbank-Migrationssystem. Wenn dein Modul eigene Tabellen braucht, erstelle sie im `install` Hook und lösche sie im `uninstall` Hook per SQL-Abfragen. Siehe die [Modulentwicklung Anleitung](./modulentwicklung-anleitung.md#beispiel-datenbanktabellen-in-lifecycle-hooks-erstellen) für ein vollständiges Beispiel mit MainFactory- und DI-Container-Variante.

### save

```json
{
    "save": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\SaveAction",
        "method": "onSave"
    }
}
```

**Methodensignatur:**
```php
public function onSave($db, $configurationStorage, $languageTextManager, $cacheControl): void
```

- `$configurationStorage`: GXModuleConfigurationStorage zum Lesen gespeicherter Werte

## Konfigurationssektionen

Das `configuration` Array definiert Sektionen mit Formularfeldern. Jede Sektion hat einen Titel und eine Menge von Feldern:

```json
{
    "configuration": [
        {
            "title": "mein_modul.SECTION_ALLGEMEIN",
            "fields": {
                "feldSchluessel": {
                    "type": "text",
                    "label": "mein_modul.LABEL_FELD"
                }
            }
        }
    ]
}
```

### Sektionseigenschaften

| Schlüssel | Typ | Beschreibung |
|-----------|-----|--------------|
| `title` | string | Übersetzungsschlüssel für die Sektionsüberschrift |
| `tab` | string | Übersetzungsschlüssel für einen Tab-Namen (gruppiert Sektionen in Tabs) |
| `fields` | object | Key-Value Map mit Felddefinitionen |

### Tabs

Verwende die `tab` Eigenschaft, um mehrere Sektionen unter Tabs zu gruppieren:

```json
{
    "configuration": [
        {
            "title": "mein_modul.SECTION_BASIS",
            "fields": { }
        },
        {
            "title": "mein_modul.SECTION_ERWEITERT",
            "tab": "mein_modul.TAB_ERWEITERT",
            "fields": { }
        },
        {
            "title": "mein_modul.SECTION_AKTIONEN",
            "tab": "mein_modul.TAB_ERWEITERT",
            "fields": { }
        }
    ]
}
```

Sektionen ohne `tab` erscheinen auf dem Standard-Tab (erster Tab). Sektionen mit gleichem `tab` Wert werden zusammengefasst.

## Feldtypen

### checkbox

Ein boolescher Schalter.

```json
{
    "type": "checkbox",
    "label": "mein_modul.LABEL_AKTIVIEREN"
}
```

### text

Einzeiliges Texteingabefeld.

```json
{
    "type": "text",
    "label": "mein_modul.LABEL_NAME",
    "required": true
}
```

### password

Passworteingabe (maskiert).

```json
{
    "type": "password",
    "label": "mein_modul.LABEL_GEHEIMNIS"
}
```

### email

E-Mail-Eingabe mit Browser-Validierung.

```json
{
    "type": "email",
    "label": "mein_modul.LABEL_EMAIL"
}
```

### number

Numerische Eingabe mit optionalem Bereich und Schrittweite.

```json
{
    "type": "number",
    "label": "mein_modul.LABEL_MENGE",
    "default_value": "10",
    "min": 1,
    "max": 100,
    "step": 1
}
```

### color

Farbwählfeld.

```json
{
    "type": "color",
    "label": "mein_modul.LABEL_FARBE",
    "default_value": "#002337"
}
```

### date

Datumsauswahl (nur Datum).

```json
{
    "type": "date",
    "label": "mein_modul.LABEL_STARTDATUM"
}
```

### datetime

Datums- und Zeitauswahl.

```json
{
    "type": "datetime",
    "label": "mein_modul.LABEL_ZEITPLAN"
}
```

### file

Datei-Upload-Feld.

```json
{
    "type": "file",
    "label": "mein_modul.LABEL_LOGO",
    "folder": "images/modules",
    "accept": "image/*"
}
```

- `folder`: Upload-Zielverzeichnis relativ zum Shop-Root
- `accept`: MIME-Typ-Filter für den Dateiauswahldialog

### textarea

Mehrzeiliges Texteingabefeld.

```json
{
    "type": "textarea",
    "label": "mein_modul.LABEL_NOTIZEN"
}
```

### editor

Rich-Text-Editor (WYSIWYG).

```json
{
    "type": "editor",
    "label": "mein_modul.LABEL_INHALT",
    "languageDependent": true
}
```

Wenn `languageDependent` auf `true` steht, wird ein separater Eingabe-Tab für jede Shop-Sprache angezeigt.

### select

Dropdown mit vordefinierten Optionen.

```json
{
    "type": "select",
    "label": "mein_modul.LABEL_MODUS",
    "values": [
        { "value": "grid", "text": "mein_modul.OPTION_RASTER" },
        { "value": "list", "text": "mein_modul.OPTION_LISTE" }
    ]
}
```

### multiselect

Mehrfachauswahl.

```json
{
    "type": "multiselect",
    "label": "mein_modul.LABEL_OPTIONEN",
    "values": [
        { "value": "a", "text": "Option A" },
        { "value": "b", "text": "Option B" },
        { "value": "c", "text": "Option C" }
    ],
    "selected": ["a", "b"]
}
```

### customer_group

Dropdown vorbefüllt mit den Kundengruppen des Shops.

```json
{
    "type": "customer_group",
    "label": "mein_modul.LABEL_KUNDENGRUPPE"
}
```

### order_status

Dropdown vorbefüllt mit den Bestellstatus des Shops.

```json
{
    "type": "order_status",
    "label": "mein_modul.LABEL_STATUS"
}
```

### countries

Dropdown vorbefüllt mit der Länderliste des Shops.

```json
{
    "type": "countries",
    "label": "mein_modul.LABEL_LAENDER"
}
```

### languages

Dropdown vorbefüllt mit den aktiven Sprachen des Shops.

```json
{
    "type": "languages",
    "label": "mein_modul.LABEL_SPRACHE"
}
```

### button

Ein Aktionsbutton, der einen AJAX-Aufruf auslöst.

```json
{
    "type": "button",
    "label": "mein_modul.LABEL_SYNC",
    "text": "mein_modul.BTN_JETZT_SYNC",
    "color": "primary",
    "action": {
        "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\SyncAction",
        "method": "sync",
        "message": "mein_modul.MSG_SYNC_FERTIG"
    }
}
```

- `color`: Buttonfarbe (`default`, `primary`, `success`, `info`, `warning`, `danger`, `link`)
- `action.controller`: PHP-Klasse (muss `GXModuleController` erweitern)
- `action.method`: Methodenname
- `action.message`: Übersetzungsschlüssel für die Erfolgsmeldung

Ein Button kann auch ein Modal anstatt einer direkten Aktion auslösen:

```json
{
    "type": "button",
    "label": "mein_modul.LABEL_RESET",
    "text": "mein_modul.BTN_RESET",
    "color": "danger",
    "modal": "resetModal"
}
```

Der `modal` Wert muss einem Feldschlüssel vom Typ `modal` in derselben Sektion entsprechen.

### modal

Ein Bestätigungsdialog, der von einem Button ausgelöst wird. Verwende `description` für einfachen Text oder `content` für eigenes HTML.

**Modal mit Text:**

```json
{
    "type": "modal",
    "title": "mein_modul.MODAL_TITEL",
    "description": "mein_modul.MODAL_TEXT",
    "buttons": {
        "cancel": {
            "text": "mein_modul.BTN_ABBRECHEN"
        },
        "confirm": {
            "text": "mein_modul.BTN_BESTAETIGEN",
            "action": {
                "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\ResetAction",
                "method": "reset",
                "message": "mein_modul.MSG_RESET_FERTIG"
            }
        }
    }
}
```

**Modal mit gerendertem HTML:**

```json
{
    "type": "modal",
    "title": "mein_modul.MODAL_TITEL",
    "content": "AcmeCorp/MeinModul/Admin/Html/modal_inhalt.html",
    "buttons": {
        "close": { "text": "buttons.cancel" },
        "confirm": {
            "text": "mein_modul.BTN_BESTAETIGEN",
            "action": {
                "controller": "GXModules\\AcmeCorp\\MeinModul\\Admin\\Actions\\EineAction",
                "method": "ausfuehren",
                "message": "mein_modul.MSG_FERTIG"
            }
        }
    }
}
```

Das `content` Attribut verweist auf eine HTML-Datei relativ zum GXModules-Verzeichnis, die im Modal gerendert wird.
```

## Allgemeine Feldeigenschaften

Diese Eigenschaften können bei den meisten Feldtypen verwendet werden:

| Eigenschaft | Typ | Beschreibung |
|-------------|-----|--------------|
| `label` | string | Übersetzungsschlüssel für das Feldlabel |
| `required` | boolean | Macht das Feld zum Pflichtfeld |
| `default_value` | string | Standardwert für das Feld |
| `readonly` | boolean | Macht das Feld schreibgeschützt (für text, email, number, date, datetime, textarea, editor) |
| `regex` | string | Validierungsmuster, dem der Eingabewert entsprechen muss (für text, password, email, number) |
| `selected` | array | Vorausgewählte Werte für Multiselect-Felder |
| `languageDependent` | boolean | Zeigt pro Sprache einen eigenen Eingabe-Tab an (funktioniert mit textbasierten Feldtypen, nicht nur editor) |
| `tooltip` | object | Fügt einen Info- oder Fehler-Tooltip hinzu |

### Tooltips

```json
{
    "tooltip": {
        "type": "info",
        "text": "mein_modul.TOOLTIP_HILFE"
    }
}
```

- `type`: `info` (blau) oder `error` (rot)
- `text`: Übersetzungsschlüssel für den Tooltip-Text

## Konfigurationswerte lesen

Um gespeicherte Konfigurationswerte in PHP zu lesen, verwende den `GXModuleConfigurationStorage`:

```php
$configurationStorage = MainFactory::create('GXModuleConfigurationStorage', 'AcmeCorp/MeinModul');
$istAktiv = $configurationStorage->get('featureAktivieren');
$apiKey = $configurationStorage->get('apiSchluessel');
```

Das zweite Argument für `MainFactory::create` ist `{Vendor}/{Modul}`.

!!! note
    Wenn noch keine Konfiguration gespeichert wurde, gibt `GXModuleConfigurationStorage` den `default_value` aus der `GXModule.json` zurück.

### Rückgabetypen pro Feldtyp

| Typ | Rückgabewert |
|-----|-------------|
| `checkbox` | string: `"1"` für true, `"0"` für false |
| `text`, `password`, `email`, `number`, `color`, `date`, `datetime`, `textarea`, `editor` | string |
| `file` | string: Dateipfad relativ zum Shop-Root |
| `select`, `customer_group`, `order_status`, `countries`, `languages` | string |
| `multiselect` | array |

## Vollständiges Beispiel

Siehe die `GXModule.json` des Skeletons für ein funktionierendes Beispiel, das alle Feldtypen, Tabs, Tooltips, Buttons, Modals und Lifecycle Hooks demonstriert.
