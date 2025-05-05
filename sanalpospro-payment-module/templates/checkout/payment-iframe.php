<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * SanalPosPRO Payment iFrame Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/sanalpospro/checkout/payment-iframe.php.
 *
 * @package SanalPosPRO
 * @version 0.1.2
 */
?>

<div id="payment-iframe-container" class="sppro-iframe-container">
    <div class="sppro-iframe-wrapper">
        <div class="sppro-iframe-header">
            <div class="sppro-header-spacer"></div>
            <button type="button" class="sppro-close-iframe" onclick="document.getElementById('payment-iframe-container').remove()">
                <?php esc_html_e('×', 'sanalpospro-payment-module'); ?>
            </button>
        </div>
        
        <div class="sppro-iframe-content">
            <div class="sppro-loading">
                <div class="sppro-spinner"></div>
                <p><?php esc_html_e('Loading payment page...', 'sanalpospro-payment-module'); ?></p>
            </div>
            <iframe 
                src="<?php echo esc_url($payment_link); ?>" 
                class="sppro-payment-iframe" 
                frameborder="0" 
                allow="payment" 
                onload="document.querySelector('.sppro-loading').style.display = 'none';"
            ></iframe>
        </div>
    </div>
</div> 