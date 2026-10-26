<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SceneReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'timecode',
        'scene_summary',
        'tag',
        'risk_level',
        'evidence_frames',
        'reviewer_notes',
        'is_flagged',
    ];

    protected $casts = [
        'evidence_frames' => 'array',
        'is_flagged' => 'boolean',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
