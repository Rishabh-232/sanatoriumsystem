<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRowItem extends Model
{
    public $timestamps = false;
    protected $table = 'quotesrowitem';
    protected $primaryKey = 'id';
}