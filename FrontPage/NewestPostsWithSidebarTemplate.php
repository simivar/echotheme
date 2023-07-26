<?php

class NewestPostsWithSidebarTemplate
{
    /**
     * @param WP_Post[] $posts
     */
    public static function render(array $posts): void
    {
        if (count($posts) < 1) {
            NoEnoughPostsTemplate::render(1);

            return;
        }

        $postsHtml = '';
        foreach ($posts as $post) {
            $postsHtml .= self::renderSinglePost($post);
        }

        echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-8">
                <div class="mb-4 row">
                    <h2 class="m-0 mb-2">Bądź na bieżąco</h2>
                </div>
                {$postsHtml}
                <div class="row mb-4 justify-content-center">
                    <div class="col-2 d-flex">
                        <button type="button" class="btn btn-danger btn-animation w-100 text-uppercase rounded-pill" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">Więcej</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-4">
                    <div class="row mb-4">
                        <h2 class="m-0 col">Warto przeczytać</h2>
                    </div>
                    <div class="row">
                        <div id="carouselExampleCaptions" class="carousel slide col" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="card text-light card-img-scale w-100 overflow-hidden">
                                        <img src="https://echotrybun.pl/wp-content/uploads/2023/07/Zrzut-ekranu-2023-07-20-101716-850x541.png" class="d-block card-img h-100" alt="...">
                                        <div class="card-img-overlay d-flex">
                                            <div class="w-100 mt-auto">
                                                <a href="#" class="badge text-bg-danger mb-2">
                                                    Lifestyle
                                                </a>

                                                <h1 class="card-title">
                                                    <a href="http://google.com" class="btn-link stretched-link text-reset">
                                                        To koniec! Viaplay wynosi się z Polski
                                                    </a>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="card text-light card-img-scale w-100 overflow-hidden">
                                        <img src="https://echotrybun.pl/wp-content/uploads/2023/07/Zrzut-ekranu-2023-07-19-213707-642x491.png" class="d-block card-img h-100" alt="...">
                                        <div class="card-img-overlay d-flex">
                                            <div class="w-100 mt-auto">
                                                <a href="#" class="badge text-bg-danger mb-2">
                                                    Lifestyle
                                                </a>

                                                <h2 class="card-title fs-4">
                                                    <a href="http://google.com" class="btn-link stretched-link text-reset">
                                                        Lechia zaoferowała bajeczne zarobki Fernandezowi. “Miał też oferty z Ekstraklasy, ale nie tak atrakcyjne”
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="card text-light card-img-scale w-100 overflow-hidden">
                                        <img src="https://echotrybun.pl/wp-content/uploads/2023/07/Zrzut-ekranu-2023-07-20-101716-850x541.png" class="d-block card-img h-100" alt="...">
                                        <div class="card-img-overlay d-flex">
                                            <div class="w-100 mt-auto">
                                                <a href="#" class="badge text-bg-danger mb-2">
                                                    Lifestyle
                                                </a>

                                                <h1 class="card-title">
                                                    <a href="http://google.com" class="btn-link stretched-link text-reset">
                                                        To koniec! Viaplay wynosi się z Polski
                                                    </a>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;

    }

    private static function renderSinglePost(WP_Post $post): string
    {
        $link = esc_url(get_permalink($post));
        $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured');

        /** @var WP_Term[] $category */
        $category = get_the_category($post);
        if (empty($category)) {
            $categoryUrl = '';
            $category = '';
        } else {
            $categoryUrl = esc_url(get_category_link($category[0]));
            $category = $category[0]->name;
        }
        $categoryColor = ArbitraryStringToHexColor::generate($category);

        return <<<HTML
<div class="row mb-4">
    <div class="col-5">
        <a href="{$link}" class="d-flex card-img-scale overflow-hidden rounded-3">
            <img class="card-img" src="{$thumbnail}" alt="">
        </a>
    </div>
    <div class="col">
        <div class="flex-column d-flex align-items-start justify-content-center h-100">
            <a href="{$categoryUrl}" class="badge bg-danger text-decoration-none mb-2" style="background-color: #{$categoryColor} !important;">
                {$category}
            </a>

            <h4>
                <a href="{$link}" class="btn-link stretched-link text-reset fw-bold">
                    {$post->post_title}
                </a>
            </h4>
        </div>
    </div>
</div>
HTML;
    }
}