<?php

declare(strict_types=1);

namespace echotheme\Templates\FrontPage;

use echotheme\Dto\PostDto;
use echotheme\Templates\Post\ImageAsBackgroundPostTemplate;

class FeaturedPostsTemplate
{
    public static function render(PostDto ...$posts): string
    {
        if (count($posts) < 6) {
            return '';
        }

        $firstPost = ImageAsBackgroundPostTemplate::render($posts[0], false);
        $secondPost = ImageAsBackgroundPostTemplate::render($posts[1]);
        $thirdPost = ImageAsBackgroundPostTemplate::render($posts[2]);
        $fourthPost = ImageAsBackgroundPostTemplate::render($posts[3]);
        $fifthPost = ImageAsBackgroundPostTemplate::render($posts[4]);
        $sixthPost = ImageAsBackgroundPostTemplate::render($posts[5]);

        return <<<HTML
<section class="pt-4 pb-0" id="featured-posts">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                {$firstPost}
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col">
                        {$secondPost}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        {$thirdPost}
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-1">
            <div class="col-lg">
               {$fourthPost}
            </div>
            <div class="col-lg">
                {$fifthPost}
            </div>
            <div class="col-lg">
                {$sixthPost}
            </div>
        </div>
    </div>
</section>
HTML;
    }
}