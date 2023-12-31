<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <?php \echotheme\Services\OpenGraphHeaderGenerator::header(); ?>
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg bg-black sticky-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>">
            <?php
            if (has_custom_logo()) {
                $custom_logo_id = get_theme_mod('custom_logo');
                $image = wp_get_attachment_image_src($custom_logo_id , [415, 45])[0];
            } else {
                $image = get_template_directory_uri() . '/assets/images/logo.webp';
            }
            ?>
            <img src="<?php echo $image; ?>" alt="EchoTrybun.pl logo" />
        </a>

        <?php
        $headerNavigation = \echotheme\Services\Navigation\NavigationMapper::getMappedMenuItems(\echotheme\Services\Navigation\NavigationMapper::HEADER_MENU);
        ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <ul class="navbar-nav collapse navbar-collapse flex-sm-grow-0" id="navbarToggler">
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
