<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoicesItems extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function productData(){
        return $this->belongsTo('App\Models\product','product');
    }
    public function sizeData(){
        return $this->belongsTo('App\Models\sizes','size');
    }
    public function colorData(){
        return $this->belongsTo('App\Models\colors','color');
    }
}
