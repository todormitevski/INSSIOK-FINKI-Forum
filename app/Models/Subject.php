<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'major_id'];

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
