<?php

require_once get_template_directory() . '/Navigation/NavigationMapper.php';

function register_echotheme_menus() {
    register_nav_menus(
        array(
            NavigationMapper::HEADER_MENU => __( 'Header Menu' ),
            NavigationMapper::FOOTER_MENU => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_echotheme_menus' );
