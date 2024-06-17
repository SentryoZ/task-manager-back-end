<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Response\Response;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        return Response::successResponse(
            ProjectResource::collection(Project::query()->orderBy('updated_at')->get()),
            __('crud.read', [
                'item' => __('project.item')
            ])
        );
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        return Response::successResponse(new ProjectResource(Project::create($data)),
            __('crud.create', [
                'item' => __('project.item')
            ]));
    }

    public function show(Project $project)
    {
        return Response::successResponse(
            new ProjectResource($project),
            __('crud.read', [
                'item' => __('project.item_with_name', [
                    'name' => $project->name
                ])
            ])
        );
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return Response::successResponse(
            new ProjectResource($project),
            __('crud.update', [
                'item' => __('project.item_with_name', [
                    'name' => $project->name
                ])
            ])
        );
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return Response::successResponse(
            message: __('crud.delete', [
                'item' => __('project.item_with_name', [
                    'name' => $project->name
                ])
            ])
        );
    }
}
