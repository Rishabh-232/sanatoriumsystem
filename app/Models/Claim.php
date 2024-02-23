<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    public $timestamps = false;
    protected $table = 'claims';
    protected $primaryKey = 'id';
}