<?php

namespace App\Models\Backend;

use App\Helper\MySlugHelper;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Products extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations, HasTranslatableSlug;
    public $translatable = ['name'];

    protected $guarded = [];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */



//    protected function generateNonUniqueSlug(): string
//    {
//        $today = date('Ymd');
//        $productsNumber = Products::where('slug','like', $today.'%')->pluck('slug');
//        do{
//            $productNumber = $today . rand(100000,999999);
//        }while ($productsNumber->contains($productNumber));
//
//        return $productNumber;
//    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('price')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();

    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }





    public function statusLabel()
    {
        switch ($this->status) {
            case 1: $result = ' <span class="badge badge-sm bg-success   fw-bold fs-15px">'.trans('products.active').'</span>'; break;
            case 0: $result = ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('products.inactive').'</span>'; break;
        }
        return $result;
    }

    public function createdAt()
    {
        $result = date('Y-m-d H:i:s',strtotime($this->created_at));
        return $result;
    }

    public function createdSince()
    {

        $result = Carbon::create($this->created_at)->diffForHumans();
        return $result;
    }

    public function featured(){

        switch ($this->featured) {
            case 1: $result = ' <span class="badge badge-sm bg-success   fw-bold fs-15px">'.trans('products.yes').'</span>'; break;
            case 0: $result = ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('products.no').'</span>'; break;
        }
        return $result;
    }

    public function scopeFeatured($query)
    {
        return $query->whereFeatured(true);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function scopeHasQuantity($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeActiveCategory($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
    }


    public function category()
    {
        return $this->belongsTo(ProductCategories::class,'product_category_id','id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tags::class,'taggable');
    }
    public function firstMedia(): HasOne
    {
        return $this->hasOne(Media::class,'attachable_id')->orderBy('id','asc');
    }


    public function attachments(): HasMany
    {
        return $this->hasMany(Media::class,'attachable_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class,'product_id');
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColors::class,'product_id');
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSizes::class,'product_id');
    }


//    public function orders(): BelongsToMany
//    {
//        return $this->belongsToMany(Order::class)->withPivot('quantity');
//    }

}
