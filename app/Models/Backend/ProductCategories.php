<?php

namespace App\Models\Backend;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ProductCategories extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations, HasTranslatableSlug;
    public $translatable = ['name'];


    protected $fillable = [
        'name',
        'slug',
        'cover',
        'status',
        'parent_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];




    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('status')
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






    public function parent()
    {
        return $this->hasOne(ProductCategories::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategories::class, 'parent_id', 'id');
    }
    public function appearedChildren()
    {
        return $this->hasMany(ProductCategories::class, 'parent_id', 'id')->where('status',true);
    }

    public static function tree( $level = 1 )
    {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereNull('parent_id')
            ->whereStatus(true)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class,'product_category_id');
    }

    public function statusLabel()
    {
        switch ($this->status) {
            case 1: $result = ' <span class="badge badge-sm bg-success   fw-bold fs-15px">'.trans('categories.active').'</span>'; break;
            case 0: $result = ' <span class="badge badge-sm bg-danger  fw-bold fs-15px">'.trans('categories.inactive').'</span>'; break;
        }
        return $result;
    }

    public function createdAt()
    {
        $result = date('Y-m-d H:i:s',strtotime($this->created_at));
        return $result;
    }


}
