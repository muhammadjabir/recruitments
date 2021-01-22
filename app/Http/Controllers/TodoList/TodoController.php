<?php

namespace App\Http\Controllers\TodoList;

use App\Http\Controllers\Controller;
use App\Jobs\CreateNewTodoForShowLater;
use App\Models\Post;
use App\Models\User;
use App\Services\API\TodoListServices\DestroyServices;
use App\Services\API\TodoListServices\StoreServices;
use App\Services\API\TodoListServices\UpdateServices;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = User::with(['posts','comments'])
        // ->where('id',\Auth::user()->id)
        // ->first();
        // return $data->posts;
        return Post::with('posteable')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,StoreServices $storeServices)
    {
        CreateNewTodoForShowLater::dispatch($request->all());
        return response()->json([
            'message' => 'Success Add Post',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,UpdateServices $updateServices)
    {
        $data = $updateServices->handle($request,$id);
        return response()->json([
            'message' => 'Success update Post',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DestroyServices $destroyServices)
    {
        $data = $destroyServices->handle($id);
        return response()->json([
            'message' => 'Success Delete Post',
            'data' => $data
        ]);
    }
}
