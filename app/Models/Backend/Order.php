<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];


    const NEW_ORDER = 0;
    const PAYMENT_COMPLETED = 1;
    const UNDER_PROCESS = 2;
    const FINISHED = 3;
    const REJECTED = 4;
    const CANCELED = 5;
    const REFUNDED_REQUEST = 6;
    const RETURNED = 7;
    const REFUNDED = 8;

    public function currency(): string
    {
        return $this->currency == 'USD' ? '$' : $this->currency;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user_address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_products')->withPivot('quantity');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shipping_company(): BelongsTo
    {
        return $this->belongsTo(ShippingCompany::class);
    }

    public function status($transaction_number = null)
    {
        $transaction = $transaction_number != '' ? $transaction_number : $this->order_status;

        switch ($transaction) {
            case 0: $result = 'New order'; break;
            case 1: $result = 'Paid'; break;
            case 2: $result = 'Under process'; break;
            case 3: $result = 'Finished'; break;
            case 4: $result = 'Rejected'; break;
            case 5: $result = 'Canceled'; break;
            case 6: $result = 'Refund requested'; break;
            case 7: $result = 'Refunded'; break;
            case 8: $result = 'Returned order'; break;
        }
        return $result;
    }

    public function statusWithLabel()
    {
        switch ($this->order_status) {
            case 0: $result = '<span class="badge badge-dot  bg-success">New order</span>'; break;
            case 1: $result = '<span class="badge badge-dot bg-warning">Paid</span>'; break;
            case 2: $result = '<span class="badge badge-dot bg-warning">Under process</span>'; break;
            case 3: $result = '<span class="badge badge-dot bg-primary">Finished</span>'; break;
            case 4: $result = '<span class="badge badge-dot bg-danger">Rejected</span>'; break;
            case 5: $result = '<span class="badge badge-dot bg-dark text-white">Canceled</span>'; break;
            case 6: $result = '<span class="badge badge-dot bg-dark text-white">Refund requested</span>'; break;
            case 7: $result = '<span class="badge badge-dot bg-slate">Returned order</span>'; break;
            case 8: $result = '<span class="badge badge-dot bg-dark text-white">Refunded order</span>'; break;
        }
        return $result;
    }
}
