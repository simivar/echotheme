<?php

require_once get_template_directory() . '/Navigation/NavigationMapper.php';
require_once get_template_directory() . '/FrontPage/NoEnoughPostsTemplate.php';
require_once get_template_directory() . '/FrontPage/FeaturedPostsTemplate.php';
require_once get_template_directory() . '/FrontPage/NewestPostsWithSidebarTemplate.php';
require_once get_template_directory() . '/Utils/ArbitraryStringToHexColor.php';

function register_echotheme_menus() {
    register_nav_menus(
        array(
            NavigationMapper::HEADER_MENU => __( 'Header Menu' ),
            NavigationMapper::FOOTER_MENU => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_echotheme_menus' );


add_theme_support('post-thumbnails');
add_image_size( 'echotheme-featured', 850, 540 ); // 300 pixels wide (and unlimited height)