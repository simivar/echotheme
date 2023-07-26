<footer class="bottom-0 bg-black text-white mt-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-4">
                <a href="https://echotrybun.pl/o-mnie/" class="text-rest text-white btn-link fw-bold">O nas</a>
                <a href="https://echotrybun.pl/cookie-policy/" class="text-rest text-white btn-link ms-4 fw-bold">Polityka prywatności</a>
            </div>
            <div class="col-4">
                <a href="<?php echo esc_url(home_url( '/' )); ?>">
                    <img src="https://echotrybun.pl/wp-content/uploads/2022/11/echo_trybun_cut.png" class="img-fluid"/>
                </a>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="<?php echo esc_url(get_theme_mod('facebook')); ?>" class="text-white btn-link fw-bold fs-3" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('instagram')); ?>" class="text-white btn-link fw-bold fs-3 ms-4">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col">
                <?php
                $headerNavigation = NavigationMapper::getMappedMenuItems(NavigationMapper::FOOTER_MENU);
                ?>
                <ul class="nav justify-content-center">
                    <?php foreach($headerNavigation as $item): ?>
                    <li class="nav-item px-2">
                        <a class="nav-link btn-link text-white <?php echo $item->isActive() ? 'active' : ''; ?>" href="<?php echo $item->getUrl(); ?>">
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

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>