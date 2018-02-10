<?php namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RolesResource;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolesController
 *
 * @author: Menno Hoekstra
 * @created: 07/02/18
 * @version: 1.0
 * @package App\Http\Controllers\Api\V1
 */
class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return RolesResource
     */
    public function index()
    {
        //RolesResource::withoutWrapping();
        return new RolesResource(Role::with(['permissions'])->get());
    }

    /**
     * Show one group
     *
     * @param Role $role
     * @return RoleResource
     */
    public function show(Role $role)
    {
        //RoleResource::withoutWrapping();
        $role = Role::where('id', $role->id)->with(['permissions'])->get();
        return new RoleResource($role);
    }

    /**
     * Store one group
     * @param CreateRoleRequest $request
     * @return RoleResource
     */
    public function store(CreateRoleRequest $request)
    {
        $permissions = $request['permissions'];
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

//        foreach ($permissions as $permission) {
//            $permission = Permission::where('id', $permission)->firstOrFail();
//            $role = Role::where('name', $request['name'])->first();
//            $role->givePermissionTo($permission);
//        }

        return new RoleResource($role);
    }

    /**
     * Update one Role
     * @param StoreRoleRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $permissions = $request['permissions'];
        $role->update([
            'name' => request('name'),
            'guard_name' => request('guard_name')
        ]);
        $permissionsAll = Permission::all();

        foreach ($permissionsAll as $permission) {
            $role->revokePermissionTo($permission);
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }

        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response(['status' => 'Role deleted']);
    }
}
