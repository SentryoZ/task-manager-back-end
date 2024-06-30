<?php

namespace App\Policies;

use App\Const\PolicyConst;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Helper\PolicyHelper;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::PROJECT_READ);
    }

    public function view(User $user, Project $project)
    {
        //TODO: Add check user in project or not
        return PolicyHelper::checkPolicies($user, PolicyConst::PROJECT_READ);
    }

    public function create(User $user)
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::PROJECT_CREATE);
    }

    public function update(User $user, Project $project)
    {
        //TODO: Add check user in project or not
        return PolicyHelper::checkPolicies($user, PolicyConst::PROJECT_UPDATE);
    }

    public function delete(User $user, Project $project)
    {
        return PolicyHelper::checkPolicies($user, PolicyConst::PROJECT_DELETE)
            && $project->user_id === $user->id;
    }

    public function restore(User $user, Project $project)
    {
        return true;
    }

    public function forceDelete(User $user, Project $project)
    {
        return true;
    }
}
