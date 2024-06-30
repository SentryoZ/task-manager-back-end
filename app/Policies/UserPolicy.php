<?php

namespace App\Policies;

use App\Const\PolicyConst;
use App\Helper\PolicyHelper;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::USER_READ);
    }

    public function view(User $user, User $dbUser): bool
    {
        // TODO: Bypass if view yourself
        return PolicyHelper::checkPolicies($user, PolicyConst::USER_READ);
    }

    public function create(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::USER_CREATE);
    }

    public function update(User $user, User $dbUser): bool
    {
        // TODO: Bypass if update yourself
        return PolicyHelper::checkPolicies($user, PolicyConst::USER_UPDATE);
    }

    public function delete(User $user, User $dbUser): bool
    {

        return PolicyHelper::checkPolicies($user, PolicyConst::USER_DELETE)
            && $user->id !== $dbUser->id;
    }

    public function restore(User $user, User $dbUser): bool
    {
        return true;
    }

    public function forceDelete(User $user, User $dbUser): bool
    {
        return true;
    }
}
