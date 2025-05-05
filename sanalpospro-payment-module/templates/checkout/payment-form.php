<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * SanalPosPRO Payment Form Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/sanalpospro/checkout/payment-form.php.
 *
 * @package SanalPosPRO
 * @version 0.1.2
 */
?>

<div id="sppro-payment-form" class="sppro-payment-form">
    <?php if (!empty($description)) : ?>
        <div class="sppro-payment-description">
            <?php echo wp_kses_post(wpautop(wp_kses_post($description))); ?>
        </div>
    <?php endif; ?>
</div> 