<?php

declare(strict_types=1);

namespace echotheme\Dto;

class PostDto
{
    private array $categories;

    public function __construct(
        public readonly \WP_Post $post,
    )
    {
    }

    public function title(): string
    {
        return $this->post->post_title;
    }

    public function escapedTitle(): string
    {
        return esc_attr(strip_tags(str_replace('"', '\'', $this->title())));
    }

    public function link(): string
    {
        return esc_url(get_permalink($this->post));
    }

    /**
     * @return array<WP_Term>
     */
    public function categories(): array
    {
        if (!isset($this->categories)) {
            $this->categories = get_the_category($this->post);
        }

        return $this->categories;
    }

    public function mainCategoryLink(): string
    {
        if (!empty($this->categories())) {
            return esc_url(get_category_link($this->categories()[0]));
        }

        return '';
    }

    public function mainCategoryName(): string
    {
        if (!empty($this->categories())) {
            return $this->categories()[0]->name;
        }

        return '';
    }

    public function mainCategoryColor(): string
    {
        return \echotheme\Services\ArbitraryStringToHexColor::generate($this->mainCategoryName());
    }

    public function thumbnailFeaturedArchive(): string
    {
        $thumbnail = get_the_post_thumbnail_url($this->post, 'echotheme-featured-archive');
        if ($thumbnail === false) {
            return sprintf(
                'https://placehold.co/261x136/e9ecef/db1b1b?font=Lato&color=dc3545&text=%s',
                wordwrap($this->escapedTitle(), 30, '\n'),
            );
        }

        return $thumbnail;
    }

    public function thumbnailFeaturedSmall(): string
    {
        $thumbnail = get_the_post_thumbnail_url($this->post, 'echotheme-featured-small');
        if ($thumbnail === false) {
            return sprintf(
                'https://placehold.co/624x401/e9ecef/db1b1b?font=Lato&color=dc3545&text=%s',
                wordwrap($this->escapedTitle(), 30, '\n'),
            );
        }

        return $thumbnail;
    }

    public function thumbnailFeatured(): string
    {
        $thumbnail = get_the_post_thumbnail_url($this->post, 'echotheme-featured');
        if ($thumbnail === false) {
            return sprintf(
                'https://placehold.co/624x401/e9ecef/db1b1b?font=Lato&color=dc3545&text=%s',
                wordwrap($this->escapedTitle(), 30, '\n'),
            );
        }

        return $thumbnail;
    }

    public function thumbnailFeaturedWide(): string
    {
        $thumbnail = get_the_post_thumbnail_url($this->post, 'echotheme-featured-wide');
        if ($thumbnail === false) {
            return sprintf(
                'https://placehold.co/459x278/e9ecef/db1b1b?font=Lato&color=dc3545&text=%s',
                wordwrap($this->escapedTitle(), 30, '\n'),
            );
        }

        return $thumbnail;
    }
}