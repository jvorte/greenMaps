<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summit extends Model
{
    use HasFactory;

    // Αν υπάρχουν στήλες που πρέπει να συμπεριληφθούν στο "Mass Assignment"
    protected $fillable = ['name', 'location', 'other_column'];
}
