<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'delivery';
    protected $fillable = ['waybill'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id');
    }
}