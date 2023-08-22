<?php

namespace tests\Meals\Functional\Fake\Service;

use DateTime;
use Meals\Domain\Service\DateTimeServiceInterface;

class DateTimeService implements DateTimeServiceInterface
{
    /**
     * @var DateTime
     */
    private $currentDateTime;

    public function setCurrentDateTime(DateTime $dateTime)
    {
        $this->currentDateTime = $dateTime;
    }

    public function getCurrentDateTime(): DateTime
    {
        return $this->currentDateTime;
    }
}