<?php
namespace App\Services\API\TodoListServices;
use App\Models\Post;

class UpdateServices {
    public function handle($request,$id) {
        $data = Post::findOrFail($id);
        $data->title = $request->title;
        $data->descrption = $request->descrption;
        $data->posteable_id = 1;
        $data->posteable_type = 'App\Models\User';
        $data->save();
        return $data;
    }
}
