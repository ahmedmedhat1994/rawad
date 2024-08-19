<?php

namespace App\Models\Backend;

use App\Helper\MySlugHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Tags extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations, HasTranslatableSlug;
    public $translatable = ['name'];

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


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




    public function products(): morphToMany
    {
        return $this->morphedByMany(Product::class,'taggable');
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
