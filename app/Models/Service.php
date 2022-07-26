<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'vendor_id', 'user_id', 'description', 'price', 'inform', 'build', 'placement', 'space', 'guest',
        'colors', 'customization', 'location'
    ];
}
