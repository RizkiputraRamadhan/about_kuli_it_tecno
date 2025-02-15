<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagesDemo extends Model
{
    use HasFactory;
    protected $table = 'images_demos';
    protected $guarded = ['id'];

    public function sourceCode(): BelongsTo {
        return $this->belongsTo(SourceCodes::class, 'sc_id');
    }
}
