<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'action',
        'user_name',
        'details',
        'ip_address',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
