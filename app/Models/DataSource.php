<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSource extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'description']; // Επιτρέπει την μαζική αντιστοίχιση αυτών των πεδίων
}