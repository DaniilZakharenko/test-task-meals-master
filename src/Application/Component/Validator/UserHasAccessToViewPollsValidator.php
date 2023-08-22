<?php

namespace Meals\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\AccessDeniedException;
use Meals\Domain\Model\User\Permission\Permission;
use Meals\Domain\Model\User\User;

class UserHasAccessToViewPollsValidator
{
    public function validate(User $user): void
    {
        if (!$user->getPermissions()->hasPermission(new Permission(Permission::VIEW_ACTIVE_POLLS))) {
            throw new AccessDeniedException();
        }
    }
}
