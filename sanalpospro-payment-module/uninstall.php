<?php
/**
 * SanalPosPRO Payment Gateway Uninstall
 *
 * Removes plugin options, WooCommerce gateway settings, and WooCommerce log files.
 *
 * @package SanalPosPRO
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

$sppro_options = array(
    'SANALPOSPRO_PUBLIC_KEY',
    'SANALPOSPRO_SECRET_KEY',
    'SANALPOSPRO_ACCESS_TOKEN',
    'SANALPOSPRO_ORDER_STATUS',
    'SANALPOSPRO_CURRENCY_CONVERT',
    'SANALPOSPRO_SHOWINSTALLMENTSTABS',
    'SANALPOSPRO_PAYMENTPAGETHEME',
    'SANALPOSPRO_INSTALLMENTS',
    'SANALPOSPRO_VERSION',
    'woocommerce_sanalpospro_settings',
    'SPPRO_PUBLIC_KEY',
    'SPPRO_SECRET_KEY',
    'SPPRO_TOKEN',
    'SPPRO_ORDER_STATUS',
    'SPPRO_CURRENCY_CONVERT',
    'SPPRO_SHOWINSTALLMENTSTABS',
    'SPPRO_PAYMENTPAGETHEME',
    'SPPRO_INSTALLMENTS',
    'woocommerce_sppro_settings',
);

foreach ( $sppro_options as $option_name ) {
    delete_option( $option_name );
}


global $wpdb;
if ( isset( $wpdb->options ) ) {
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s OR option_name LIKE %s",
            $wpdb->esc_like( 'SANALPOSPRO_' ) . '%',
            $wpdb->esc_like( 'SPPRO_' ) . '%'
        )
    );
}

delete_transient( 'sanalpospro_api_token' );
wp_clear_scheduled_hook( 'sanalpospro_daily_cleanup' );

sppro_uninstall_delete_logs();


function sppro_uninstall_delete_logs() {
    $log_source = 'sanalpospro';

    if ( function_exists( 'wc_get_logger' ) ) {
        wc_get_logger()->clear( $log_source, true );
        return;
    }

    $upload_dir = wp_upload_dir();
    if ( empty( $upload_dir['basedir'] ) ) {
        return;
    }

    $log_dir = trailingslashit( $upload_dir['basedir'] ) . 'wc-logs';
    if ( ! is_dir( $log_dir ) ) {
        return;
    }

    $patterns = array(
        $log_dir . '/' . $log_source . '*.log',
        $log_dir . '/' . $log_source . '-*.log',
    );

    foreach ( $patterns as $pattern ) {
        $files = glob( $pattern );
        if ( ! is_array( $files ) ) {
            continue;
        }
        foreach ( $files as $log_file ) {
            if ( is_file( $log_file ) ) {
                if ( function_exists( 'wp_delete_file' ) ) {
                    wp_delete_file( $log_file );
                } else {
                    unlink( $log_file );
                }
            }
        }
    }
}
