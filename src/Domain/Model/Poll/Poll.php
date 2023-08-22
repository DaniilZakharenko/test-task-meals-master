<?php

namespace Meals\Domain\Model\Poll;

use Meals\Domain\Model\Menu\Menu;

class Poll
{
    /** @var int */
    private $id;

    /** @var bool */
    private $isActive;

    /** @var Menu */
    private $menu;
    /**
     * @var PollRuleOpen
     */
    private $pullRuleOpen;

    /**
     * Poll constructor.
     * @param int $id
     * @param bool $isActive
     * @param Menu $menu
     */
    public function __construct(int $id, bool $isActive, Menu $menu, PollRuleOpen $pullRuleOpen)
    {
        $this->id = $id;
        $this->isActive = $isActive;
        $this->menu = $menu;
        $this->pullRuleOpen = $pullRuleOpen;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return Menu
     */
    public function getMenu(): Menu
    {
        return $this->menu;
    }

    /**
     * @return PollRuleOpen
     */
    public function getPullRuleOpen(): PollRuleOpen
    {
        return $this->pullRuleOpen;
    }
}
