<?php

declare(strict_types=1);

namespace echotheme\Services\Navigation;

class NavigationItem
{
    private string $title;
    private string $url;
    private string $type;
    private array $children = [];
    private int $id;

    public function __construct(string $title, string $url, string $type, int $id)
    {
        $this->title = $title;
        $this->url = $url;
        $this->type = $type;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isActive(): bool
    {
        return $this->id === NavigationMapper::getCurrentCategoryId();
    }

    public function addChildren(self $item): void
    {
        $this->children[] = $item;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }
}