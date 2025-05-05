<?php
/**
 * Admin page template
 *
 * @package SanalPosPRO
 */

defined('ABSPATH') || exit;
?>
<div class="wrap sppro-admin-wrap">
    <div id="paythor-container"
         data-token="<?php echo esc_attr($token); ?>"
         data-platform="wooCommerce"
         data-website="<?php echo esc_url($site_url); ?>"
         data-app-id="103"
         data-program-id="1">
    </div>
</div>
