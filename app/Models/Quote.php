<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $timestamps = false;
    protected $table = 'quotes';
    protected $primaryKey = 'id';
}