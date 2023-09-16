<?php

spl_autoload_register(static function($class) {
    $classWithoutName = str_replace('echotheme\\', '', $class);

    $path =  get_template_directory() . '/src/' . str_replace('\\', '/', $classWithoutName) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

\echotheme\Services\ClearCacheOnPostStatusChange::register();
\echotheme\Services\DistScriptsRegisterer::register();
\echotheme\Extensions\PostViewsCounterExtension::register();
\echotheme\Extensions\ImageSizesExtension::register();
\echotheme\Extensions\MenusExtension::register();
\echotheme\Services\ScriptsClearer::clear();
new \echotheme\Services\ResponsiveEmbeds();

// ads
\echotheme\Services\Ads\Monetag::register();
\echotheme\Services\Ads\SpolecznosciNet::register();

function echotheme_customize_socials(\WP_Customize_Manager $wp_customize)
{
    \echotheme\Extensions\Admin\SocialLinksExtension::register($wp_customize);
    \echotheme\Extensions\Admin\FrontPageCategoryPostsSectionsExtension::register($wp_customize);
}
add_action('customize_register','echotheme_customize_socials');
