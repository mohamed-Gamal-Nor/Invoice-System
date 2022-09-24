<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_store extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products(){
        return $this->belongsTo('App\Models\product','product');
    }
    public function sizes(){
        return $this->belongsTo('App\Models\sizes','size');
    }
    public function colors(){
        return $this->belongsTo('App\Models\colors','color');
    }
    public function stores(){
        return $this->belongsTo('App\Models\storge','store');
    }

}
