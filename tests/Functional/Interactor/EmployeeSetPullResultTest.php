<?php

namespace tests\Meals\Functional\Interactor;

use Meals\Application\Component\Validator\Exception\AccessDeniedException;
use Meals\Application\Component\Validator\Exception\EmployeeHasAlreadyPollResult;
use Meals\Application\Component\Validator\Exception\MenuNotAvailableDishException;
use Meals\Application\Component\Validator\Exception\PollIsNotActiveException;
use Meals\Application\Component\Validator\Exception\PollIsNotOpenException;
use Meals\Application\Feature\Poll\UseCase\EmployeeSetPullResult\Interactor;
use Meals\Domain\Model\Dish\Dish;
use Meals\Domain\Model\Dish\DishList;
use Meals\Domain\Model\Employee\Employee;
use Meals\Domain\Model\Menu\Menu;
use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Model\Poll\PollResult;
use Meals\Domain\Model\Poll\PollRuleOpen;
use Meals\Domain\Model\User\Permission\Permission;
use Meals\Domain\Model\User\Permission\PermissionList;
use Meals\Domain\Model\User\User;
use tests\Meals\Functional\Fake\Provider\DishProvider;
use tests\Meals\Functional\Fake\Provider\FakeEmployeeProvider;
use tests\Meals\Functional\Fake\Provider\FakePollProvider;
use tests\Meals\Functional\Fake\Provider\PollResultProvider;
use tests\Meals\Functional\Fake\Service\DateTimeService;
use tests\Meals\Functional\FunctionalTestCase;

class EmployeeSetPullResultTest extends FunctionalTestCase
{
    public function testSuccessful()
    {
        $this->getContainer()->get(DateTimeService::class)->setCurrentDateTime(new \DateTime('2022-08-14 14:00'));
        $pollResult = $this->performTestMethod($this->getEmployeeWithPermissions(), $this->getPoll(true), $this->getDish());
        verify($pollResult)->equals($pollResult);
    }

    public function testUserHasNotPermissions()
    {
        $this->expectException(AccessDeniedException::class);
        $this->getContainer()->get(DateTimeService::class)->setCurrentDateTime(new \DateTime('2022-08-14 14:00'));

        $pollResult = $this->performTestMethod($this->getEmployeeWithNoPermissions(), $this->getPoll(true), $this->getDish());
        verify($pollResult)->equals($pollResult);
    }

    public function testPollIsNotActive()
    {
        $this->expectException(PollIsNotActiveException::class);
        $this->getContainer()->get(DateTimeService::class)->setCurrentDateTime(new \DateTime('2022-08-14 14:00'));

        $pollResult = $this->performTestMethod($this->getEmployeeWithPermissions(), $this->getPoll(false), $this->getDish());
        verify($pollResult)->equals($pollResult);
    }

    public function testPollIsNotOpen()
    {

        $this->expectException(PollIsNotOpenException::class);
        $this->getContainer()->get(DateTimeService::class)->setCurrentDateTime(new \DateTime('2022-08-14 23:00'));
        $pollResult = $this->performTestMethod($this->getEmployeeWithPermissions(), $this->getPoll(true), $this->getDish());
        verify($pollResult)->equals($pollResult);
    }

    public function testMenuNotHasDish()
    {
        $this->expectException(MenuNotAvailableDishException::class);
        $this->getContainer()->get(DateTimeService::class)->setCurrentDateTime(new \DateTime('2022-08-14 14:00'));
        $pollResult = $this->performTestMethod($this->getEmployeeWithPermissions(), $this->getPoll(true), $this->getDishNotInMenu());
        verify($pollResult)->equals($pollResult);
    }

    public function testAlreadyExistPollResult()
    {
        $this->expectException(EmployeeHasAlreadyPollResult::class);

        $this->getContainer()->get(DateTimeService::class)->setCurrentDateTime(new \DateTime('2022-08-14 14:00'));
        $this->getContainer()->get(PollResultProvider::class)->setPollResult($this->getPollResult());

        $pollResult = $this->performTestMethod($this->getEmployeeWithPermissions(), $this->getPoll(true), $this->getDish());
        verify($pollResult)->equals($pollResult);
    }

    private function performTestMethod(Employee $employee, Poll $poll, Dish $dish): PollResult
    {
        $this->getContainer()->get(FakeEmployeeProvider::class)->setEmployee($employee);
        $this->getContainer()->get(FakePollProvider::class)->setPoll($poll);
        $this->getContainer()->get(DishProvider::class)->setDish($dish);
        return $this->getContainer()->get(Interactor::class)->setPullResult($employee->getId(), $poll->getId(), $dish->getId());
    }

    private function getEmployeeWithPermissions(): Employee
    {
        return new Employee(
            1,
            $this->getUserWithPermissions(),
            4,
            'Surname'
        );
    }

    private function getUserWithPermissions(): User
    {
        return new User(
            1,
            new PermissionList(
                [
                    new Permission(Permission::VIEW_ACTIVE_POLLS),
                    new Permission(Permission::PARTICIPATION_IN_POLLS),
                ]
            ),
        );
    }

    private function getEmployeeWithNoPermissions(): Employee
    {
        return new Employee(
            1,
            $this->getUserWithNoPermissions(),
            4,
            'Surname'
        );
    }

    private function getUserWithNoPermissions(): User
    {
        return new User(
            1,
            new PermissionList([]),
        );
    }

    private function getDish(): Dish
    {
        return new Dish(1, 'Title','Description');
    }

    private function getDishNotInMenu(): Dish
    {
        return new Dish(192121, 'Title','Description');
    }

    private function getPoll(bool $active): Poll
    {
        return new Poll(
            1,
            $active,
            new Menu(
                1,
                'title',
                new DishList([
                    $this->getDish()
                ]),
            ),
            new PollRuleOpen(
                0,
                '08:00',
                '20:00'
            ),
        );
    }

    private function getPollResult(): PollResult
    {
        return new PollResult(
            1,
            $this->getPoll(true),
            $this->getEmployeeWithPermissions(),
            $this->getDish()
        );
    }
}