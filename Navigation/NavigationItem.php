<?php

declare(strict_types=1);

class NavigationItem
{
    private string $title;
    private string $url;
    private string $type;
    private bool $isActive;
    private array $children = [];

    public function __construct(string $title, string $url, string $type, bool $isActive)
    {
        $this->title = $title;
        $this->url = $url;
        $this->type = $type;
        $this->isActive = $isActive;
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
        return $this->isActive;
    }

    public function addChildren(NavigationItem $item): void
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