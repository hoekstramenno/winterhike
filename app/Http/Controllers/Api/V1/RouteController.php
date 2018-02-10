<?php namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Resources\RouteResource;
use App\Http\Resources\RoutesResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Route;

class RouteController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return ['data' => Route::all()];
    }

    /**
     * Show one group
     *
     * @param Route $route
     * @return RouteResource
     */
    public function show(Route $route)
    {
        RouteResource::withoutWrapping();
        return new RouteResource($route);
    }

    /**
     * Store one group
     * @param Request $request
     * @return RouteResource
     */
    public function store(Request $request)
    {
        $route = Route::create($request->all());
        return new RouteResource($route);
    }

    /**
     * @param Request $request
     * @param Route $route
     * @return RouteResource
     */
    public function update(Request $request, Route $route)
    {
        $route->update([
            'number' => request('number'),
            'post_start' => request('post_start'),
            'post_end' => request('post_end')
        ]);
        return new RouteResource($route);
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return response(['status' => 'Route deleted']);
    }
}
