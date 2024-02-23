<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMaster extends Model
{
    public $timestamps = false;
    protected $table = 'prescription_master';
    protected $primaryKey = 'id';
}