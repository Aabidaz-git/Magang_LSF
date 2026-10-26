<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'title',
        'filename',
        'file_size_bytes',
        'file_size_formatted',
        'format',
        'duration',
        'resolution',
        'sha256_hash',
        'storage_path',
        'recommended_rating',
        'final_rating',
        'confidence_rate',
        'status',
        'medium',
        'genre',
        'elements',
        'reviewer_name',
        'reviewer_notes',
        'verified_at',
    ];

    protected $casts = [
        'elements' => 'array',
        'confidence_rate' => 'float',
        'verified_at' => 'datetime',
    ];

    public function sceneReports(): HasMany
    {
        return $this->hasMany(SceneReport::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }
}
