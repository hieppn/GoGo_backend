<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'send_from',
            'send_to',
            'time_send',
            'name',
            'mass',
            'unit',
            'id_truck',
            'note',
            'image',
            'type',
           'id_user',
    ];
}
