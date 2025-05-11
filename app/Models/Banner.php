<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'description', 'hero_image', 'image', 'is_active'];
    public array $translatable = ['title', 'description'];

    protected static function booted(): void{

        self::deleted(function (Banner $banner) {
            Storage::disk('public')->delete($banner->image);
            Storage::disk('public')->delete($banner->hero_image);

        });

        self::updating(function (Banner $banner) {
            if ($banner->isDirty('hero_image')) {
                $originalHeroImage = $banner->getOriginal('hero_images');
                if ($originalHeroImage) {
                    Storage::disk('public')->delete($originalHeroImage);
                }
            }

            if ($banner->isDirty('image')) {
                $originalImage = $banner->getOriginal('image');
                if ($originalImage) {
                    Storage::disk('public')->delete($originalImage);
                }
            }

        });
    }
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];
}
