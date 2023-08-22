<?php

namespace tests\Meals\Functional\Fake\Provider;

use Meals\Domain\Model\Employee\Employee;
use Meals\Domain\Provider\EmployeeProviderInterface;

class FakeEmployeeProvider implements EmployeeProviderInterface
{
    /** @var Employee */
    private $employee;

    public function getEmployee(int $employeeId): Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }
}
