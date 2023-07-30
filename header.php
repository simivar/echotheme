<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('css/custom.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <?php wp_site_icon(); ?>
    <?php wp_shortlink_wp_head(); ?>
    <?php rel_canonical(); ?>
    <?php adjacent_posts_rel_link_wp_head(); ?>
    <?php wp_resource_hints(); ?>
    <?php wp_enqueue_scripts(); ?>
    <?php _wp_render_title_tag(); ?>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg bg-black sticky-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $image = wp_get_attachment_image_src($custom_logo_id , [415, 45])[0];
            ?>
            <img src="<?php echo $image; ?>" />
        </a>

        <?php
        $headerNavigation = \echotheme\Navigation\NavigationMapper::getMappedMenuItems(\echotheme\Navigation\NavigationMapper::HEADER_MENU);
        ?>
        <ul class="navbar-nav">
            <?php foreach($headerNavigation as $item): ?>
                <?php if ($item->hasChildren()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link fw-bold dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $item->getTitle(); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($item->getChildren() as $child): ?>
                                <li>
                                    <a class="dropdown-item <?php echo $child->isActive() ? 'active' : ''; ?>" href="<?php echo $child->getUrl(); ?>">
                                        <?php echo $child->getTitle(); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php echo $item->isActive() ? 'active' : ''; ?>" aria-current="page" href="<?php echo $item->getUrl(); ?>">
                                <?php echo $item->getTitle(); ?>
                            </a>
                        </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>