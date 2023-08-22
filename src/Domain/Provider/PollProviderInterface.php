<?php

namespace Meals\Domain\Provider;

use Meals\Domain\Model\Poll\Poll;
use Meals\Domain\Model\Poll\PollList;

interface PollProviderInterface
{
    public function getActivePolls(): PollList;

    public function getPoll(int $pollId): Poll;
}
