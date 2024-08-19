<?php

namespace App\Models\Backend;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReview extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function statusLabel()
    {
        switch ($this->status) {
            case 1: $result = ' <span class="badge badge-sm bg-success   fw-bold fs-15px">'.trans('categories.active').'</span>'; break;
            case 0: $result = ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('categories.inactive').'</span>'; break;
        }
        return $result;
    }

    public function createdSince()
    {

        $result = Carbon::create($this->created_at)->diffForHumans();
        return $result;
    }

    public function createdAt()
    {
        $result = date('Y-m-d H:i:s',strtotime($this->created_at));
        return $result;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }



}
