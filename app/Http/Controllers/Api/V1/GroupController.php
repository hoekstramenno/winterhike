<?php namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupsResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return GroupsResource
     */
    public function index()
    {
        GroupsResource::withoutWrapping();
        return new GroupsResource(Group::with(['times', 'scores'])->paginate());
    }

    /**
     * Show one group
     *
     * @param Group $group
     * @return GroupResource
     */
    public function show(Group $group)
    {
        GroupResource::withoutWrapping();
        return new GroupResource($group);
    }

    /**
     * Store one group
     * @param CreateGroupRequest $request
     * @return GroupResource
     */
    public function store(CreateGroupRequest $request)
    {
        $group = Group::create($request->all());
        return new GroupResource($group);
    }

    /**
     * Update one Group
     * @param StoreGroupRequest $request
     * @param Group $group
     * @return GroupResource
     */
    public function update(StoreGroupRequest $request, Group $group)
    {
        $group->update([
            'name' => request('name'),
            'number' => request('number'),
            'groupname' => request('groupname')
        ]);
        return new GroupResource($group);
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return response(['status' => 'Group deleted']);
    }
}
