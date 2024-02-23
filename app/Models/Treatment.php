<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public $timestamps = false;
    protected $table = 'treatments';
    protected $primaryKey = 'id';
}