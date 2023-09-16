<?php

declare(strict_types=1);

namespace echotheme\Templates\Ads;

class SpolecznosciNetAdTemplate
{
    public static function render(int $webId, int $mobileId): string
    {
        return self::renderMobileAd($mobileId) . PHP_EOL . self::renderWebAd($webId). PHP_EOL;
    }

    private static function renderWebAd(int $adId): string
    {
        return <<<HTML
            <div class="spolecznoscinet echoad-web justify-content-center d-none d-md-flex" id="spolecznosci-$adId" data-min-width="750"></div>
        HTML;
    }

    private static function renderMobileAd(int $adId): string
    {
        return <<<HTML
            <div class="spolecznoscinet echoad-mobile justify-content-center d-md-none d-flex" id="spolecznosci-$adId" data-max-width="750"></div>
        HTML;
    }
}