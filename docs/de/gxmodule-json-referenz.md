# GXModule.json Referenz

Die `GXModule.json` Datei ist das zentrale Manifest fuer jedes Gambio Modul. Sie registriert das Modul im Module Center und kann automatisch eine Konfigurationsseite generieren, ohne HTML oder Controller.

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

## Vollstaendiges Schema

| Schluessel | Typ | Beschreibung |
|------------|-----|--------------|
| `title` | string | Uebersetzungsschluessel fuer den Modultitel |
| `description` | string | Uebersetzungsschluessel fuer die Modulbeschreibung |
| `sortOrder` | number | Position in der Module Center Liste (Standard: 0) |
| `forceIncludingFiles` | boolean | Moduldateien auch laden wenn nicht installiert (Standard: false) |
| `config_url` | string | Eigene URL fuer die Konfigurationsseite (ueberschreibt die automatisch generierte) |
| `install` | object | PHP-Hook beim Installieren |
| `uninstall` | object | PHP-Hook beim Deinstallieren |
| `save` | object | PHP-Hook nach dem Speichern der Konfiguration |
| `configuration` | array | Konfigurationssektionen mit Formularfeldern |

## Lifecycle Hooks

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

**Aufloesungsreihenfolge:**
1. Die Klasse wird zuerst im DI-Container gesucht (wenn per ServiceProvider registriert)
2. Fallback: Aufloesung ueber MainFactory

**Methodensignatur (MainFactory Fallback):**
```php
public function onInstall($db, array $moduleData, $languageTextManager, $cacheControl): void
```

- `$db`: CI_DB_query_builder Datenbankinstanz
- `$moduleData`: Geparstes GXModule.json als Array
- `$languageTextManager`: LanguageTextManager fuer Uebersetzungen
- `$cacheControl`: DataCache zum Cache leeren

Wenn kein `uninstall` Hook definiert ist, werden bei der Deinstallation automatisch alle Konfigurationswerte geloescht.

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

| Schluessel | Typ | Beschreibung |
|------------|-----|--------------|
| `title` | string | Uebersetzungsschluessel fuer die Sektionsueberschrift |
| `tab` | string | Uebersetzungsschluessel fuer einen Tab-Namen (gruppiert Sektionen in Tabs) |
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

Farbwaehlfeld.

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
- `accept`: MIME-Typ-Filter fuer den Dateiauswahldialog

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

Wenn `languageDependent` auf `true` steht, wird ein separater Eingabe-Tab fuer jede Shop-Sprache angezeigt.

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
        { "value": "b", "text": "Option B" }
    ]
}
```

### customer_group

Dropdown vorbefuellt mit den Kundengruppen des Shops.

```json
{
    "type": "customer_group",
    "label": "mein_modul.LABEL_KUNDENGRUPPE"
}
```

### order_status

Dropdown vorbefuellt mit den Bestellstatus des Shops.

```json
{
    "type": "order_status",
    "label": "mein_modul.LABEL_STATUS"
}
```

### countries

Dropdown vorbefuellt mit der Laenderliste des Shops.

```json
{
    "type": "countries",
    "label": "mein_modul.LABEL_LAENDER"
}
```

### languages

Dropdown vorbefuellt mit den aktiven Sprachen des Shops.

```json
{
    "type": "languages",
    "label": "mein_modul.LABEL_SPRACHE"
}
```

### button

Ein Aktionsbutton, der einen AJAX-Aufruf ausloest.

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

- `color`: Buttonfarbe (`primary`, `warning`, `danger`, `success`)
- `action.controller`: PHP-Klasse (muss `GXModuleController` erweitern)
- `action.method`: Methodenname
- `action.message`: Uebersetzungsschluessel fuer die Erfolgsmeldung

Ein Button kann auch ein Modal anstatt einer direkten Aktion ausloesen:

```json
{
    "type": "button",
    "label": "mein_modul.LABEL_RESET",
    "text": "mein_modul.BTN_RESET",
    "color": "danger",
    "modal": "resetModal"
}
```

Der `modal` Wert muss einem Feldschluessel vom Typ `modal` in derselben Sektion entsprechen.

### modal

Ein Bestaetigungsdialog, der von einem Button ausgeloest wird.

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

## Allgemeine Feldeigenschaften

Diese Eigenschaften koennen bei den meisten Feldtypen verwendet werden:

| Eigenschaft | Typ | Beschreibung |
|-------------|-----|--------------|
| `label` | string | Uebersetzungsschluessel fuer das Feldlabel |
| `required` | boolean | Macht das Feld zum Pflichtfeld |
| `default_value` | string | Standardwert fuer das Feld |
| `languageDependent` | boolean | Zeigt pro Sprache einen eigenen Eingabe-Tab an |
| `tooltip` | object | Fuegt einen Info- oder Warnungs-Tooltip hinzu |

### Tooltips

```json
{
    "tooltip": {
        "type": "info",
        "text": "mein_modul.TOOLTIP_HILFE"
    }
}
```

- `type`: `info` (blau) oder `warning` (gelb)
- `text`: Uebersetzungsschluessel fuer den Tooltip-Text

## Vollstaendiges Beispiel

Siehe die `GXModule.json` des Skeletons fuer ein funktionierendes Beispiel, das alle Feldtypen, Tabs, Tooltips, Buttons, Modals und Lifecycle Hooks demonstriert.
