<?php

namespace tests\Meals\Functional\Fake\Provider;

use Meals\Domain\Model\Employee\Employee;
use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Model\Poll\PollResult;
use Meals\Domain\Provider\PollResultProviderInterface;

class PollResultProvider implements PollResultProviderInterface
{
    private $lastId = 0;
    private $pollResult;
    public function save(PollResult $pollResult)
    {
        if($pollResult->getId() === 0){
            $reflection = new \ReflectionClass($pollResult);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($pollResult, ++$this->lastId);
        }
    }

    public function getPollResultByUserAndPoll(Employee $employee, Poll $poll): ?PollResult
    {
        return $this->pollResult;
    }

    public function setPollResult(PollResult $pollResult)
    {
        $this->pollResult = $pollResult;
    }
}