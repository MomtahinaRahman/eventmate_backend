<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photography_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id', 'photography_service_id', 'cameras', 'photographers', 'time', 'max_images', 
        'delivery_method', 'comment',
    ];
}
