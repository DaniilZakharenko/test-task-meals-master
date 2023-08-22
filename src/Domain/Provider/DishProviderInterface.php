<?php

namespace Meals\Domain\Provider;

use Meals\Domain\Model\Dish\Dish;

interface DishProviderInterface
{

    public function getDish($dishId): Dish;

}
