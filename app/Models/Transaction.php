<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $guarded = [''];

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function code(): BelongsTo {
        return $this->belongsTo(CodeVoucher::class, 'voucher');
    }

    public function source(): BelongsTo {
        return $this->belongsTo(SourceCodes::class, 'source_code');
    }
}
