<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    Use SoftDeletes;
    protected $guarded = [''];
    
}
