# Veröffentlichung im Gambio Store

Wie du dein Modul im Gambio App Store einreichst.

## Voraussetzungen

- Ein getestetes, funktionierendes Modul (siehe [Lokal testen](./lokal-testen.md))
- Ein GitHub Account oder eine Organisation
- Eine gültige `store.json` im Projekt-Root (siehe [store.json Referenz](./store-json-referenz.md))
- Store-Assets in `.assets/` (Logos, Beschreibung)

## Schritt 1: Als Developer registrieren

Die Developer-Registrierung erfolgt derzeit manuell. Schreibe eine E-Mail an **info@gambio.de** mit dem Link zu deinem GitHub Repository. Gambio richtet dann deinen Developer-Account ein.

> **Hinweis:** Ein Self-Service Developer Portal ist in Planung (bald verfügbar). Bis dahin läuft das Onboarding per E-Mail.

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
4. Füge Release Notes mit Beschreibung des Moduls hinzu
5. Release veröffentlichen

Der Versions-Tag sollte [Semantic Versioning](https://semver.org/) folgen (z.B. `v1.0.0`, `v1.1.0`, `v2.0.0`).

## Schritt 5: Modul zur Prüfung einreichen

Schreibe eine E-Mail an **info@gambio.de** mit dem Link zu deinem GitHub Repository. Gib den Versions-Tag an, der geprüft werden soll.

Gambio prüft eingereichte Module, bevor sie im Store erscheinen. Die Prüfung umfasst:

- Modul installiert und deinstalliert sich sauber
- Keine Sicherheitsprobleme
- Store-Metadaten sind vollständig und korrekt
- Modul funktioniert wie beschrieben

Nach der Freigabe erscheint dein Modul im Gambio App Store.

## Version-Info-Datei

Während des Onboarding-Prozesses fügt das Gambio Team automatisch eine `version_info/`-Datei zu deinem Modul hinzu. Diese PHP-Datei wird bei der Installation des Moduls im `version_info/`-Verzeichnis des Shops abgelegt und dient als Nachweis, dass das Modul vorhanden ist.

!!! info "Du musst diese Datei nicht selbst erstellen"

    Die `version_info/`-Datei wird vollständig vom Gambio Team während des Modul-Onboardings generiert und verwaltet. Du brauchst sie nicht in dein Repository aufzunehmen.

Andere Module können über das `receiptFiles`-Feld in ihrer `store.json` eine Abhängigkeit zu deinem Modul definieren (siehe [store.json Referenz > receiptFiles](./store-json-referenz.md#beispiel-abhangigkeit-von-einem-anderen-gambio-modul)).

## Modul aktualisieren

Um ein Update zu veröffentlichen:

1. Änderungen vornehmen und zum Repository pushen
2. Ein neues GitHub Release mit erhöhtem Versions-Tag erstellen
3. Gambio per E-Mail (**info@gambio.de**) über das neue Release informieren

## Store-Assets

### Pflicht

| Datei | Beschreibung |
|-------|--------------|
| `.assets/module_logo(.png\|.jpg\|.svg)` | Modullogo im Store |
| `.assets/vendor_logo(.png\|.jpg\|.svg)` | Firmen-/Entwicklerlogo |

### Optional

| Datei | Beschreibung |
|-------|--------------|
| `.assets/de/description.html` | Deutsche HTML-Beschreibung (überschreibt store.json) |
| `.assets/en/description.html` | Englische HTML-Beschreibung (überschreibt store.json) |
| `.assets/screenshot.png` | Screenshots, referenziert in der Beschreibungs-HTML |

### Bilder in Beschreibungen referenzieren

Verwende eckige Klammern, um Bilder aus `.assets/` in der Beschreibungs-HTML einzubetten:

```html
<img src="[screenshot.png]" class="img-fluid w-100">
```

## Nächste Schritte

- [Release Checkliste](./release-checkliste.md): Alles vor dem Release prüfen
