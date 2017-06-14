<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->hasMany('APP\Models\Product', 'category_id');
    }
}
