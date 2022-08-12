<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id', 'music_service_id', 'djs', 'time', 'lights', 'soundbox', 'wireless_microphones', 
        'song_lists', 'comment', 'customization',
    ];
}
