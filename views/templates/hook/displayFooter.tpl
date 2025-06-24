<div id="cookie-banner" style="position:fixed;bottom:0;left:0;right:0;background:#222;color:#fff;padding:1em;z-index:9999;text-align:center;">
  <span id="cookie-message"></span> <button onclick="acceptCookies()">Αποδοχή / Accept</button>
</div>

<script>
  const lang = document.documentElement.lang || 'el';
  const messages = {
    el: '{$banner_text_el|escape:"html"}',
    en: '{$banner_text_en|escape:"html"}'
  };
  document.getElementById('cookie-message').textContent = messages[lang] || messages['el'];

  function acceptCookies() {
    gtag('consent', 'update', {
      'ad_storage': 'granted',
      'analytics_storage': 'granted',
      'functionality_storage': 'granted',
      'personalization_storage': 'granted',
      'security_storage': 'granted'
    });
    gtag('config', '{$gtag_id|escape:"html"}');
    document.getElementById('cookie-banner').style.display = 'none';
    localStorage.setItem('gtagAdvancedConsent', 'true');
  }

  if (localStorage.getItem('gtagAdvancedConsent') === 'true') {
    gtag('consent', 'update', {
      'ad_storage': 'granted',
      'analytics_storage': 'granted',
      'functionality_storage': 'granted',
      'personalization_storage': 'granted',
      'security_storage': 'granted'
    });
    gtag('config', '{$gtag_id|escape:"html"}');
    document.getElementById('cookie-banner')?.remove();
  }
</script>
