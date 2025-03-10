<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['name', 'parent_id', 'slug', 'image', 'is_active'];

    public array $translatable = ['name'];

    protected $casts = ['name' => 'array'];

    protected static function booted(): void{

        self::deleted(function (Category $category) {
            Storage::disk('public')->delete($category->image);
        });

        self::updating(function (Category $category) {
            if ($category->isDirty('image')) {
                $originalImage = $category->getOriginal('image');
                if ($originalImage) {
                    Storage::disk('public')->delete($originalImage);
                }
            }
            if($category->isDirty('is_active')){
                Product::where('category_id', $category->id)->update(['is_active' => $category->is_active]);
            }
        });
    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'discount_categories');
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function getActiveDiscountAttribute()
    {
        return $this->discounts()->where('is_active', true)->first();
    }
}
