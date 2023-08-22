<?php

namespace Meals\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\EmployeeHasAlreadyPollResult;
use Meals\Domain\Model\Employee\Employee;
use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Provider\PollResultProviderInterface;

class EmployeeAlreadyHasPollResultValidator
{

    /**
     * @var PollResultProviderInterface
     */
    private $pollResultProvider;

    public function __construct(PollResultProviderInterface $pollResultProvider)
    {
        $this->pollResultProvider = $pollResultProvider;
    }

    public function validate(Employee $employee, Poll $poll)
    {
        $pollResult = $this->pollResultProvider->getPollResultByUserAndPoll($employee, $poll);
        if ($pollResult) {
            throw new EmployeeHasAlreadyPollResult();
        }

    }

}