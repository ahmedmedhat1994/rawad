<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function statusLabel()
    {
        switch ($this->status) {
            case 1: $result = ' <span class="badge badge-sm bg-success   fw-bold fs-15px">'.trans('categories.active').'</span>'; break;
            case 0: $result = ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('categories.inactive').'</span>'; break;
        }
        return $result;
    }

    public function sandbox()
    {
        return $this->sandbox ? 'Sandbox' : 'Live';
    }

//    public function orders(): HasMany
//    {
//        return $this->hasMany(Order::class);
//    }

}
