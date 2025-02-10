<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'major_id'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
