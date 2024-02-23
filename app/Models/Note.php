<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $timestamps = false;
    protected $table = 'note';
    protected $primaryKey = 'id';
}