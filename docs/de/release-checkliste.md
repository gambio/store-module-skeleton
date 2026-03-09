# Release Checkliste

Pruefe diese Punkte bevor du ein GitHub Release erstellst.

## Struktur

- [ ] `store.json` existiert im Projekt-Root
- [ ] `GXModule.json` existiert in `src/GXModules/{Vendor}/{Modul}/`
- [ ] Alle Verzeichnisse enthalten eine `index.html` Datei
- [ ] Keine temporaeren Dateien, IDE-Konfigurationen oder `.DS_Store` Dateien enthalten

## Metadaten

- [ ] `store.json` hat korrekte Werte fuer `name`, `code` und `type`
- [ ] `title` hat sowohl `en` als auch `de` Eintraege
- [ ] `vendor` Informationen sind vollstaendig
- [ ] `requirements` geben minimale Shop-, PHP- und MySQL-Versionen an
- [ ] `.assets/module_logo` existiert (PNG, JPG oder SVG)
- [ ] `.assets/vendor_logo` existiert (PNG, JPG oder SVG)

## Uebersetzungen

- [ ] Deutsche Sprachdatei existiert in `Admin/TextPhrases/german/`
- [ ] Englische Sprachdatei existiert in `Admin/TextPhrases/english/`
- [ ] Alle in `GXModule.json` referenzierten Schluessel haben Uebersetzungen
- [ ] Alle in `.menu.json` referenzierten Schluessel haben Uebersetzungen
- [ ] Cronjob-Uebersetzungsdateien existieren (falls Cronjobs verwendet werden)

## Funktionalitaet

- [ ] Modul installiert sich ohne Fehler
- [ ] Modul deinstalliert sich ohne Fehler
- [ ] Konfigurationsseite zeigt alle Felder korrekt an
- [ ] Konfigurationswerte werden gespeichert und geladen
- [ ] Alle Buttons und Aktionen funktionieren
- [ ] Overloads rufen `parent::proceed()` (oder die entsprechende Elternmethode) auf
- [ ] Storefront CSS/JS wird auf den richtigen Seiten geladen
- [ ] Cronjobs werden ohne Fehler ausgefuehrt (falls zutreffend)

## Codequalitaet

- [ ] Keine hartcodierten Pfade oder URLs
- [ ] Keine Debug-Ausgaben (`var_dump`, `print_r`, `console.log`)
- [ ] Keine Zugangsdaten oder API-Schluessel eingecheckt
- [ ] PHP-Namespace stimmt mit der Verzeichnisstruktur ueberein
- [ ] Fehlerbehandlung fuer externe API-Aufrufe

## Letzte Schritte

- [ ] Entwicklermodus deaktiviert (`dev-environment` Datei geloescht)
- [ ] Alle Aenderungen committet und gepusht
- [ ] Versions-Tag folgt Semantic Versioning (`vX.Y.Z`)
- [ ] GitHub Release mit Release Notes erstellt
- [ ] Modul im Developer Portal importiert
