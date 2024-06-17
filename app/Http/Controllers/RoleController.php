<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Http\Response\Response;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Role::class);

        return Response::successResponse(
            RoleResource::collection(Role::query()->orderBy('updated_at')->get()),
            __('crud.read', [
                'item' => __('role.item')
            ])
        );
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);

        return Response::successResponse(new RoleResource(Role::create($request->validated())),
            __('crud.create', [
                'item' => __('role.item')
            ]));
    }

    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return Response::successResponse(
            new RoleResource($role),
            __('crud.read', [
                'item' => __('role.item_with_name', [
                    'name' => $role->name
                ])
            ])
        );
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $role->update($request->validated());

        return Response::successResponse(
            new RoleResource($role),
            __('crud.update', [
                'item' => __('role.item_with_name', [
                    'name' => $role->name
                ])
            ])
        );
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return Response::successResponse(
            message: __('crud.delete', [
                'item' => __('role.item_with_name', [
                    'name' => $role->name
                ])
            ])
        );
    }
}
