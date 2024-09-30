<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\TaskResource;
use App\Http\Response\Response;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Task::class);

        return Response::successResponse(
            TaskResource::collection(Task::query()->orderBy('start_time')->get()),
            __('crud.read', [
                'item' => __('task.item')
            ])
        );
    }

    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        return Response::successResponse(
            new TaskResource(Task::create($data)->load('user', 'assignedUser', 'project')),
            __('crud.create', [
                'item' => __('task.item')
            ])
        );
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return Response::successResponse(
            new TaskResource($task->load('user', 'assignedUser', 'project')),
            __('crud.read', [
                'item' => __('task.item')
            ])
        );
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $task->update($data);

        return Response::successResponse(
            new TaskResource($task->load('user', 'assignedUser', 'project')),
            __('crud.update', [
                'item' => __('task.item')
            ])
        );
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return Response::successResponse(
            message: __('crud.delete', [
                'item' => __('task.item')
            ])
        );
    }
}
