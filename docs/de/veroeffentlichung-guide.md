# Veroeffentlichung im Gambio Store

Wie du dein Modul im Gambio App Store einreichst.

## Voraussetzungen

- Ein getestetes, funktionierendes Modul (siehe [Lokal testen](./lokal-testen.md))
- Ein GitHub Account oder eine Organisation
- Eine gueltige `store.json` im Projekt-Root (siehe [store.json Referenz](./store-json-referenz.md))
- Store-Assets in `.assets/` (Logos, Beschreibung)

## Schritt 1: Developer Account erstellen

Registriere dich im [Gambio Developer Portal](https://store-api.new.gambio.com) und melde dich an.

## Schritt 2: GitHub Repository einrichten

1. Erstelle ein **neues Repository** auf GitHub (kann privat sein)
2. Pushe deinen Modulcode mit der Skeleton-Struktur:
   ```
   .assets/
   src/GXModules/{Vendor}/{Modul}/
   store.json
   ```
3. Stelle sicher, dass `store.json` im Repository-Root liegt

## Schritt 3: Gambio Store GitHub App installieren

Installiere die [Gambio Store GitHub App](https://github.com/apps/gambio-store) in deinem Repository oder deiner GitHub Organisation. Damit kann das Store-System dein Repository auslesen.

## Schritt 4: GitHub Release erstellen

1. Gehe zu deinem Repository auf GitHub
2. Klicke auf **Releases > Create a new release**
3. Erstelle einen Versions-Tag (z.B. `v1.0.0`)
4. Fuege Release Notes mit Beschreibung des Moduls hinzu
5. Release veroeffentlichen

Der Versions-Tag sollte [Semantic Versioning](https://semver.org/) folgen (z.B. `v1.0.0`, `v1.1.0`, `v2.0.0`).

## Schritt 5: Modul im Developer Portal registrieren

1. Im [Developer Portal](https://store-api.new.gambio.com) anmelden
2. Neues Modul anlegen
3. GitHub Organisations-/Benutzernamen und Repository-Namen eintragen
4. Auf **Einlesen** klicken, um die Repository-Daten zu importieren

## Schritt 6: Freigabe abwarten

Gambio prueft eingereichte Module, bevor sie im Store erscheinen. Die Pruefung umfasst:

- Modul installiert und deinstalliert sich sauber
- Keine Sicherheitsprobleme
- Store-Metadaten sind vollstaendig und korrekt
- Modul funktioniert wie beschrieben

Nach der Freigabe erscheint dein Modul im Gambio App Store.

## Modul aktualisieren

Um ein Update zu veroeffentlichen:

1. Aenderungen vornehmen und zum Repository pushen
2. Ein neues GitHub Release mit erhoehtem Versions-Tag erstellen
3. Das Developer Portal erkennt das neue Release automatisch

## Store-Assets

### Pflicht

| Datei | Beschreibung |
|-------|--------------|
| `.assets/module_logo(.png\|.jpg\|.svg)` | Modullogo im Store |
| `.assets/vendor_logo(.png\|.jpg\|.svg)` | Firmen-/Entwicklerlogo |

### Optional

| Datei | Beschreibung |
|-------|--------------|
| `.assets/de/description.html` | Deutsche HTML-Beschreibung (ueberschreibt store.json) |
| `.assets/en/description.html` | Englische HTML-Beschreibung (ueberschreibt store.json) |
| `.assets/screenshot.png` | Screenshots, referenziert in der Beschreibungs-HTML |

### Bilder in Beschreibungen referenzieren

Verwende eckige Klammern, um Bilder aus `.assets/` in der Beschreibungs-HTML einzubetten:

```html
<img src="[screenshot.png]" class="img-fluid w-100">
```

## Naechste Schritte

- [Release Checkliste](./release-checkliste.md): Alles vor dem Release pruefen
