<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shippingAreaRelarion extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function areaName(){
        return $this->belongsTo('App\Models\shippingArea','area');
    }
}