<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function posteable()
    {
        return $this->morphTo(__FUNCTION__,'posteable_type','posteable_id');
    }
}
