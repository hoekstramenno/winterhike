<?php namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionsResource;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionsController
 *
 * @author: Menno Hoekstra
 * @created: 07/02/18
 * @version: 1.0
 * @package App\Http\Controllers\Api\V1
 */
class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return PermissionsResource
     */
    public function index()
    {
        PermissionsResource::withoutWrapping();
        return new PermissionsResource(Permission::paginate());
    }

    /**
     * Show one group
     *
     * @param Permission $permission
     * @return PermissionResource
     */
    public function show(Permission $permission)
    {
        PermissionResource::withoutWrapping();
        return new PermissionResource($permission);
    }

    /**
     * Store one group
     * @param CreatePermissionRequest $request
     * @return PermissionResource
     */
    public function store(CreatePermissionRequest $request)
    {
        $roles = $request['roles'];
        $permission = Permission::create([
            'name' => $request->name,
        ]);

//        if ( ! empty($request['roles'])) { //If one or more role is selected
//            foreach ($roles as $role) {
//                $role = Role::where('id', $role)->firstOrFail();
//                $permission = Permission::where('name', $request['name'])->first();
//                $role->givePermissionTo($permission);
//            }
//        }
        return new PermissionResource($permission);
    }

    /**
     * Update one Permission
     * @param StorePermissionRequest $request
     * @param Permission $permission
     * @return PermissionResource
     */
    public function update(StorePermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => request('name'),
            'guard_name' => request('guard_name')
        ]);

        return new PermissionResource($permission);
    }

    /**
     * Destroy this resource
     * @param Permission $permission
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Permission $permission)
    {
        if ($permission->name == "Administer roles & permissions") {
            return response(['status' => 'Permission not deleted']);
        }
        $permission->delete();

        return response(['status' => 'Permission deleted']);
    }
}
