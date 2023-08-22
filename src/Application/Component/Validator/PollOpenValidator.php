<?php

namespace Meals\Application\Component\Validator;

use DateTime;
use Meals\Application\Component\Validator\Exception\PollIsNotOpenException;
use Meals\Domain\Model\Poll\Poll;

class PollOpenValidator
{
    public function validate(Poll $poll, DateTime $currentDateTime){
        $pollRuleOpen = $poll->getPullRuleOpen();

        $currentDay = (int)$currentDateTime->format('w');
        $currentTime = $currentDateTime->format('H:i');

        if ($pollRuleOpen->getDayWhenOpen() !== $currentDay) {
            throw new PollIsNotOpenException();
        }

         if($pollRuleOpen->getTimeStartOpen() > $currentTime || $pollRuleOpen->getTimeEndOpen() < $currentTime){
             throw new PollIsNotOpenException();
         }
    }
}