<?php

class CategorySidebar
{
    /**
     * @param array<object{'id': string, 'name': string, 'post_date': string}> $data
     */
    public static function get(array $data): string {
        $html = '';
        foreach ($data as $category) {
            $html .= self::renderSingle($category);
        }

        return $html;
    }

    /**
     * @param object{'id': string, 'name': string, 'post_date': string}|stdClass $data
     */
    private static function renderSingle(stdClass $data): string
    {
        $categoryUrl = esc_url(get_category_link($data->id));
        $categoryColor = ArbitraryStringToHexColor::generate($data->name);

        return <<<HTML
        <div class="d-flex justify-content-between align-items-center bg-opacity-10 rounded p-2 position-relative mb-2" style="background-color: #{$categoryColor}25">
            <a href="{$categoryUrl}" class="stretched-link text-decoration-none" style="color: #{$categoryColor}">
                <h6 class="m-0">{$data->name}</h6>
            </a>
        </div>
HTML;
    }
}