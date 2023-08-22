<?php

namespace Meals\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\MenuNotAvailableDishException;
use Meals\Domain\Model\Dish\Dish;
use Meals\Domain\Model\Menu\Menu;

class MenuHasAvailableDishValidator
{
    public function validate(Dish $dish, Menu $menu)
    {
        if (!$menu->getDishes()->hasDish($dish)) {
            throw new MenuNotAvailableDishException();
        }
    }
}