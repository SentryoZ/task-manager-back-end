<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Response\Response;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', User::class);

        return Response::successResponse(
            UserResource::collection(User::query()->orderBy('updated_at')->get()),
            __('crud.read', [
                'item' => __('user.item')
            ])
        );
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        $data = $this->handleAvatar($data);
        $password = Str::password('16');
        $data['password'] = $password;

        //TODO: Send mail
        Log::info("Create {$data['email']} with password {$password}");

        return Response::successResponse(new UserResource(User::query()->create($data)),
            __('crud.create', [
                'item' => __('user.item')
            ]));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return Response::successResponse(
            new UserResource($user),
            __('crud.read', [
                'item' => __('user.item_with_name', [
                    'name' => $user->name
                ])
            ])
        );
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validated();
        $data = $this->handleAvatar($data, $user);

        $user->update($data);

        return Response::successResponse(
            new UserResource($user),
            __('crud.update', [
                'item' => __('user.item_with_name', [
                    'name' => $user->name
                ])
            ])
        );
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return Response::successResponse(
            message: __('crud.delete', [
                'item' => __('user.item_with_name', [
                    'name' => $user->name
                ])
            ])
        );
    }

    private function handleAvatar(array $data, User $user = null)
    {
        if (isset($data['avatar'])) {
            if (!is_null($user) && !is_null($user->avatar)) {
                Storage::delete("/avatar/$user->avatar}");
            }
            $file = request()->file('avatar');
            $path = "avatar/" . md5(Str::random()) . "." . $file->getClientOriginalExtension();
            Storage::disk('public')->put(
                $path,
                $file->getContent()
            );
            $data['avatar'] = $path;
        }

        return $data;
    }
}
