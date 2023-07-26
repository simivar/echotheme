<?php

class NoEnoughPostsTemplate
{
    public static function render(int $requiredPosts = 0): void
    {
        $error = 'No posts found';
        if ($requiredPosts > 0) {
            $error = "No posts found. At least {$requiredPosts} post(s) are required to display featured posts.";
        }

        echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">{$error} <i class="bi bi-emoji-frown"></i></h1>
            </div>
        </div>
    </div>
</section>
HTML;
    }
}