<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TOW extends Model
{
    public $timestamps = false;
    protected $table = 'type_of_work';
    protected $primaryKey = 'id';
}