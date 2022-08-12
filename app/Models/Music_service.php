<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music_service extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'vendor_id', 'djs', 'time', 'max_songs', 'lights', 'soundbox', 'wireless_microphones',
        'price',
    ];
}
