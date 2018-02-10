<?php
namespace App\Http\Controllers;


class GroupsController extends Controller
{
    /**
     * Return Groups index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.groups.index');
    }

    /**
     * Returns Groups Create page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Returns Groups Edit page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('admin.groups.edit');
    }
}