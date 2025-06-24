<p><span style="color: #17365d;"><span style="font-family: Calibri, serif;"><span style="font-size: xx-large;">GtagManagerAdvanced Module for PrestaShop</span></span></span></p>
<h1 class="western">Overview</h1>
<p>GtagManagerAdvanced is a PrestaShop module designed to integrate Google Analytics 4 (GA4) Measurement ID with advanced Google Consent Mode support. It also provides a multilingual cookie consent banner (Greek and English) that can be customized from the admin panel.</p>
<h1 class="western">Features</h1>
<ul>
<li>
<p>Easy integration of GA4 Measurement ID via admin settings.</p>
</li>
<li>
<p>Multilingual cookie consent banner with customizable text for Greek and English.</p>
</li>
<li>
<p>Automatic insertion of Google Tag Manager script in the website header.</p>
</li>
<li>
<p>Displays cookie consent banner in the footer.</p>
</li>
<li>
<p>Uses Bootstrap for a modern admin configuration UI.</p>
</li>
<li>
<p>Supports Google Consent Mode to respect user privacy choices.</p>
</li>
</ul>
<h1 class="western">Installation</h1>
<ol>
<li>
<p>Upload the `gtagmanageradvanced` module folder to your PrestaShop `/modules/` directory.</p>
</li>
<li>
<p>Go to the PrestaShop Back Office &rarr; Modules &rarr; Module Manager.</p>
</li>
<li>
<p>Find GtagManagerAdvanced and click Install.</p>
</li>
<li>
<p>Upon installation, default settings will be initialized:</p>
</li>
<li>
<p>- GA4 Measurement ID: `G-XXXXXXXXXX`</p>
</li>
<li>
<p>- Cookie banner text in Greek and English with default messages.</p>
</li>
</ol>
<h1 class="western">Configuration</h1>
<ol start="7">
<li>
<p>In Back Office, navigate to Modules &rarr; Module Manager &rarr; GtagManagerAdvanced.</p>
</li>
<li>
<p>Click Configure.</p>
</li>
<li>
<p>Fill in the following fields:</p>
</li>
<li>
<p>- GA4 Measurement ID: Your Google Analytics 4 Measurement ID (e.g., `G-XXXXXXX`).</p>
</li>
<li>
<p>- Cookie Banner Text (Greek): Text displayed in the consent banner for Greek visitors.</p>
</li>
<li>
<p>- Cookie Banner Text (English): Text displayed in the consent banner for English visitors.</p>
</li>
<li>
<p>Click Save to apply changes.</p>
</li>
</ol>
<h1 class="western">How It Works</h1>
<p>The module injects the Google Analytics tracking script (`gtag.js`) into your website&rsquo;s &lt;head&gt; section using the GA4 Measurement ID you provide. It displays a cookie consent banner at the footer of your site, showing the text in the user&rsquo;s language (Greek or English). Supports Google Consent Mode, allowing you to manage user consent for analytics and advertising cookies. Settings are stored in PrestaShop&rsquo;s configuration system and persist across upgrades and cache clears.</p>
<h1 class="western">Files Included</h1>
<ul>
<li>
<p>`gtagmanageradvanced.php` &mdash; main module PHP file with all module logic.</p>
</li>
<li>
<p>`views/templates/hook/header.tpl` &mdash; Smarty template for adding `gtag.js` script.</p>
</li>
<li>
<p>`views/templates/hook/displayFooter.tpl` &mdash; Smarty template for cookie consent banner.</p>
</li>
<li>
<p>Other standard PrestaShop module files (`config.xml`, `logo.png`, etc. if applicable).</p>
</li>
</ul>
<h1 class="western">Notes &amp; Recommendations</h1>
<ul>
<li>
<p>Replace the default GA4 Measurement ID (`G-XXXXXXXXXX`) with your actual ID before going live.</p>
</li>
<li>
<p>Customize the cookie banner text to suit your site's privacy policy and compliance requirements.</p>
</li>
<li>
<p>Ensure your theme supports the hooks `displayHeader` and `displayFooter`. If not, you may need to adjust template files.</p>
</li>
<li>
<p>For full GDPR compliance, consider integrating additional consent management tools or extensions if needed.</p>
</li>
</ul>
<h1 class="western">Troubleshooting</h1>
<ul>
<li>
<p>Module not showing banner or scripts? Check that the hooks `displayHeader` and `displayFooter` are properly implemented in your theme templates.</p>
</li>
<li>
<p>Settings not saving? Ensure your user account has sufficient permissions and cache is cleared after saving.</p>
</li>
<li>
<p>Translation issues? The module supports only Greek and English banner texts by default. You can extend it by adding more language fields in the code if necessary.</p>
</li>
</ul>
<h1 class="western">Changelog</h1>
<p>v1.1.0 &mdash; Initial release with multilingual banner and GA4 integration.</p>
<h1 class="western">Support &amp; Contact</h1>
<p>Developed by Damian</p>
<p>Website: damianslab.gr</p>
<p>Email: iliaskdamianidis@gmail.com</p>
