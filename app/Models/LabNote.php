<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabNote extends Model
{
    public $timestamps = false;
    protected $table = 'lab_note';
    protected $primaryKey = 'id';
}