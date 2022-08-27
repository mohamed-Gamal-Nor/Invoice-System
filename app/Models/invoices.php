<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function userUpdate(){
        return $this->belongsTo('App\Models\User','last_update');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\supplier','supplier_id');
    }
    public function storage(){
        return $this->belongsTo('App\Models\storge','storage_id');
    }
}
