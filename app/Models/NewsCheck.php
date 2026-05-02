<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCheck extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'source_url',
        'result',
        'credibility_score',
        'sentiment',
        'ai_details',
    ];

    protected $casts = [
        'ai_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
