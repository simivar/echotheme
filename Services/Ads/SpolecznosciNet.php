<?php

declare(strict_types=1);

namespace echotheme\Services\Ads;

final class SpolecznosciNet
{
    public static function header(): void
    {
        echo '<script async src="https://a.spolecznosci.net/core/2963a7ab5f0df0381007f04d65008312/main.js"></script>';
    }

    public static function footer(): void
    {
        echo <<<HTML
<script type="text/javascript">
var _qasp = _qasp || [];
_qasp.push(['setPAID']);
</script>
HTML;

    }

    public static function show(int $webId, int $mobileId): void
    {
        echo <<<ADS
    <div class="spolecznoscinet echoad-web justify-content-center d-none d-md-flex" id="spolecznosci-$webId" data-min-width="750"></div>
    <div class="spolecznoscinet echoad-mobile justify-content-center d-md-none d-flex" id="spolecznosci-$mobileId" data-max-width="750"></div>
ADS;
    }
}