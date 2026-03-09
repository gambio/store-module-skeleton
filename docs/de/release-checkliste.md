# Release Checkliste

Prüfe diese Punkte bevor du ein GitHub Release erstellst.

## Struktur

- [ ] `store.json` existiert im Projekt-Root
- [ ] `GXModule.json` existiert in `src/GXModules/{Vendor}/{Modul}/`
- [ ] Alle Verzeichnisse enthalten eine `index.html` Datei
- [ ] Keine temporären Dateien, IDE-Konfigurationen oder `.DS_Store` Dateien enthalten

## Metadaten

- [ ] `store.json` hat korrekte Werte für `name`, `code` und `type`
- [ ] `title` hat sowohl `en` als auch `de` Einträge
- [ ] `vendor` Informationen sind vollständig
- [ ] `requirements` geben minimale Shop-, PHP- und MySQL-Versionen an
- [ ] `.assets/module_logo` existiert (PNG, JPG oder SVG)
- [ ] `.assets/vendor_logo` existiert (PNG, JPG oder SVG)

## Übersetzungen

- [ ] Deutsche Sprachdatei existiert in `Admin/TextPhrases/german/`
- [ ] Englische Sprachdatei existiert in `Admin/TextPhrases/english/`
- [ ] Alle in `GXModule.json` referenzierten Schlüssel haben Übersetzungen
- [ ] Alle in `.menu.json` referenzierten Schlüssel haben Übersetzungen
- [ ] Cronjob-Übersetzungsdateien existieren (falls Cronjobs verwendet werden)

## Funktionalität

- [ ] Modul installiert sich ohne Fehler
- [ ] Modul deinstalliert sich ohne Fehler
- [ ] Konfigurationsseite zeigt alle Felder korrekt an
- [ ] Konfigurationswerte werden gespeichert und geladen
- [ ] Alle Buttons und Aktionen funktionieren
- [ ] Overloads rufen `parent::proceed()` (oder die entsprechende Elternmethode) auf
- [ ] Storefront CSS/JS wird auf den richtigen Seiten geladen
- [ ] Cronjobs werden ohne Fehler ausgeführt (falls zutreffend)

## Codequalität

- [ ] Keine hartcodierten Pfade oder URLs
- [ ] Keine Debug-Ausgaben (`var_dump`, `print_r`, `console.log`)
- [ ] Keine Zugangsdaten oder API-Schlüssel eingecheckt
- [ ] PHP-Namespace stimmt mit der Verzeichnisstruktur überein
- [ ] Fehlerbehandlung für externe API-Aufrufe

## Letzte Schritte

- [ ] Entwicklermodus deaktiviert (`.dev-environment` Datei gelöscht)
- [ ] Alle Änderungen committet und gepusht
- [ ] Versions-Tag folgt Semantic Versioning (`vX.Y.Z`)
- [ ] GitHub Release mit Release Notes erstellt
- [ ] Modul per E-Mail an **info@gambio.de** eingereicht
