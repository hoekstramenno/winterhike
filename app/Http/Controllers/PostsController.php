<?php
namespace App\Http\Controllers;


class PostsController extends Controller
{
    /**
     * Return Groups index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Returns Groups Create page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Returns Groups Edit page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('admin.posts.edit');
    }
}