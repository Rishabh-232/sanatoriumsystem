<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    public $timestamps = false;
    protected $table = 'doc_signature';
    protected $primaryKey = 'id';
}