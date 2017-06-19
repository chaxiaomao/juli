<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function content()
    {
        return $this->hasOne('App\Models\PdtContent', 'product_id');
    }
}
