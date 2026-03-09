# store.json Referenz

Die `store.json` Datei definiert die Metadaten fuer dein Modul im Gambio App Store. Sie muss im **Projekt-Root** liegen (nicht in `src/`).

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
| `title` | object | Ja | Anzeigetitel mit `en` und `de` Schluesseln |
| `description` | object | Nein | HTML-Beschreibung mit `en` und `de` Schluesseln |
| `vendor` | object | Ja | Anbieterinformationen |
| `displayImage` | object | Nein | Vorschaubild-Pfade mit `en` und `de` Schluesseln |
| `highlights` | array | Nein | Feature-Stichpunkte fuer die Store-Seite |
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

Datenbank-Migrationsscripte, die bei Installation (up) und Deinstallation (down) ausgefuehrt werden:

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

- **needed**: Anforderungen, die erfuellt sein muessen, damit das Modul installierbar ist
- **hidden**: Versionen, bei denen das Modul im Store nicht angezeigt wird
- **shopVersions**: Gambio Shop Versionsbeschraenkungen (z.B. `>=5.0.0.0`, `<=5.5.0.0`)
- **phpVersions**: PHP Versionsbeschraenkungen
- **mysqlVersions**: MySQL Versionsbeschraenkungen
- **themes**: Erforderliche Themes (leer lassen fuer themeunabhaengige Module)
- **receiptFiles**: Erforderliche Dateien, die im Shop existieren muessen

## Beschreibungsbilder

Du kannst Bilder in die Store-Beschreibungs-HTML einbetten. Platziere Bilddateien in `.assets/` und referenziere sie mit eckigen Klammern:

```html
<img src="[screenshot.png]" class="img-fluid w-100">
```

Der `[screenshot.png]` Platzhalter wird vom Store-System durch die tatsaechliche gehostete URL ersetzt.

## Beschreibungen mit HTML-Dateien ueberschreiben

Statt HTML in `store.json` zu schreiben, kannst du separate Dateien erstellen:

```
.assets/de/description.html
.assets/en/description.html
```

Wenn diese Dateien existieren, ueberschreiben sie das `description` Feld in `store.json`.

## Naechste Schritte

- [Modulentwicklung Anleitung](./modulentwicklung-anleitung.md): Dein Modul bauen
- [Veroeffentlichung](./veroeffentlichung-guide.md): Im Gambio Store einreichen
