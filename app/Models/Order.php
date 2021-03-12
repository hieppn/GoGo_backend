<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'send_from',
        'send_to',
        'time_send',
        'name',
        'mass',
        'unit',
        'car_type',
        'note',
        'image',
        'type',
        'id_sender',
        
    ];

}
