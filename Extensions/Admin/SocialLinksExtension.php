<?php

declare(strict_types=1);

namespace echotheme\Extensions\Admin;

final class SocialLinksExtension {
    public static function register(\WP_Customize_Manager $wp_customize)
    {
        $wp_customize->add_section('social_media', [
            'title' => 'Social media',
            'description' => 'Here you can set all of your social media accounts',
        ]);

        $wp_customize->add_setting('instagram', [
            'default' => '',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control('instagram', [
            'label' => 'Instagram',
            'section' => 'social_media',
            'type' => 'url',
            'input_attrs' => [
                'placeholder' => 'https://www.instagram.com/malpaczlowieku/',
            ],
        ]);

        $wp_customize->add_setting('facebook', [
            'default' => '',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control('facebook', [
            'label' => 'Facebook',
            'section' => 'social_media',
            'type' => 'url',
            'input_attrs' => [
                'placeholder' => 'https://facebook.com/krystian.marcisz/',
            ],
        ]);
    }
}