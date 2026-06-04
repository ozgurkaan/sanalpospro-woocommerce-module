<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * SanalPosPRO Modern Installment Theme Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/sanalpospro/installment_theme/modern.php.
 *
 * @package SanalPosPRO
 * @version 10.1.0
 */

// Enqueue CSS file
wp_enqueue_style(
    'sanalpospro-installment-modern',
    SPPRO_PLUGIN_URL . 'assets/css/installment-modern.css',
    array(),
    SPPRO_VERSION
);

// Enqueue JS file
wp_enqueue_script(
    'sanalpospro-installment-modern',
    SPPRO_PLUGIN_URL . 'assets/js/installment-modern.js',
    array('jquery'),
    SPPRO_VERSION,
    true
);

global $product;
if (!$product) return;

$sppro_price = $product->get_price();
$sppro_installments = json_decode(empty($installments) ? '[]' : $installments, true);

$sppro_all_card_families = [
    'world', 'axess', 'bonus', 'cardfinans', 'maximum',
    'paraf', 'saglamcard', 'advantage', 'combo', 'miles-smiles'
];

?>

<div class="sppro-installment-container">
    <div class="sppro-installment-tabs">
        <div class="sppro-tab-header">
            <?php foreach($sppro_all_card_families as $sppro_card_key) : 
                $sppro_has_any_installment = false;
                
                
                if(!empty($sppro_installments[$sppro_card_key])) {
                    $sppro_card_installments = array_filter($sppro_installments[$sppro_card_key], function($sppro_inst) {
                        return $sppro_inst['gateway'] !== 'off';
                    });

                    if(!empty($sppro_card_installments)) {
                        $sppro_has_any_installment = true;
                    }
                }
                
               
                if (!$sppro_has_any_installment) continue;
            ?>
                <div class="sppro-tab-item" data-tab="<?php echo esc_attr($sppro_card_key); ?>">
                    <?php echo wp_kses_post(sppro_get_card_image($sppro_card_key, ['style' => 'height: 30px;'])); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="sppro-tab-content">
            <?php foreach($sppro_all_card_families as $sppro_card_key) : 
                $sppro_has_any_installment = false;
                
               
                if(!empty($sppro_installments[$sppro_card_key])) {
                    $sppro_card_installments = array_filter($sppro_installments[$sppro_card_key], function($sppro_inst) {
                        return $sppro_inst['gateway'] !== 'off';
                    });

                    if(!empty($sppro_card_installments)) {
                        $sppro_has_any_installment = true;
                    }
                }
                
                
                if (!$sppro_has_any_installment) continue;
            ?>
                <div class="sppro-tab-pane" data-tab-content="<?php echo esc_attr($sppro_card_key); ?>">
                    <table class="sppro-installment-table">
                        <thead>
                            <tr>
                                <th><?php esc_html_e('Installment', 'sanalpospro-payment-module'); ?></th>
                                <th><?php esc_html_e('Monthly Payment', 'sanalpospro-payment-module'); ?></th>
                                <th><?php esc_html_e('Total', 'sanalpospro-payment-module'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            for($sppro_i = 1; $sppro_i <= 12; $sppro_i++) {
                                $sppro_installment_exists = false;
                                $sppro_monthly_payment = '-';
                                $sppro_total_amount = '-';

                                foreach($sppro_card_installments as $sppro_installment) {
                                    if($sppro_installment['months'] == $sppro_i) {
                                        $sppro_installment_exists = true;
                                        if($sppro_i == 1 && $sppro_installment['buyer_fee_percent'] == 0) {
                                            $sppro_total = $sppro_price;
                                            $sppro_monthly = $sppro_total;
                                        } else {
                                            $sppro_total = ($sppro_price * 100) / (100 - $sppro_installment['buyer_fee_percent']);
                                            $sppro_monthly = $sppro_total/$sppro_i;
                                        }
                                        $sppro_monthly_payment = wp_kses_post(wc_price($sppro_monthly));
                                        $sppro_total_amount = wp_kses_post(wc_price($sppro_total));
                                        break;
                                    }
                                }

                                echo '<tr>';
                                echo '<td>' . ($sppro_i == 1 ? 
                                     esc_html__('Cash', 'sanalpospro-payment-module') : 
                                     sprintf(
                                         /* translators: %d: Installment number */
                                         esc_html__('%d. Installment', 'sanalpospro-payment-module'),
                                         esc_html($sppro_i)
                                     )) . '</td>';
                                echo '<td>' . wp_kses_post($sppro_monthly_payment) . '</td>';
                                echo '<td>' . wp_kses_post($sppro_total_amount) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="sppro-installment-note">
        <p><?php esc_html_e('* Installment amounts are estimated and may vary according to your bank\'s campaigns and interest rates.', 'sanalpospro-payment-module'); ?></p>
    </div>
</div>
