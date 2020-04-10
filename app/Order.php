<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['products_id','client_id','quantity','name'];
    public function product(){
        return $this->belongsTo(Product::class , 'products_id');
    }
    public function client (){
        return $this->belongsTo(Client::class);
    }
}
