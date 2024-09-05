<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testing extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'testing';

    protected $fillable = [
        'photo',
        'file',
        'camera',
        'longitude',
        'latitude',
        'location',
        'ip_address',
    ];
}
