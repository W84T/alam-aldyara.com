<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'description', 'images', 'is_active'];
    public array $translatable = ['title', 'description', 'images'];

    protected static function booted(): void{

        self::deleted(function (Banner $banner) {
            Storage::disk('public')->delete($banner->images);
        });

        self::updating(function (Banner $banner) {
            if ($banner->isDirty('images')) {
                $originalImage = $banner->getOriginal('images');
                if ($originalImage) {
                    Storage::disk('public')->delete($originalImage);
                }
            }
        });
    }
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'images' => 'array',
    ];
}
