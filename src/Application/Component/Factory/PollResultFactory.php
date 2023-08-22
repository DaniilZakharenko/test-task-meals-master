<?php

namespace Meals\Application\Component\Factory;

use Meals\Domain\Model\Dish\Dish;
use Meals\Domain\Model\Employee\Employee;
use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Model\Poll\PollResult;

class PollResultFactory
{
    public function create(Poll $poll, Employee $employee, Dish $dish): PollResult
    {
        return new PollResult(
            0,
            $poll,
            $employee,
            $dish
        );
    }

}