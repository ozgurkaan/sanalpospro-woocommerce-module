<?php
/**
 * Admin page template
 *
 * @package SanalPosPRO
 */
use Eticsoft\Sanalpospro\EticConfig;

defined('ABSPATH') || exit;
?>
<div class="wrap sppro-admin-wrap">
    <div id="root"
         data-token="<?php echo esc_attr(EticConfig::get('SANALPOSPRO_ACCESS_TOKEN')); ?>"
         data-platform="woocommerce"
         data-website="<?php echo esc_url($site_url); ?>"
         data-app-id="103"
         data-program-id="1">
    </div>
</div>
