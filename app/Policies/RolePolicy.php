<?php

namespace App\Policies;

use App\Const\PolicyConst;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Helper\PolicyHelper;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::ROLE_READ);
    }

    public function view(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::ROLE_READ);
    }

    public function create(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::ROLE_CREATE);
    }

    public function update(User $user, Role $role): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::ROLE_UPDATE);
    }

    public function delete(User $user, Role $role): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::ROLE_DELETE);
    }

    public function restore(User $user, Role $role): bool
    {
        return true;
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return true;
    }
}
