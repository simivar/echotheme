<footer class="bottom-0 bg-black text-white mt-5 mt-auto">
    <div class="container py-5">
        <div class="row">
            <div class="col-4">
                <?php
                $footerTopMenu = \echotheme\Navigation\NavigationMapper::getMappedMenuItems(\echotheme\Navigation\NavigationMapper::FOOTER_TOP_MENU);
                $footerTopMenuCount = count($footerTopMenu);
                $i = 0;
                ?>
                <?php foreach($footerTopMenu as $item): ?>
                    <a href="<?php echo $item->getUrl(); ?>" class="text-rest text-white btn-link fw-bold <?php echo $i !== 0 ? 'ms-4' : ''; ?>">
                        <?php echo $item->getTitle(); ?>
                    </a>
                    <?php $i = 1; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-4">
                <a href="<?php echo esc_url(home_url( '/' )); ?>">
                    <?php
                    if (has_custom_logo()) {
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $image = wp_get_attachment_image_src($custom_logo_id , [415, 45])[0];
                    } else {
                        $image = get_template_directory_uri() . '/assets/images/logo.webp';
                    }
                    ?>
                    <img src="<?php echo $image; ?>" class="img-fluid" alt="EchoTrybun.pl logo" />
                </a>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="<?php echo esc_url(get_theme_mod('facebook')); ?>" 
                   class="text-white btn-link fw-bold fs-3" target="_blank" rel="nofollow"
                    aria-label="Odwiedź nas na Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('instagram')); ?>" 
                   class="text-white btn-link fw-bold fs-3 ms-4" target="_blank" rel="nofollow"
                   aria-label="Sprawdź nasz profil na Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col">
                <?php
                $headerNavigation = \echotheme\Navigation\NavigationMapper::getMappedMenuItems(\echotheme\Navigation\NavigationMapper::FOOTER_MENU);
                ?>
                <ul class="nav justify-content-center">
                    <?php foreach($headerNavigation as $item): ?>
                    <li class="nav-item px-2">
                        <a class="nav-link btn-link text-white <?php echo $item->isActive() ? 'fw-bold' : ''; ?>" href="<?php echo $item->getUrl(); ?>">
                            <?php echo $item->getTitle(); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col">
                Echo Trybun © <?php echo date('Y'); ?>. Wszystkie prawa zastrzeżone
            </div>
            <div class="col">
                Echo Trybun – newsy, ciekawostki, reportaże, rozmowy i najciekawsze informacje ze świata sportu. Piłka nożna i wiele więcej…
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script type="text/javascript">
var _qasp = _qasp || [];
_qasp.push(['setPAID']);
</script>

</body>
</html>