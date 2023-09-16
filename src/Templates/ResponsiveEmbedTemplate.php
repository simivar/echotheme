<?php

declare(strict_types=1);

namespace echotheme\Templates;

class ResponsiveEmbedTemplate
{
    public static function render(string $embed, $is4x3Ratio = false): string
    {
        if ($is4x3Ratio) {
            return <<<HTML
                <div class="ratio ratio-4x3">
                    $embed
                </div>
            HTML;
        }

        return <<<HTML
            <div class="ratio ratio-16x9">
                $embed
            </div>
        HTML;
    }
}
