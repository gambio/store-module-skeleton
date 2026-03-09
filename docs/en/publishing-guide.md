# Publishing Guide

How to submit your module to the Gambio App Store.

## Prerequisites

- A tested, working module (see [Local Testing](./local-testing.md))
- A GitHub account or organization
- A valid `store.json` in the project root (see [store.json Reference](./store-json-reference.md))
- Store assets in `.assets/` (logos, description)

## Step 1: Register as a Developer

Developer registration is currently handled manually. Send an email to **info@gambio.de** with the link to your GitHub repository. Gambio will set up your developer account.

> **Note:** A self-service Developer Portal is coming soon. Until then, developer onboarding is handled via email.

## Step 2: Set Up Your GitHub Repository

1. Create a **new repository** on GitHub (can be private)
2. Push your module code following the skeleton structure:
   ```
   .assets/
   src/GXModules/{Vendor}/{Module}/
   store.json
   ```
3. Make sure `store.json` is in the repository root

## Step 3: Install the Gambio Store GitHub App

Install the [Gambio Store GitHub App](https://github.com/apps/gambio-store) on your repository or GitHub organization. This allows the Store system to read your repository.

## Step 4: Create a GitHub Release

1. Go to your repository on GitHub
2. Click **Releases > Create a new release**
3. Create a version tag (e.g. `v1.0.0`)
4. Add release notes describing the module
5. Publish the release

The tag version should follow [Semantic Versioning](https://semver.org/) (e.g. `v1.0.0`, `v1.1.0`, `v2.0.0`).

## Step 5: Submit Your Module for Review

Send an email to **info@gambio.de** with the link to your GitHub repository. Include the version tag you want reviewed.

Gambio reviews submitted modules before they appear in the Store. The review checks:

- Module installs and uninstalls cleanly
- No security issues
- Store metadata is complete and correct
- Module functions as described

After approval, your module appears in the Gambio App Store.

## Updating Your Module

To publish an update:

1. Make your changes and push to the repository
2. Create a new GitHub release with an incremented version tag
3. Notify Gambio via email (**info@gambio.de**) about the new release

## Store Assets

### Required

| File | Description |
|------|-------------|
| `.assets/module_logo(.png\|.jpg\|.svg)` | Module logo displayed in the Store |
| `.assets/vendor_logo(.png\|.jpg\|.svg)` | Your company/developer logo |

### Optional

| File | Description |
|------|-------------|
| `.assets/de/description.html` | German HTML description (overrides store.json) |
| `.assets/en/description.html` | English HTML description (overrides store.json) |
| `.assets/screenshot.png` | Screenshots referenced in the description HTML |

### Referencing Images in Descriptions

Use bracket notation to embed images from `.assets/` in your description HTML:

```html
<img src="[screenshot.png]" class="img-fluid w-100">
```

## Next Steps

- [Release Checklist](./release-checklist.md): Verify everything before release
