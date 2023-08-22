<?php

namespace Meals\Domain\Model\User;

use Meals\Domain\Model\User\Permission\PermissionList;

class User
{
    /** @var int */
    private $id;

    /** @var PermissionList */
    private $permissions;

    /**
     * User constructor.
     * @param int $id
     * @param PermissionList $permissions
     */
    public function __construct(int $id, PermissionList $permissions)
    {
        $this->id = $id;
        $this->permissions = $permissions;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return PermissionList
     */
    public function getPermissions(): PermissionList
    {
        return $this->permissions;
    }
}
