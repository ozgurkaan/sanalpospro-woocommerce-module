<?php
if (!defined('ABSPATH')) {
    exit;
}
include_once SPPRO_PLUGIN_DIR . 'vendor/include.php';
use Eticsoft\Sanalpospro\EticConfig;

class SPPRO_Admin {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
       
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function enqueue_admin_scripts($hook) {
        if ('woocommerce_page_sppro_admin' !== $hook) {
            return;
        }

        // Enqueue admin CSS
        wp_enqueue_style(
            'sppro-admin-style',
            SPPRO_PLUGIN_URL . 'admin/css/admin.css',
            array(),
            SPPRO_VERSION
        );
        
        // Enqueue Paythor dashboard style
        wp_enqueue_style(
            'paythor-dashboard-style', 
            SPPRO_PLUGIN_URL . 'admin/css/index.css', 
            array(), 
            SPPRO_VERSION
        );

        // Enqueue admin settings script
        wp_register_script('sppro-admin-settings', 
            SPPRO_PLUGIN_URL . 'admin/js/admin-settings.js', 
            array('jquery'),
            SPPRO_VERSION, 
            true
        ); 

        // Prepare settings
        $settings = [
            'order_status' => EticConfig::get('SANALPOSPRO_ORDER_STATUS') ?: 'processing',
            'currency_convert' => EticConfig::get('SANALPOSPRO_CURRENCY_CONVERT') ?: 'no',
            'showInstallmentsTabs' => EticConfig::get('SANALPOSPRO_SHOWINSTALLMENTSTABS') ?: 'no',
            'paymentPageTheme' => EticConfig::get('SANALPOSPRO_PAYMENTPAGETHEME') ?: 'classic',
            'installments' => json_decode(EticConfig::get('SANALPOSPRO_INSTALLMENTS'), true) ?: [],
            'public_key' => EticConfig::get('SANALPOSPRO_PUBLIC_KEY'),
            'secret_key' => EticConfig::get('SANALPOSPRO_SECRET_KEY'),
            'access_token' => EticConfig::get('SANALPOSPRO_ACCESS_TOKEN')
        ];

        // Add inline script with settings
        wp_add_inline_script('sppro-admin-settings', 'window.generalSettings = ' . wp_json_encode([
            'order_status' => [
                'default_value' => $settings['order_status'] ?? 'processing',
                'options' => $this->get_order_statuses()
            ],
            'currency_convert' => [
                'default_value' => $settings['currency_convert'] ?? 'no',
                'options' => [
                    'yes' => __('Yes', 'sanalpospro-payment-module'),
                    'no' => __('No', 'sanalpospro-payment-module')
                ]
            ],
            'showInstallmentsTabs' => [
                'default_value' => $settings['showInstallmentsTabs'] ?? 'no',
                'options' => [
                    'yes' => __('Yes', 'sanalpospro-payment-module'),
                    'no' => __('No', 'sanalpospro-payment-module')
                ]
            ],
            'paymentPageTheme' => [
                'default_value' => $settings['paymentPageTheme'] ?? 'modern',
                'options' => [
                    'classic' => __('Classic', 'sanalpospro-payment-module'),
                    'modern' => __('Modern', 'sanalpospro-payment-module')
                ]
            ]
        ]) . ';', 'before');

        wp_enqueue_script('sppro-admin-settings');

        // Add API nonce and URLs
        $xfvv = wp_create_nonce('sppro_internal_api_request');
        $iapi_base_url = 'admin-ajax.php?action=sppro_internal_api_request';

        wp_add_inline_script('sppro-admin-settings', 'window.target_url = "' . esc_js($iapi_base_url) . '";', 'before');
        wp_add_inline_script('sppro-admin-settings', 'window.xfvv = "' . esc_js($xfvv) . '";', 'before');
        wp_add_inline_script('sppro-admin-settings', 'window.store_url = "' . esc_js(get_site_url()) . '";', 'before');
        wp_add_inline_script('sppro-admin-settings', 'window.style_url = "' . esc_js(SPPRO_PLUGIN_URL . 'admin/css/index.css') . '";', 'before');
        // Enqueue Paythor dashboard script
        wp_register_script(
            'paythor-dashboard', 
             SPPRO_PLUGIN_URL . 'admin/js/index.js', 
            array('sppro-admin-settings'), 
            SPPRO_VERSION, 
            true
        );

        // Add module type to script tag
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            if ('paythor-dashboard' === $handle) {
                return str_replace('<script ', '<script type="module" defer ', $tag);
            }
            return $tag;
        }, 10, 3);

        wp_enqueue_script('paythor-dashboard','',[],'false',array('strategy'=>'defer','in_footer'=>true));

       
        wp_add_inline_script('paythor-dashboard', 
            'document.addEventListener("DOMContentLoaded", function () {
                const wpBodyContent = document.querySelector("#wpbody-content");
                if (wpBodyContent) {
                    wpBodyContent.style.padding = "0";
                }
                const wpFooterDisplayHidden = document.querySelector("#wpfooter");
                if (wpFooterDisplayHidden) {
                   wpFooterDisplayHidden.style.display = "none";
                }
            });', 
            'after'
        );
    }

    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            __('SanalPosPRO Settings', 'sanalpospro-payment-module'),  
            __('SanalPosPRO', 'sanalpospro-payment-module'),           
            'manage_woocommerce',                      
            'sppro_admin',                           
            array($this, 'render_admin_page')
        );
    }

    private function get_order_statuses() {
        $statuses = wc_get_order_statuses();
        $formatted = array();
        foreach ($statuses as $key => $label) {
            $key = str_replace('wc-', '', $key);
            $formatted[$key] = $label;
        }
        return $formatted;
    }

    public static function set_default_settings() {
        // Set default settings if not already set
        if (!EticConfig::get('SANALPOSPRO_ORDER_STATUS')) {
            EticConfig::set('SANALPOSPRO_ORDER_STATUS', 'processing');
        }
        if (!EticConfig::get('SANALPOSPRO_CURRENCY_CONVERT')) {
            EticConfig::set('SANALPOSPRO_CURRENCY_CONVERT', 'no');
        }
        if (!EticConfig::get('SANALPOSPRO_SHOWINSTALLMENTSTABS')) {
            EticConfig::set('SANALPOSPRO_SHOWINSTALLMENTSTABS', 'no');
        }
        if (!EticConfig::get('SANALPOSPRO_PAYMENTPAGETHEME')) {
            EticConfig::set('SANALPOSPRO_PAYMENTPAGETHEME', 'classic');
        }
    }

    public function render_admin_page() {
        // Prepare variables for the template
        $token = EticConfig::get('SANALPOSPRO_PUBLIC_KEY') ?: '';
        $site_url = get_site_url();
        
        // Include the template file
        include_once SPPRO_PLUGIN_DIR . 'admin/views/admin-page.php';
    }
}

