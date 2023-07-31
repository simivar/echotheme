<?php

declare(strict_types=1);

namespace echotheme\Templates\Generic;

class ContainerWithSidebarTemplate
{
    public static function render(string $containerHtml, string $sidebarHtml): string
    {
        return <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-12 col-lg-8">
                <div class="mb-4 row">
                    <h2 class="m-0 mb-2">Bądź na bieżąco</h2>
                </div>
                {$containerHtml}
            </div>
            <div class="col-12 col-lg-4">
                <div class="mb-4">
                    <div class="row mb-4">
                        <h2 class="m-0 col">Warto przeczytać</h2>
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