<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SourceCodes extends Model
{
    use HasFactory;
    protected $table = 'source_codes';
    protected $guarded = ['id'];

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assets(): HasMany {
        return $this->hasMany(ImagesDemo::class, 'sc_id');
    }
}
