<?php
/** @var \echotheme\Dto\CategoryWithRecentPostDto $category */

$color = echotheme\Services\ArbitraryStringToHexColor::generate($category->name);
?>

<div class="rounded p-2 mb-2" style="background-color: #<?php echo $color; ?>25">
    <a href="<?php echo esc_url(get_category_link($category->id)); ?>" class="text-decoration-none" style="color: #<?php echo $color; ?>">
        <h6 class="m-0"><?php echo $category->name; ?></h6>
    </a>
</div>