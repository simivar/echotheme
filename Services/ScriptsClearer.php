<?php

declare(strict_types=1);

namespace echotheme\Services;

class ScriptsClearer
{
    public static function clear(): void
    {
        add_action( 'wp_enqueue_scripts', [ScriptsClearer::class, 'clearGuttenbergCss'], 100 );
        add_action( 'wp_enqueue_scripts', [ScriptsClearer::class, 'clearInlineStyles'], 100 );

        remove_action('wp_head', 'wp_generator');

        self::removeWpEmoji();
    }

    public static function removeWpEmoji(): void
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }

    public static function clearGuttenbergCss(): void
    {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
    }

    public static function clearDashicons(): void
    {
        wp_deregister_style( 'dashicons' );
    }

    public static function clearInlineStyles(): void
    {
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }
}