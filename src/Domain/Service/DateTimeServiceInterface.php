<?php

namespace Meals\Domain\Service;

use DateTime;

interface DateTimeServiceInterface
{
    public function getCurrentDateTime(): DateTime;
}