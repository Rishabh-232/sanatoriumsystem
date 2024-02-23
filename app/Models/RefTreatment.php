<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefTreatment extends Model
{
    public $timestamps = false;
    protected $table = 'reference_treatments';
    protected $primaryKey = 'id';
}