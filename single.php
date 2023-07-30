<?php

get_header();

$title = the_title('', '', false);
$thumbnailUrl = get_the_post_thumbnail(null, 'full', ['class' => 'img-fluid w-100 h-100 object-fit-cover']);

$categoriesHtml = '';

/** @var \WP_Term[] $categories */
$categories = get_the_category();
foreach ($categories as $category) {
    $categoryUrl = esc_url(get_category_link($category));
    $categoryName = $category->name;
    $categoryColor = \echotheme\Services\ArbitraryStringToHexColor::generate($categoryName);

    $categoriesHtml .= <<<HTML
<a href="{$categoryUrl}" class="badge bg-text-decoration-none" style="color: #{$categoryColor}">{$categoryName}</a>
HTML;
}

global $post;
setup_postdata($post);

$authorName = get_the_author();
$authorUrl = get_author_posts_url($post->post_author);
$timeAgo = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'temu' );

$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = str_replace( ']]>', ']]&gt;', $content );


echo <<<HTML
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 text-center p-5 d-flex align-items-center justify-content-center">
                <div>
                    <div class="row w-100">
                        <div class="col">
                            $categoriesHtml
                        </div>
                    </div>
                   <div class="row w-100">
                       <div class="col">
                           <h1>$title</h1>
                       </div>
                    </div>
                   <div class="row w-100">
                       <div class="col">
                           autorstwa <a href="$authorUrl">$authorName</a>, $timeAgo
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                $thumbnailUrl
            </div>
        </div>
    </div>
</section>
    
<article>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-xl-8 col-lg-10 p-5 fs-5">
                $content
            </div>
        </div>
    </div>
</article>
HTML;

get_footer();