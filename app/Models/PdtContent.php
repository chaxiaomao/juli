<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdtContent extends Model
{
    protected $table = 'pdt_content';
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id');
    }
}
