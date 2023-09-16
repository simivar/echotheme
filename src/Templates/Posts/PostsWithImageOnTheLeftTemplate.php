<?php

declare(strict_types=1);

namespace echotheme\Templates\Posts;

use echotheme\Dto\PostDto;
use echotheme\Templates\Post\ImageOnTheLeftPostTemplate;

class PostsWithImageOnTheLeftTemplate
{
    public static function render(PostDto ...$posts): string
    {
        if (count($posts) < 1) {
            return \echotheme\Templates\Generic\NoEnoughPostsTemplate::render();
        }

        $content = '';
        foreach ($posts as $post) {
            $content .= ImageOnTheLeftPostTemplate::render($post);
        }

        return $content;
    }
}