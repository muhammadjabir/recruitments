<?php
namespace App\Services\API\TodoListServices;
use App\Models\Post;

class StoreServices {
    public function handle($request) {
        $data = new Post();
        $data->title = $request['title'];
        $data->descrption = $request['descrption'];
        $data->posteable_id = \Auth::user()->id;
        $data->posteable_type = 'App\Models\User';
        $data->save();
        return $data;
    }
}
