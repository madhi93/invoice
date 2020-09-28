<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InvoiceList;

class Invoice extends Model
{
    public function invoicelist()
    {
        return $this->hasMany('App\InvoiceList');
    }
}
