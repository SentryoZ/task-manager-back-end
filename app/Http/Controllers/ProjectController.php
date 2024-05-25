<?php

namespace App\Http\Controllers;

use App\Const\PaginateConst;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Response\Response;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        return Response::successResponse(ProjectResource::collection(Project::all()));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        return Response::successResponse(new ProjectResource(Project::create($data)));
    }

    public function show(Project $project)
    {
        return Response::successResponse(new ProjectResource($project));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json();
    }
}
