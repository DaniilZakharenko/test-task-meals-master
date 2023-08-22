<?php

namespace Meals\Domain\Provider;

use Meals\Domain\Model\Employee\Employee;

interface EmployeeProviderInterface
{
    public function getEmployee(int $employeeId): Employee;
}
