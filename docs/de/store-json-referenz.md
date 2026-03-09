# store.json Referenz

Die `store.json` Datei definiert die Metadaten für dein Modul im Gambio App Store. Sie muss im **Projekt-Root** liegen (nicht in `src/`).

## Minimales Beispiel

```json
{
    "name": "Mein Modul",
    "code": "mein_modul",
    "type": "module",
    "title": {
        "en": "My Module",
        "de": "Mein Modul"
    },
    "vendor": {
        "name": "AcmeCorp",
        "url": "https://example.com/"
    },
    "requirements": {
        "needed": {
            "shop": { "shopVersions": [">=5.0.0.0"] },
            "server": { "phpVersions": [">=8.0"], "mysqlVersions": [">=5.5"] }
        }
    }
}
```

## Feldreferenz

### Top-Level Felder

| Feld | Typ | Pflicht | Beschreibung |
|------|-----|---------|--------------|
| `name` | string | Ja | Interner Paketname |
| `code` | string | Ja | Eindeutiger Modulcode (intern verwendet) |
| `type` | string | Ja | Pakettyp, immer `"module"` |
| `title` | object | Ja | Anzeigetitel mit `en` und `de` Schlüsseln |
| `description` | object | Nein | HTML-Beschreibung mit `en` und `de` Schlüsseln |
| `vendor` | object | Ja | Anbieterinformationen |
| `displayImage` | object | Nein | Vorschaubild-Pfade mit `en` und `de` Schlüsseln |
| `highlights` | array | Nein | Feature-Stichpunkte für die Store-Seite |
| `migrations` | object | Nein | Datenbank-Migrationsscripte |
| `requirements` | object | Ja | Versionsanforderungen |

### vendor

```json
{
    "vendor": {
        "name": "AcmeCorp",
        "url": "https://example.com/",
        "avatar": ""
    }
}
```

### highlights

Bis zu 3 kurze Feature-Beschreibungen auf der Store-Seite:

```json
{
    "highlights": [
        { "title": { "en": "Easy to configure", "de": "Einfach zu konfigurieren" } },
        { "title": { "en": "Multi-language support", "de": "Mehrsprachig" } }
    ]
}
```

### migrations

Datenbank-Migrationsscripte, die bei Installation (up) und Deinstallation (down) ausgeführt werden:

```json
{
    "migrations": {
        "up": [
            "CREATE TABLE IF NOT EXISTS my_table (id INT PRIMARY KEY AUTO_INCREMENT)"
        ],
        "down": [
            "DROP TABLE IF EXISTS my_table"
        ]
    }
}
```

### requirements

```json
{
    "requirements": {
        "needed": {
            "shop": { "shopVersions": [">=5.0.0.0"] },
            "server": { "phpVersions": [">=8.0"], "mysqlVersions": [">=5.5"] },
            "themes": [],
            "receiptFiles": []
        },
        "hidden": {
            "shop": { "shopVersions": [] },
            "server": { "phpVersions": [], "mysqlVersions": [] },
            "themes": []
        }
    }
}
```

- **needed**: Anforderungen, die erfüllt sein müssen, damit das Modul installierbar ist
- **hidden**: Versionen, bei denen das Modul im Store nicht angezeigt wird
- **shopVersions**: Gambio Shop Versionsbeschränkungen (z.B. `>=5.0.0.0`, `<=5.5.0.0`)
- **phpVersions**: PHP Versionsbeschränkungen
- **mysqlVersions**: MySQL Versionsbeschränkungen
- **themes**: Erforderliche Themes (leer lassen für themeunabhängige Module)
- **receiptFiles**: Setzt voraus, dass andere Gambio Module installiert sind (geprüft gegen Dateien in `version_info/`)

### Beispiel: Abhängigkeit von einem anderen Gambio Modul

Wenn dein Modul ein anderes Gambio Modul voraussetzt, verwende `receiptFiles`. Das Store-System prüft das `version_info/` Verzeichnis des Shops auf die angegebenen Dateinamen:

```json
{
    "requirements": {
        "needed": {
            "shop": { "shopVersions": [">=5.0.0.0"] },
            "server": { "phpVersions": [">=8.0"], "mysqlVersions": [">=5.5"] },
            "themes": [],
            "receiptFiles": ["some_required_module.php"]
        }
    }
}
```

Wenn das benötigte Modul im Ziel-Shop nicht installiert ist, kann dein Modul nicht installiert werden und der Kunde sieht einen Hinweis auf die fehlende Abhängigkeit.

## Beschreibungsbilder

Du kannst Bilder in die Store-Beschreibungs-HTML einbetten. Platziere Bilddateien in `.assets/` und referenziere sie mit eckigen Klammern:

```html
<img src="[screenshot.png]" class="img-fluid w-100">
```

Der `[screenshot.png]` Platzhalter wird vom Store-System durch die tatsächliche gehostete URL ersetzt.

## Beschreibungen mit HTML-Dateien überschreiben

Statt HTML in `store.json` zu schreiben, kannst du separate Dateien erstellen:

```
.assets/de/description.html
.assets/en/description.html
```

Wenn diese Dateien existieren, überschreiben sie das `description` Feld in `store.json`.

## Nächste Schritte

- [Modulentwicklung Anleitung](./modulentwicklung-anleitung.md): Dein Modul bauen
- [Veröffentlichung](./veroeffentlichung-guide.md): Im Gambio Store einreichen
