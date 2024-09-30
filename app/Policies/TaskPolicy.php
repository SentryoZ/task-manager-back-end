<?php

namespace App\Policies;

use App\Const\PolicyConst;
use App\Helper\PolicyHelper;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::TASK_READ);
    }

    public function view(User $user, Task $task): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::TASK_READ) || $task->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::TASK_CREATE);
    }

    public function update(User $user, Task $task): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::TASK_UPDATE);
    }

    public function delete(User $user, Task $task): bool
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::TASK_DELETE);
    }

    public function restore(User $user, Task $task): bool
    {
        return true;
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return true;
    }
}
