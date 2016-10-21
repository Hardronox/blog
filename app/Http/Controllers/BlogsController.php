<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Blogs;
use Request;

class BlogsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $todos = Blogs::all();
        return $todos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $todo = Blogs::create(Request::all());
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $todo = Blogs::find($id);
        $todo->done = Request::input('done');
        $todo->save();

        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Blogs::destroy($id);
    }

}