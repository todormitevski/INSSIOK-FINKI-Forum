<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    protected $fillable = [
        'file_name',
        'file_content',
        'mime_type',
        'attachable_id',
        'attachable_type'
    ];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }
}
