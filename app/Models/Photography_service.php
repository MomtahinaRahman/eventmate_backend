<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photography_service extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'vendor_id', 'cameras', 'photographers', 'time', 'price', 'portfolio', 'professional_editing', 
        'max_images', 'delivery_method', 'description', 'phone', 'studio', 'location',
    ];
}
