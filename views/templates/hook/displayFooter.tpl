{**
 * GTag Manager Advanced - Google Consent Mode, GA4 and Google Ads conversion tracking for PrestaShop.
 *
 * @author    DamiansLab <https://damianslab.gr>
 * @copyright 2025 DamiansLab (Ηλίας Δαμιανίδης)
 * @license   Proprietary, see license.txt (DamiansLab End User License Agreement)
 *}
<div id="cookie-banner" style="position:fixed;bottom:0;left:0;right:0;background:#222;color:#fff;padding:1em;z-index:9999;text-align:center;display:none;">
  <span id="cookie-message"></span> 
  <button onclick="acceptCookies()" style="margin-left:15px; cursor:pointer;">Αποδοχή / Accept</button>
</div>

<script>
{literal}
  // Βοηθητική συνάρτηση για να διαβάζει cookies/storage
  const getConsentStatus = () => localStorage.getItem('gtagAdvancedConsent');

  document.addEventListener("DOMContentLoaded", function() {
      const langAttr = document.documentElement.lang || 'el';
      const lang = langAttr.substring(0, 2); // Παίρνουμε μόνο τα 2 πρώτα γράμματα (π.χ. από el-GR -> el)
      
      const messages = {
          el: '{/literal}{$banner_text_el|escape:"html":"UTF-8"}{literal}',
          en: '{/literal}{$banner_text_en|escape:"html":"UTF-8"}{literal}'
      };
      
      // Fallback σε EL αν δεν βρεθεί η γλώσσα
      const messageText = messages[lang] || messages['el'];
      const msgSpan = document.getElementById('cookie-message');
      if(msgSpan) msgSpan.textContent = messageText;

      // Αν ΔΕΝ υπάρχει συγκατάθεση, εμφάνισε το banner
      if (getConsentStatus() !== 'true') {
          document.getElementById('cookie-banner').style.display = 'block';
      } else {
          // Αν ΥΠΑΡΧΕΙ ήδη συγκατάθεση από προηγούμενη σελίδα, τρέξε το update αμέσως
          runConsentUpdate();
      }
  });

  function acceptCookies() {
      localStorage.setItem('gtagAdvancedConsent', 'true');
      document.getElementById('cookie-banner').style.display = 'none';
      runConsentUpdate();
  }

  function runConsentUpdate() {
      gtag('consent', 'update', {
        'ad_storage': 'granted',
        'ad_user_data': 'granted',       // ΝΕΟ για v2
        'ad_personalization': 'granted', // ΝΕΟ για v2
        'analytics_storage': 'granted',
        'functionality_storage': 'granted',
        'personalization_storage': 'granted',
        'security_storage': 'granted'
      });
      // ΠΡΟΣΟΧΗ: ΔΕΝ καλούμε ξανά το gtag('config'). 
      // Το update αρκεί για να ενεργοποιήσει το tracking.
  }
{/literal}
</script>