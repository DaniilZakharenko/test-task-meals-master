<?php

namespace tests\Meals\Functional\Fake\Provider;

use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Model\Poll\PollList;
use Meals\Domain\Provider\PollProviderInterface;

class FakePollProvider implements PollProviderInterface
{
    /** @var Poll */
    private $poll;

    /** @var PollList */
    private $polls;

    public function getActivePolls(): PollList
    {
        return $this->polls;
    }

    public function getPoll(int $pollId): Poll
    {
        return $this->poll;
    }

    /**
     * @param Poll $poll
     */
    public function setPoll(Poll $poll): void
    {
        $this->poll = $poll;
    }

    /**
     * @param PollList $polls
     */
    public function setPolls(PollList $polls): void
    {
        $this->polls = $polls;
    }
}
