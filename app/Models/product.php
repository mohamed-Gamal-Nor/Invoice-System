<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Productsection(){
        return $this->belongsTo('App\Models\ProductSection','section');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','created_by');
    }
}