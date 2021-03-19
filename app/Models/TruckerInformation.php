<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckerInformation extends Model
{
    use HasFactory;
    protected $fillable = ['id_trucker'];
}
