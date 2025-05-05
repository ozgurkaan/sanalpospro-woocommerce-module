<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * SanalPosPRO Modern Installment Theme Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/sanalpospro/installment_theme/modern.php.
 *
 * @package SanalPosPRO
 * @version 0.1.2
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

$price = $product->get_price();
$installments = json_decode(empty($installments) ? '[]' : $installments, true);
//print_r($installments);

$all_card_families = [
    'world', 'axess', 'bonus', 'cardfinans', 'maximum',
    'paraf', 'saglamcard', 'advantage', 'combo', 'miles-smiles'
];

?>

<div class="sppro-installment-container">
    <div class="sppro-installment-tabs">
        <div class="sppro-tab-header">
            <?php foreach($all_card_families as $card_key) : 
                $has_any_installment = false;
                
                
                if(!empty($installments[$card_key])) {
                    $card_installments = array_filter($installments[$card_key], function($installment) {
                        return $installment['gateway'] !== 'off';
                    });

                    if(!empty($card_installments)) {
                        $has_any_installment = true;
                    }
                }
                
               
                if (!$has_any_installment) continue;
            ?>
                <div class="sppro-tab-item" data-tab="<?php echo esc_attr($card_key); ?>">
                    <?php echo wp_kses_post(sppro_get_card_image($card_key, ['style' => 'height: 30px;'])); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="sppro-tab-content">
            <?php foreach($all_card_families as $card_key) : 
                $has_any_installment = false;
                
               
                if(!empty($installments[$card_key])) {
                    $card_installments = array_filter($installments[$card_key], function($installment) {
                        return $installment['gateway'] !== 'off';
                    });

                    if(!empty($card_installments)) {
                        $has_any_installment = true;
                    }
                }
                
                
                if (!$has_any_installment) continue;
            ?>
                <div class="sppro-tab-pane" data-tab-content="<?php echo esc_attr($card_key); ?>">
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
                            for($i = 1; $i <= 12; $i++) {
                                $installment_exists = false;
                                $monthly_payment = '-';
                                $total_amount = '-';

                                foreach($card_installments as $installment) {
                                    if($installment['months'] == $i) {
                                        $installment_exists = true;
                                        if($i == 1 && $installment['gateway_fee_percent'] == 0) {
                                            $total = $price + (($price * $installment['gateway_fee_percent'])/100);
                                            $monthly = $total;
                                        } else {
                                            $total = $price * (1 + $installment['gateway_fee_percent']/100);
                                            $monthly = $total/$i;
                                        }
                                        $monthly_payment = wp_kses_post(wc_price($monthly));
                                        $total_amount = wp_kses_post(wc_price($total));
                                        break;
                                    }
                                }

                                echo '<tr>';
                                echo '<td>' . ($i == 1 ? 
                                     esc_html__('Cash', 'sanalpospro-payment-module') : 
                                     sprintf(
                                         /* translators: %d: Installment number */
                                         esc_html__('%d. Installment', 'sanalpospro-payment-module'),
                                         esc_html($i)
                                     )) . '</td>';
                                echo '<td>' . wp_kses_post($monthly_payment) . '</td>';
                                echo '<td>' . wp_kses_post($total_amount) . '</td>';
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

