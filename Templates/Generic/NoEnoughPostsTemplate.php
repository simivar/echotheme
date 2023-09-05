<?php

declare(strict_types=1);

namespace echotheme\Templates\Generic;

class NoEnoughPostsTemplate
{
    public static function render(): string
    {
        return <<<HTML
<section class="pt-4 pb-0 justify">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Not enough posts found.</h1>
            </div>
        </div>
    </div>
</section>
HTML;
    }
}