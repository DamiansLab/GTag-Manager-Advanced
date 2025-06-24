GtagManagerAdvanced Module for PrestaShop
Overview
GtagManagerAdvanced is a PrestaShop module designed to integrate Google Analytics 4 (GA4) Measurement ID with advanced Google Consent Mode support. It also provides a multilingual cookie consent banner (Greek and English) that can be customized from the admin panel.
Features
    • Easy integration of GA4 Measurement ID via admin settings.
    • Multilingual cookie consent banner with customizable text for Greek and English.
    • Automatic insertion of Google Tag Manager script in the website header.
    • Displays cookie consent banner in the footer.
    • Uses Bootstrap for a modern admin configuration UI.
    • Supports Google Consent Mode to respect user privacy choices.
Installation
    1. Upload the `gtagmanageradvanced` module folder to your PrestaShop `/modules/` directory.
    2. Go to the PrestaShop Back Office → Modules → Module Manager.
    3. Find GtagManagerAdvanced and click Install.
    4. Upon installation, default settings will be initialized:
    5.  - GA4 Measurement ID: `G-XXXXXXXXXX`
    6.  - Cookie banner text in Greek and English with default messages.
Configuration
    7. In Back Office, navigate to Modules → Module Manager → GtagManagerAdvanced.
    8. Click Configure.
    9. Fill in the following fields:
    10.  - GA4 Measurement ID: Your Google Analytics 4 Measurement ID (e.g., `G-XXXXXXX`).
    11.  - Cookie Banner Text (Greek): Text displayed in the consent banner for Greek visitors.
    12.  - Cookie Banner Text (English): Text displayed in the consent banner for English visitors.
    13. Click Save to apply changes.
How It Works
The module injects the Google Analytics tracking script (`gtag.js`) into your website’s <head> section using the GA4 Measurement ID you provide. It displays a cookie consent banner at the footer of your site, showing the text in the user’s language (Greek or English). Supports Google Consent Mode, allowing you to manage user consent for analytics and advertising cookies. Settings are stored in PrestaShop’s configuration system and persist across upgrades and cache clears.
Files Included
    • `gtagmanageradvanced.php` — main module PHP file with all module logic.
    • `views/templates/hook/header.tpl` — Smarty template for adding `gtag.js` script.
    • `views/templates/hook/displayFooter.tpl` — Smarty template for cookie consent banner.
    • Other standard PrestaShop module files (`config.xml`, `logo.png`, etc. if applicable).
Notes & Recommendations
    • Replace the default GA4 Measurement ID (`G-XXXXXXXXXX`) with your actual ID before going live.
    • Customize the cookie banner text to suit your site's privacy policy and compliance requirements.
    • Ensure your theme supports the hooks `displayHeader` and `displayFooter`. If not, you may need to adjust template files.
    • For full GDPR compliance, consider integrating additional consent management tools or extensions if needed.
Troubleshooting
    • Module not showing banner or scripts? Check that the hooks `displayHeader` and `displayFooter` are properly implemented in your theme templates.
    • Settings not saving? Ensure your user account has sufficient permissions and cache is cleared after saving.
    • Translation issues? The module supports only Greek and English banner texts by default. You can extend it by adding more language fields in the code if necessary.
Changelog
v1.1.0 — Initial release with multilingual banner and GA4 integration.
Support & Contact
Developed by Damian
Website: damianslab.gr
Email: iliaskdamianidis@gmail.com
