<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public $timestamps = false;
    protected $table = 'prescription';
    protected $primaryKey = 'id';
}