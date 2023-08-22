<?php

namespace Meals\Domain\Model\Poll;

class PollRuleOpen
{
    /**
     * @var array
     */
    private $dayWhenOpen;
    /**
     * @var string
     */
    private $timeStartOpen;
    /**
     * @var string
     */
    private $timeEndOpen;

    /**
     * @param int $dayWhenOpen
     * @param string $timeStartOpen
     * @param string $timeEndOpen
     */
    public function __construct(int $dayWhenOpen, string $timeStartOpen, string $timeEndOpen)
    {
        $this->dayWhenOpen = $dayWhenOpen;
        $this->timeStartOpen = $timeStartOpen;
        $this->timeEndOpen = $timeEndOpen;
    }

    public function getDayWhenOpen(): int
    {
        return $this->dayWhenOpen;
    }

    public function getTimeStartOpen(): string
    {
        return $this->timeStartOpen;
    }

    public function getTimeEndOpen(): string
    {
        return $this->timeEndOpen;
    }
}