<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow_vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id', 
    ];
}
