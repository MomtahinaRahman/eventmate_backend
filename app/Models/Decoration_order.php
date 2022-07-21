<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decoration_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id','service_id', 'quantity', 'comment', 'placement', 'space', 'guest', 'colors', 'customization',
    ];

}
