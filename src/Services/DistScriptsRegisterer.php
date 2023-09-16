<?php

declare(strict_types=1);

namespace echotheme\Services;

class DistScriptsRegisterer
{
    public static function register(): void
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'header']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'footer']);
    }

    public static function header(): void
    {
        wp_enqueue_style(
            handle: 'bootstrap',
            src: get_template_directory_uri() . '/assets/dist/main.css',
            ver: '1.0.4',
        );
    }

    public static function footer(): void
    {
        wp_enqueue_script(
            handle: 'bootstrap',
            src: get_template_directory_uri() . '/assets/dist/main.js',
            ver: '1.0.4',
            args: [
                'in_footer' => true,
                'strategy'  => 'async',
            ],
        );
    }
}