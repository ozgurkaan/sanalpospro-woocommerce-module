<?php
if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_style(
    'sanalpospro-installment-classic',
    SPPRO_PLUGIN_URL . 'assets/css/installment-classic.css',
    array(),
    SPPRO_VERSION
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

<div data-sanalpospro-wrapper>
    <div data-sanalpospro-container>
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

            if(!$sppro_has_any_installment) continue;

            echo '<div data-sanalpospro-card>';
            echo '<table data-sanalpospro-table>';
            echo '<thead>';
            echo '<tr>';
            echo '<td colspan="3">';
            echo wp_kses_post(sppro_get_card_image($sppro_card_key));
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="33.33%">' . esc_html__('Installment', 'sanalpospro-payment-module') . '</td>';
            echo '<td width="33.33%">' . esc_html__('Monthly Payment', 'sanalpospro-payment-module') . '</td>';
            echo '<td width="33.33%">' . esc_html__('Total', 'sanalpospro-payment-module') . '</td>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

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

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        endforeach; ?>
    </div>

    <div data-sanalpospro-note>
        <p><?php esc_html_e('* Installment amounts are estimated and may vary according to your bank\'s campaigns and interest rates.', 'sanalpospro-payment-module'); ?></p>
    </div>
</div>