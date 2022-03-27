<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    protected $primaryKey = 'user_id';
    use Sluggable;
    use HasFactory;
    protected $guarded = [];  
    public $timestamps = false;

    public function sluggable() : array{
        return [
            'slug' => [
                'source' => 'name'
                ]
            ];
    }


    public function user()
    {
        return $this->belongsTo("User");
    }
}
