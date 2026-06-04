<?php
/**
 * Class SPPRO_Logger
 * @package Eticsoft\Sanalpospro
 * @description WooCommerce logger wrapper with sensitive field redaction.
 * @version 1.0
 * @since 1.0
 * @author EticSoft R&D Lab.
 * @license MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SPPRO_Logger {

    const SOURCE  = 'sanalpospro';
    const ENABLED = false;

    private static $sensitive_keys = array(
        'iapi_publickey',
        'iapi_secretkey',
        'iapi_accesstoken',
        'public_key',
        'secret_key',
        'access_token',
        'accesstoken',
        'token',
        'token_string',
        'password',
        'authorization',
    );

    public static function info( $message, array $context = array() ) {
        self::write( 'info', $message, $context );
    }

    public static function warning( $message, array $context = array() ) {
        self::write( 'warning', $message, $context );
    }

    public static function error( $message, array $context = array() ) {
        self::write( 'error', $message, $context );
    }

    public static function debug( $message, array $context = array() ) {
        self::write( 'debug', $message, $context );
    }

    private static function write( $level, $message, array $context ) {
        if ( ! self::ENABLED || ! function_exists( 'wc_get_logger' ) ) {
            return;
        }

        $safe_context = self::scrub( $context );
        if ( ! empty( $safe_context ) ) {
            $message .= ' | ' . wp_json_encode( $safe_context );
        }

        wc_get_logger()->log( $level, $message, array( 'source' => self::SOURCE ) );
    }

    private static function scrub( $data ) {
        if ( ! is_array( $data ) ) {
            return $data;
        }

        $out = array();
        foreach ( $data as $key => $value ) {
            $lower = is_string( $key ) ? strtolower( $key ) : $key;

            if ( is_string( $lower ) && in_array( $lower, self::$sensitive_keys, true ) ) {
                $out[ $key ] = self::mask( $value );
                continue;
            }

            if ( is_array( $value ) ) {
                $out[ $key ] = self::scrub( $value );
                continue;
            }

            $out[ $key ] = $value;
        }
        return $out;
    }

    private static function mask( $value ) {
        if ( ! is_scalar( $value ) ) {
            return '***REDACTED***';
        }
        $value = (string) $value;
        $len   = strlen( $value );
        if ( $len <= 4 ) {
            return '***REDACTED***';
        }
        return '***' . substr( $value, -4 );
    }
}
