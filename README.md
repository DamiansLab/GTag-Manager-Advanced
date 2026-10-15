# GTag Manager Advanced

**Author:** [DamiansLab](https://damianslab.gr) · **Version:** 1.2.0 · **Compatibility:** PrestaShop 1.7 – 8.x · **Languages:** Greek, English

GTag Manager Advanced integrates Google Analytics 4 with Google Consent Mode (Advanced), shows a multilingual cookie consent banner (Greek and English) and sends GA4 ecommerce `purchase` and Google Ads conversion events with the real order values.

## Features

- GA4 Measurement ID set from the module settings.
- Google Consent Mode v2 defaults (everything denied until the visitor accepts) and update on consent.
- Cookie consent banner in the footer, with customizable Greek and English texts.
- GA4 `purchase` event on the order confirmation page, with value, tax, shipping, currency, items and `transaction_id` (order reference) for deduplication.
- Optional Google Ads conversion event (Conversion ID and Label).
- Bootstrap based settings page with the shared DamiansLab header and footer.

## Installation

1. Upload the `gtagmanageradvanced` folder to the `/modules/` directory of your shop.
2. Back Office → Modules → Module Manager → find **GTag Manager Advanced** and click **Install**.
3. Click **Configure** and fill in the settings.

## Configuration

| Setting | Description |
|---|---|
| GA4 Measurement ID | Your GA4 Measurement ID, e.g. `G-XXXXXXXXXX`. |
| Cookie Banner Text (Greek / English) | Text shown in the consent banner, per language. |
| Google Ads Conversion ID | Format `AW-XXXXXXXXXX`. Empty = Google Ads conversion tracking disabled. |
| Google Ads Conversion Label | Label of the purchase conversion action in Google Ads. |

## Files

```
gtagmanageradvanced/
├── gtagmanageradvanced.php        main module class
├── config.xml                     generated from the class
├── license.txt                    DamiansLab End User License Agreement
├── logo.png
├── upgrade/upgrade-1.2.0.php
└── views/
    ├── css/dl-chrome.css          shared DamiansLab header and footer styles
    └── templates/hook/
        ├── header.tpl             gtag.js and Consent Mode defaults
        ├── displayFooter.tpl      consent banner
        ├── orderConfirmation.tpl  GA4 purchase and Google Ads conversion
        ├── module_header.tpl      shared header
        └── module_footer.tpl      shared footer
```

## Troubleshooting

- No banner or scripts: check that your theme calls the `displayHeader` and `displayFooter` hooks.
- No purchase events: check that your theme calls the `displayOrderConfirmation` hook.
- Settings not saving: check the employee permissions and clear the cache.

## Changelog

- 1.2.0: GA4 `purchase` and Google Ads conversion tracking with real order values.
- 1.1.0: Initial release with multilingual banner and GA4 integration.

## Credits and license

Licensed, not sold, under the DamiansLab End User License Agreement: see [license.txt](license.txt). One license covers one production shop; copying, redistribution and modification are not allowed.

No third-party component is bundled. The module loads Google's `gtag.js` from Google servers; Google is not affiliated with DamiansLab.

## Support and contact

**DamiansLab &mdash; Web Development & 3D Printing**
Ηλίας Δαμιανίδης · Full stack developer

- Website: <https://damianslab.gr>
- Contact: <https://damianslab.gr/contact>
- Email: <iliaskdamianidis@gmail.com>
- Instagram: <https://instagram.com/damianslab>
- GitHub: <https://github.com/DamiansLab>
