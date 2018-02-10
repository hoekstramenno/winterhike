<?php namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

/**
 * Class UserController
 *
 * @author: Menno Hoekstra
 * @created: 08/02/18
 * @version: 1.0
 * @package App\Http\Controllers\Api\V1
 */
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return UsersResource
     */
    public function index()
    {
        return new UsersResource(User::with(['roles'])->get());
    }

    /**
     * Show one group
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        UserResource::withoutWrapping();
        return new UserResource($user);
    }


    /**
     * Update one User
     * @param StoreUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $roles = $request['roles'];
        $user->update([
            'name' => request('name'),
            'email' => request('email')
        ]);

        $roleIds = [];
        foreach ($roles as $role) {
            $roleIds[] = $role['id'];
        }

        if (isset($roleIds)) {
            $user->roles()->sync($roleIds);
        } else {
            $user->roles()->detach();
        }
        return new UserResource($user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(['status' => 'User deleted']);
    }
}
