<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class ShippingCompany extends Model
{
    use HasFactory, SearchableTrait;
    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'shipping_companies.name'       => 10,
            'shipping_companies.code'       => 10,
            'shipping_companies.description'=> 10,
        ]
    ];

    public function statusLabel()
    {
        switch ($this->status) {
            case 1: $result = ' <span class="badge badge-sm bg-success   fw-bold fs-15px">'.trans('products.active').'</span>'; break;
            case 0: $result = ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('products.inactive').'</span>'; break;
        }
        return $result;
    }


    public function fast(): string
    {


        return $this->fast ? ' <span class="badge badge-sm bg-success fw-bold fs-15px">'.trans('shipping.fast delivery').'</span>'
            : ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('shipping.normal delivery').'</span>';
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'shipping_company_country');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


}



