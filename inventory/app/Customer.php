<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{   
    use SoftDeletes;
    protected $guarded = [''];

    public function sales() {
        return $this->hasMany(Sale::class);
    }
}
