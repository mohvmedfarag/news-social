<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Related extends Model
{
    use HasFactory;
    protected $table = 'related';   
    protected $fillable = ['name', 'url'];
}
