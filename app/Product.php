<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['description'];
    protected $guarded = [];

    protected $fillable = ['name','description','purchase_price','sale_price','stock','category_id','image'];

    public function order(){
        return $this->belongsTo(Order::class , 'products_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getProfitPercent(){
        $profit = $this->sale_price - $this->purchase_price ;
        $profit_percent = $profit * 100 / $this->purchase_price ;
        return number_format($profit_percent,2) ;
    }
}
