<?php

declare(strict_types=1);

namespace echotheme\Services\Ads;

final class SpolecznosciNet
{
    public static function header(): void
    {
        add_filter('the_content', [SpolecznosciNet::class, 'content']);
    }

    public static function content(string $theContent): string
    {
        if ( !is_singular()) {
            return $theContent;
        }

        $newContent = self::show(9579, 9585, false);

        $splitByParagraphs = explode('</p>', $theContent);
        foreach ($splitByParagraphs as $i => $iValue) {
            $newContent .= $iValue . '</p>';

            if ($i === 0) {
                $newContent .= self::show(9580, 9587, false);
            }

            if ($i === 2) {
                $newContent .= self::show(9583, 9588, false);
            }

            /*
             * seems to be not working
            if ($i === 5) {
                $newContent .= self::show(9590, 9589, false);
            }
            */
        }

        return $newContent;
    }

    public static function footer(): void
    {
        echo '<script async src="https://a.spolecznosci.net/core/2963a7ab5f0df0381007f04d65008312/main.js"></script>';
        echo <<<HTML
<script type="text/javascript">
var _qasp = _qasp || [];
_qasp.push(['setPAID']);
</script>
HTML;

    }

    public static function show(int $webId, int $mobileId, bool $echo = true): string
    {
        $ads = <<<ADS
    <div class="spolecznoscinet echoad-web justify-content-center d-none d-md-flex" id="spolecznosci-$webId" data-min-width="750"></div>
    <div class="spolecznoscinet echoad-mobile justify-content-center d-md-none d-flex" id="spolecznosci-$mobileId" data-max-width="750"></div>
ADS;

        if ($echo) {
            echo $ads;
        }

        return $ads;
    }
}