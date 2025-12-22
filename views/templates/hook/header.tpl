{literal}
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}

  // Ορισμός Default (Όλα denied αρχικά)
  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'ad_user_data': 'denied',         // ΝΕΟ για v2
    'ad_personalization': 'denied',   // ΝΕΟ για v2
    'analytics_storage': 'denied',
    'functionality_storage': 'denied',
    'personalization_storage': 'denied',
    'security_storage': 'granted',    // Συνήθως granted για ασφάλεια
    'wait_for_update': 500
  });
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id={/literal}{$gtag_id|escape:'html':'UTF-8'}{literal}"></script>
<script>
  gtag('js', new Date());
  // Καλούμε το config ΜΙΑ φορά εδώ. Αν είναι denied, δεν στέλνει cookies.
  // Αν γίνει update αργότερα, στέλνει τα pings αυτόματα.
  gtag('config', '{/literal}{$gtag_id|escape:'html':'UTF-8'}{literal}');
</script>
{/literal}