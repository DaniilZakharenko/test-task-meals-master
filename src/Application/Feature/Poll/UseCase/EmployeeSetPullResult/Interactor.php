<?php

namespace Meals\Application\Feature\Poll\UseCase\EmployeeSetPullResult;

use Meals\Application\Component\Factory\PollResultFactory;
use Meals\Application\Component\Validator\EmployeeAlreadyHasPollResultValidator;
use Meals\Application\Component\Validator\MenuHasAvailableDishValidator;
use Meals\Application\Component\Validator\PollIsActiveValidator;
use Meals\Application\Component\Validator\PollOpenValidator;
use Meals\Application\Component\Validator\UserHasAccessToParticipationPollsValidator;
use Meals\Application\Component\Validator\UserHasAccessToViewPollsValidator;
use Meals\Domain\Model\Poll\PollResult;
use Meals\Domain\Provider\DishProviderInterface;
use Meals\Domain\Provider\EmployeeProviderInterface;
use Meals\Domain\Provider\PollProviderInterface;
use Meals\Domain\Provider\PollResultProviderInterface;
use Meals\Domain\Service\DateTimeServiceInterface;

class Interactor
{
    /** @var EmployeeProviderInterface */
    private $employeeProvider;

    /** @var PollProviderInterface */
    private $pollProvider;

    /** @var UserHasAccessToViewPollsValidator */
    private $userHasAccessToPollsValidator;

    /** @var PollIsActiveValidator */
    private $pollIsActiveValidator;
    /**
     * @var DishProviderInterface
     */
    private $dishProvider;
    /**
     * @var MenuHasAvailableDishValidator
     */
    private $menuHasAvailableDishValidator;
    /**
     * @var PollResultFactory
     */
    private $pollResultFactory;
    /**
     * @var PollResultProviderInterface
     */
    private $pollResultProvider;
    /**
     * @var EmployeeAlreadyHasPollResultValidator
     */
    private $alreadyHasPollResultValidator;
    /**
     * @var PollOpenValidator
     */
    private $pollOpenValidator;
    /**
     * @var DateTimeServiceInterface
     */
    private $dateTimeService;

    public function __construct(
        EmployeeProviderInterface                  $employeeProvider,
        PollProviderInterface                      $pollProvider,
        UserHasAccessToParticipationPollsValidator $userHasAccessToPollsValidator,
        PollIsActiveValidator                      $pollIsActiveValidator,
        DishProviderInterface                      $dishProvider,
        MenuHasAvailableDishValidator              $menuHasAvailableDishValidator,
        PollResultFactory                          $pollResultFactory,
        PollResultProviderInterface                $pollResultProvider,
        EmployeeAlreadyHasPollResultValidator      $alreadyHasPollResultValidator,
        PollOpenValidator                          $pollOpenValidator,
        DateTimeServiceInterface                   $dateTimeService
    )
    {
        $this->employeeProvider = $employeeProvider;
        $this->pollProvider = $pollProvider;
        $this->userHasAccessToPollsValidator = $userHasAccessToPollsValidator;
        $this->pollIsActiveValidator = $pollIsActiveValidator;
        $this->dishProvider = $dishProvider;
        $this->menuHasAvailableDishValidator = $menuHasAvailableDishValidator;
        $this->pollResultFactory = $pollResultFactory;
        $this->pollResultProvider = $pollResultProvider;
        $this->alreadyHasPollResultValidator = $alreadyHasPollResultValidator;
        $this->pollOpenValidator = $pollOpenValidator;
        $this->dateTimeService = $dateTimeService;
    }

    public function setPullResult(int $employeeId, int $pollId, int $dishId): PollResult
    {
        $employee = $this->employeeProvider->getEmployee($employeeId);
        $poll = $this->pollProvider->getPoll($pollId);
        $dish = $this->dishProvider->getDish($dishId);

        $this->userHasAccessToPollsValidator->validate($employee->getUser());
        $this->pollIsActiveValidator->validate($poll);
        $this->menuHasAvailableDishValidator->validate($dish, $poll->getMenu());
        $this->alreadyHasPollResultValidator->validate($employee, $poll);
        $this->pollOpenValidator->validate($poll, $this->dateTimeService->getCurrentDateTime());

        $pollResult = $this->pollResultFactory->create($poll, $employee, $dish);
        $this->pollResultProvider->save($pollResult);

        return $pollResult;
    }

}
