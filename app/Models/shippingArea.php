<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shippingArea extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user(){
        return $this->belongsTo('App\Models\User','created_by');
    }
}
