<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'summit', 'plot', 'plant_type', 'survey_type', 'species', 'cover', 'user_id',
    ];

    // Σχέση με τον χρήστη
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
