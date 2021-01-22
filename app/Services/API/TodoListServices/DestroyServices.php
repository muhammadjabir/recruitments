<?php
namespace App\Services\API\TodoListServices;
use App\Models\Post;

class DestroyServices {
    public function handle($id) {
        $data = Post::findOrFail($id);
        $data->delete();
        return $data;
    }
}
