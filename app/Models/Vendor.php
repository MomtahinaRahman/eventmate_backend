<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'category', 'email', 'phone', 'response', 'review', 'rating', 'address','areas', 
        'licence', 'about', 'logo', 'fb', 'insta', 'whatsapp', 'linkedin', 'youtube', 'established'
    
    ];
}
