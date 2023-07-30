<?php

declare(strict_types=1);

namespace echotheme\Extensions\Admin;

final class FrontPageCategoryPostsSectionsExtension {
    public static function register(\WP_Customize_Manager $wp_customize)
    {
        $wp_customize->add_section('front_page', [
            'title' => 'Front page',
            'description' => 'Here you can change settings of front page',
        ]);

        $wp_customize->add_setting('frontpage_categories', [
            'default' => '',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control(
            new \echotheme\Customization\MultiselectCustomControl(
                $wp_customize, 'frontpage_categories', array(
                    'label' => 'Category posts sections',
                    'description' => 'If you want to select multiple categories, hold CTRL and click on them.',
                    'section' => 'front_page',
                    'settings' => 'frontpage_categories',
                    'type'     => 'multiple-select',
                    'choices'	=> \echotheme\Utils\CategoriesMapper::mapAsIdToNameArray(),
                )
            )
        );
    }
}