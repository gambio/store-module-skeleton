# Lokal testen

Wie du dein Modul in einem lokalen Gambio Shop installierst und testest, bevor du es veröffentlichst.

## Installation

1. Kopiere dein Modulverzeichnis in den Shop:

   ```
   cp -r src/GXModules/AcmeCorp /var/www/gambio-shop/GXModules/AcmeCorp
   ```

2. Shop-Cache leeren:
   - Admin > Toolbox > Cache > Alles leeren
   - Oder den Inhalt des `cache/` Verzeichnisses manuell löschen

3. Gehe zu **Admin > Module > Module Center** und finde dein Modul in der Liste.

4. Klicke auf **Installieren**, um es zu aktivieren.

## Entwicklermodus

Erstelle eine leere Datei namens `.dev-environment` im Shop-Root, um den Entwicklermodus zu aktivieren:

```bash
touch /var/www/gambio-shop/.dev-environment
```

Der Entwicklermodus:
- Zeigt detaillierte PHP-Fehlermeldungen
- Deaktiviert Template-Caching
- Aktiviert Debug-Ausgaben

Zum Deaktivieren die Datei löschen:

```bash
rm /var/www/gambio-shop/.dev-environment
```

**Wichtig:** Deaktiviere den Entwicklermodus immer, bevor du ein Release erstellst oder das Modul in Produktion einsetzt.

## Test-Checkliste

### Module Center
- [ ] Modul erscheint in der Module Center Liste
- [ ] Titel und Beschreibung werden korrekt angezeigt
- [ ] Modul lässt sich ohne Fehler installieren
- [ ] Modul lässt sich ohne Fehler deinstallieren
- [ ] Neuinstallation funktioniert (installieren > deinstallieren > installieren)

### Konfigurationsseite
- [ ] Alle Konfigurationsfelder werden korrekt dargestellt
- [ ] Pflichtfelder zeigen Validierungsfehler wenn leer
- [ ] Konfiguration speichern funktioniert
- [ ] Standardwerte werden bei der Erstinstallation angewendet
- [ ] Tooltips werden angezeigt
- [ ] Buttons lösen die richtigen Aktionen aus
- [ ] Modals öffnen und schließen sich korrekt

### Übersetzungen
- [ ] Deutsche Übersetzungen erscheinen wenn Shopsprache Deutsch ist
- [ ] Englische Übersetzungen erscheinen wenn Shopsprache Englisch ist
- [ ] Keine fehlenden Übersetzungsschlüssel (erkennbar an Rohschlüsseln wie `mein_modul.LABEL_XYZ`)

### Storefront (falls zutreffend)
- [ ] CSS wird auf den richtigen Seiten geladen
- [ ] JavaScript wird ohne Konsolenfehler ausgeführt
- [ ] Template-Overrides werden korrekt gerendert
- [ ] Modul funktioniert mit dem Malibu Theme
- [ ] Modul funktioniert mit dem Honeygrid Theme (wenn "All" als Ziel)

### Admin Overloads (falls zutreffend)
- [ ] Bestelldetailseite zeigt eigene Inhalte
- [ ] Keine PHP-Fehler im Admin-Bereich

### Cronjobs (falls zutreffend)
- [ ] Cronjob erscheint unter Admin > Toolbox > Cronjobs
- [ ] Cronjob wird ohne Fehler ausgeführt
- [ ] Logs werden korrekt geschrieben

## Häufige Probleme

### Modul erscheint nicht im Module Center
- Prüfe ob `GXModule.json` existiert und gültiges JSON ist
- Shop-Cache leeren
- Dateiberechtigungen prüfen (Webserver muss die Dateien lesen können)

### Übersetzungen werden als Rohschlüssel angezeigt
- Prüfe ob der Dateiname zum Sektionspräfix passt (z.B. `mein_modul.lang.inc.php` für Schlüssel wie `mein_modul.PAGE_TITLE`)
- Prüfe auf PHP-Syntaxfehler in der Sprachdatei
- Shop-Cache leeren

### Overloads funktionieren nicht
- Prüfe ob der Verzeichnisname exakt dem Zielklassennamen entspricht
- Prüfe ob deine Klasse `{KlassenName}_parent` erweitert
- Prüfe ob die Datei die Endung `.inc.php` hat
- Shop-Cache leeren

### Theme-Änderungen nicht sichtbar
- Shop-Cache leeren (Gambio baut Themes in ein temporäres Verzeichnis)
- Prüfe ob die Dateien im korrekten `Shop/Themes/All/` Pfad liegen
- Prüfe ob Verzeichnisnamen für JavaScript exakt dem Seitennamen entsprechen

## Nächste Schritte

- [Veröffentlichung](./veroeffentlichung-guide.md): Dein getestetes Modul im Store einreichen
- [Release Checkliste](./release-checkliste.md): Alles vor dem Release prüfen
