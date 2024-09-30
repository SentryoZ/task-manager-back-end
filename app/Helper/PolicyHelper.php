<?php

namespace App\Helper;

use App\Models\User;

class PolicyHelper
{

    /**
     * Check if user have policy or not
     *
     * @param User $user
     * @param string $policy
     * @return bool
     */
    public static function checkPolicies(User $user, string $policy): bool
    {
        if (env('APP_BYPASS_CHECK', false)) {
            return true;
        }
        $policies = $user->role->policies;
        return in_array($policy, $policies);
    }
}
