<?php

namespace tests\Meals\Functional\Fake\Provider;

use Meals\Domain\Model\Dish\Dish;
use Meals\Domain\Provider\DishProviderInterface;

class DishProvider implements DishProviderInterface
{
    private $dish;

    public function setDish(Dish $dish)
    {
        $this->dish = $dish;
    }

    public function getDish($dishId): Dish
    {
        return $this->dish;
    }
}