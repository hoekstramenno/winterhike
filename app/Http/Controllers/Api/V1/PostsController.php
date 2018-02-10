<?php namespace App\Http\Controllers\Api\V1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostsController
 *
 * @author: Menno Hoekstra
 * @created: 07/02/18
 * @version: 1.0
 * @package App\Http\Controllers\Api\V1
 */
class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Admin')->except('show');
    }

    /**
     * List Resource
     * @return array
     */
    public function index()
    {

        return ['data' => Post::all()];
    }

    /**
     * Show Resource
     * @param $id
     * @return mixed
     */
    public function show(Post $post)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            return $post;
        }
    }

    /**
     * Update Resource
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->all());

        return $post;
    }

    /**
     * Store Resource
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return Post::create($request->all());
    }

    /**
     * Destroy Resource
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return '';
    }
}
