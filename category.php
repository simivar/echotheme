<?php

get_header();

$categoryId = get_queried_object_id();

$category = get_category($categoryId);
$count = $category->category_count;

$args = array ( 'category' => $categoryId, 'posts_per_page' => 16, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish');
$myposts = get_posts( $args );
var_dump($myposts);die;

echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mb-4">
                <h1>{$category->name}</h1>
                <span class="badge text-bg-success fs-6 my-2">{$count} posts</span>
                <p>
                    {$category->description}
                </p>
            </div>
        </div>
    </div>
</section>
HTML;

get_footer();