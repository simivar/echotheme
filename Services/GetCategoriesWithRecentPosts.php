<?php

declare(strict_types=1);

namespace echotheme\Services;

use echotheme\Dto\CategoryWithRecentPostDto;

class GetCategoriesWithRecentPosts
{
    /**
     * @return CategoryWithRecentPostDto[]
     */
    public static function get(int $limit, int $excludedId): array {
        global $wpdb;

        $results = $wpdb->get_results(<<<SQL
SELECT
    wpt.term_id as id,
	wpt.name,
	(
	SELECT
		wpp.post_date
	FROM
		{$wpdb->term_relationships} as wptr
	JOIN {$wpdb->posts} as wpp ON wpp.ID = wptr.object_id
	WHERE
		wptr.term_taxonomy_id = wpt.term_id
	ORDER BY
		wpp.post_date DESC
	LIMIT 1
	) as post_date
FROM
	{$wpdb->terms} as wpt
JOIN {$wpdb->term_taxonomy} as wptt ON wpt.term_id = wptt.term_id 
WHERE
	wptt.taxonomy = 'category'
	AND count > 0
    AND wpt.term_id != {$excludedId}
ORDER BY post_date DESC
LIMIT {$limit}
SQL);

        $return = [];
        foreach ($results as $result) {
            $return[] = new CategoryWithRecentPostDto(
                id: (int) $result->id,
                name: $result->name,
                postDate: $result->post_date,
            );
        }

        return $return;
    }
}