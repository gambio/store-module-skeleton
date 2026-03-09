# Local Testing

How to install and test your module in a local Gambio shop before publishing.

## Installation

1. Copy your module directory into the shop:

   ```
   cp -r src/GXModules/AcmeCorp /var/www/gambio-shop/GXModules/AcmeCorp
   ```

2. Clear the shop cache:
   - Admin > Toolbox > Cache > Clear all
   - Or delete the `cache/` directory contents manually

3. Go to **Admin > Modules > Module Center** and find your module in the list.

4. Click **Install** to activate it.

## Developer Mode

Create an empty file named `.dev-environment` in the shop root to enable developer mode:

```bash
touch /var/www/gambio-shop/.dev-environment
```

Developer mode:
- Shows detailed PHP error messages
- Disables template caching
- Enables debug output

To disable developer mode, delete the file:

```bash
rm /var/www/gambio-shop/.dev-environment
```

**Important:** Always disable developer mode before deploying to production or creating a release.

## Testing Checklist

### Module Center
- [ ] Module appears in the Module Center list
- [ ] Title and description are displayed correctly
- [ ] Module can be installed without errors
- [ ] Module can be uninstalled without errors
- [ ] Re-installation works (install > uninstall > install)

### Configuration Page
- [ ] All configuration fields are rendered correctly
- [ ] Required fields show validation errors when empty
- [ ] Saving configuration works
- [ ] Default values are applied on first install
- [ ] Tooltips are displayed
- [ ] Buttons trigger the correct actions
- [ ] Modals open and close properly

### Translations
- [ ] German translations appear when shop language is German
- [ ] English translations appear when shop language is English
- [ ] No missing translation keys (shown as raw keys like `my_module.LABEL_XYZ`)

### Storefront (if applicable)
- [ ] CSS is loaded on the correct pages
- [ ] JavaScript executes without console errors
- [ ] Template overrides render correctly
- [ ] Module works with Malibu theme
- [ ] Module works with Honeygrid theme (if targeting "All" themes)

### Admin Overloads (if applicable)
- [ ] Order detail page shows custom content
- [ ] No PHP errors in admin area

### Cronjobs (if applicable)
- [ ] Cronjob appears in Admin > Toolbox > Cronjobs
- [ ] Cronjob executes without errors
- [ ] Logs are written correctly

## Common Issues

### Module not appearing in Module Center
- Check that `GXModule.json` exists and is valid JSON
- Clear the shop cache
- Check file permissions (web server must be able to read the files)

### Translations showing as raw keys
- Verify the language file name matches the section prefix (e.g. `my_module.lang.inc.php` for keys like `my_module.PAGE_TITLE`)
- Check for PHP syntax errors in the language file
- Clear the shop cache

### Overloads not working
- Verify the directory name matches the target class name exactly
- Check that your class extends `{ClassName}_parent`
- Verify the file uses `.inc.php` extension
- Clear the shop cache

### Theme changes not visible
- Clear the shop cache (Gambio builds themes into a temporary directory)
- Check that files are in the correct `Shop/Themes/All/` path
- Verify directory names for JavaScript match the page name exactly

## Next Steps

- [Publishing Guide](./publishing-guide.md): Submit your tested module to the Store
- [Release Checklist](./release-checklist.md): Verify everything before release
