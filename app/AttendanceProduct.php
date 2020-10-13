<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceProduct extends Model
{
    protected $table = 'attendances_products';
    protected $fillable = ['attendance_id', 'product_id', 'quantity_product'];
    public $timestamps = false;
}
