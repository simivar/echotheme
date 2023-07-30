<?php

require_once get_template_directory() . '/Navigation/NavigationMapper.php';
require_once get_template_directory() . '/Pages/NewestPostsWithSidebarTemplate.php';
require_once get_template_directory() . '/FrontPage/NoEnoughPostsTemplate.php';
require_once get_template_directory() . '/FrontPage/FeaturedPostsTemplate.php';
require_once get_template_directory() . '/FrontPage/NewestPostsWithCarouselSidebar.php';
require_once get_template_directory() . '/FrontPage/CategoryPostsSection.php';
require_once get_template_directory() . '/Utils/ArbitraryStringToHexColor.php';
require_once get_template_directory() . '/Utils/CategoriesMapper.php';
require_once get_template_directory() . '/Posts/CountPostViews.php';
require_once get_template_directory() . '/Customization/MultiselectCustomControl.php';
require_once get_template_directory() . '/Category/GetCategoriesWithRecentPosts.php';
require_once get_template_directory() . '/Category/CategorySidebar.php';

function register_echotheme_menus() {
    register_nav_menus(
        array(
            NavigationMapper::HEADER_MENU => __( 'Header Menu' ),
            NavigationMapper::FOOTER_MENU => __( 'Footer Menu' ),
            NavigationMapper::FOOTER_TOP_MENU => __( 'Footer Small Top Menu' ),
        )
    );
}
add_action( 'init', 'register_echotheme_menus' );

add_theme_support('post-thumbnails');
add_image_size('echotheme-featured', 99999, 479);
add_image_size('echotheme-featured-small', 99999, 254);
add_image_size('echotheme-featured-wide', 99999, 179);

function echotheme_customize_socials(WP_Customize_Manager $wp_customize)
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

    $wp_customize->add_section('front_page', [
        'title' => 'Front page',
        'description' => 'Here you can change settings of front page',
    ]);

    $wp_customize->add_setting('frontpage_categories', [
        'default' => '',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control(
        new MultiselectCustomControl(
            $wp_customize, 'frontpage_categories', array(
                'label' => 'Category posts sections',
                'description' => 'If you want to select multiple categories, hold CTRL and click on them.',
                'section' => 'front_page',
                'settings' => 'frontpage_categories',
                'type'     => 'multiple-select',
                'choices'	=> CategoriesMapper::mapAsIdToNameArray(),
            )
        )
    );
}
add_action('customize_register','echotheme_customize_socials');

/*
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
$logo_width  = 415;
$logo_height = 45;

add_theme_support(
    'custom-logo',
    array(
        'height'               => $logo_height,
        'width'                => $logo_width,
        'flex-width'           => true,
        'flex-height'          => true,
        'unlink-homepage-logo' => true,
    )
);