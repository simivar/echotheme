<?php

spl_autoload_register(static function($class) {
    $path =  get_theme_root() . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

\echotheme\Extensions\PostViewsCounterExtension::register();
\echotheme\Extensions\ImageSizesExtension::register();
\echotheme\Extensions\MenusExtension::register();

function echotheme_customize_socials(\WP_Customize_Manager $wp_customize)
{
    \echotheme\Extensions\Admin\SocialLinksExtension::register($wp_customize);
    \echotheme\Extensions\Admin\FrontPageCategoryPostsSectionsExtension::register($wp_customize);
}
add_action('customize_register','echotheme_customize_socials');
