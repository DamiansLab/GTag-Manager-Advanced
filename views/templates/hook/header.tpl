{literal}
<!-- Google tag (gtag.js) -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'analytics_storage': 'denied',
    'functionality_storage': 'denied',
    'personalization_storage': 'denied',
    'security_storage': 'granted',
    'wait_for_update': 500
  });
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id={/literal}{$gtag_id|escape:'html'}{literal}"></script>
<script>
  gtag('js', new Date());
  gtag('config', '{/literal}{$gtag_id|escape:'html'}{literal}');
</script>
{/literal}
