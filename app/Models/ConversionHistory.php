<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversionHistory extends Model
{
    protected $fillable = ['from_currency_id', 'to_currency_id', 'amount', 'converted_amount', 'conversion_date'];
}
