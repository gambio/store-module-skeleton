# Release Checklist

Verify these items before creating a GitHub release.

## Structure

- [ ] `store.json` exists in the project root
- [ ] `GXModule.json` exists in `src/GXModules/{Vendor}/{Module}/`
- [ ] All directories contain an `index.html` file
- [ ] No temporary files, IDE config, or `.DS_Store` files included

## Metadata

- [ ] `store.json` has correct `name`, `code`, and `type`
- [ ] `title` has both `en` and `de` entries
- [ ] `vendor` information is complete
- [ ] `requirements` specify minimum shop, PHP, and MySQL versions
- [ ] `.assets/module_logo` exists (PNG, JPG, or SVG)
- [ ] `.assets/vendor_logo` exists (PNG, JPG, or SVG)

## Translations

- [ ] German language file exists in `Admin/TextPhrases/german/`
- [ ] English language file exists in `Admin/TextPhrases/english/`
- [ ] All keys referenced in `GXModule.json` have translations
- [ ] All keys referenced in `.menu.json` have translations
- [ ] Cronjob translation files exist (if using cronjobs)

## Functionality

- [ ] Module installs without errors
- [ ] Module uninstalls without errors
- [ ] Configuration page renders all fields correctly
- [ ] Configuration values are saved and loaded correctly
- [ ] All buttons and actions work
- [ ] Overloads call `parent::proceed()` (or equivalent parent method)
- [ ] Storefront CSS/JS loads on the correct pages
- [ ] Cronjobs execute without errors (if applicable)

## Code Quality

- [ ] No hardcoded paths or URLs
- [ ] No debug output (`var_dump`, `print_r`, `console.log`)
- [ ] No credentials or API keys committed
- [ ] PHP namespace matches the directory structure
- [ ] Error handling for external API calls

## Final Steps

- [ ] Developer mode disabled (`dev-environment` file removed)
- [ ] All changes committed and pushed
- [ ] Version tag follows semantic versioning (`vX.Y.Z`)
- [ ] GitHub release created with release notes
- [ ] Module imported in the Developer Portal
