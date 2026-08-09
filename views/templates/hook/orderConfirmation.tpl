<script>
{* Τα JSON έρχονται έτοιμα (json_encode) από το PHP hook — nofilter για να μην γίνουν escape *}
var gtagAdvPurchase = {$gtag_purchase_json nofilter};
{if $gtag_conversion_json}
var gtagAdvConversion = {$gtag_conversion_json nofilter};
{else}
var gtagAdvConversion = null;
{/if}
{literal}
if (typeof gtag === 'function' && gtagAdvPurchase) {
    // GA4 ecommerce purchase — το transaction_id κάνει deduplication σε reload
    gtag('event', 'purchase', gtagAdvPurchase);
    // Google Ads conversion με πραγματική αξία παραγγελίας
    if (gtagAdvConversion) {
        gtag('event', 'conversion', gtagAdvConversion);
    }
}
{/literal}
</script>
