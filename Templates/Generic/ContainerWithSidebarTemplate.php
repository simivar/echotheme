<?php

declare(strict_types=1);

namespace echotheme\Templates\Generic;

class ContainerWithSidebarTemplate
{
    public static function render(string $containerHtml, string $sidebarHtml, string $containerTitle = 'Bądź na bieżąco', string $description = ''): string
    {
        if ($description !== '') {
            $description = '<p>' . $description . '</p>';
        }

        return <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-12 col-lg-8">
                <div class="mb-4 row">
                    <h2 class="m-0 mb-2">{$containerTitle}</h2>
                </div>
                {$description}
            
                {$containerHtml}
            </div>
            <div class="col-12 col-lg-4">
                <div class="mb-4">
                    <div class="row mb-4">
                        <h4 class="m-0 col fs-3">Warto przeczytać</h4>
                    </div>
                    <div class="row">
                        {$sidebarHtml}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;
    }
}