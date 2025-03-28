<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path', 'attachable_id', 'attachable_type'];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }
}
