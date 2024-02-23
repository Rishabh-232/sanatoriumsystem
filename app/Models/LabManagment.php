<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabManagment extends Model
{
    public $timestamps = false;
    protected $table = 'lab';
    protected $primaryKey = 'id';
}