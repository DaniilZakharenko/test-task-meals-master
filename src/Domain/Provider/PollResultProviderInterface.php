<?php

namespace Meals\Domain\Provider;

use Meals\Domain\Model\Employee\Employee;
use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Model\Poll\PollResult;

interface PollResultProviderInterface 
{
    public function save(PollResult $pollResult);

    public function getPollResultByUserAndPoll(Employee $employee, Poll $poll): ?PollResult;

}
