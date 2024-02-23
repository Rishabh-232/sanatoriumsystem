<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomMessage extends Model
{
    public $timestamps = false;
    protected $table = 'custommessage';
    protected $primaryKey = 'id';
}