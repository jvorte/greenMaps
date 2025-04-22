<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClimateData extends Model
{
    // Οι στήλες που μπορούμε να μαζέψουμε και να αποθηκεύσουμε
    protected $fillable = [
        'latitude', 'longitude', 'date', 'temperature', 'humidity', 'wind_speed', 'plant_type', 'region',
    ];
}
