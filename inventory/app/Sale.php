<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{   
    use SoftDeletes;
    protected $guarded = [''];
    
    public function stock() {
        return $this->belongsTo(Stock::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
