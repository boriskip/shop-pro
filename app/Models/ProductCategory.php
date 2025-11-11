<?php

namespace App\Models;

use App\Traits\IsTenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;
    use IsTenantModel;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_category_id',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_category_id');
    }

    public function getSlugAttribute()
    {
        if (isset($this->attributes['slug']) && !empty($this->attributes['slug'])) {
            return $this->attributes['slug'];
        }
        return Str::slug($this->name);
    }

    public function getImageUrlAttribute()
    {
        $image = $this->image;

        // Если изображение - полный URL, вернуть его
        if (!empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // Если изображение - путь в хранилище или локальный путь
        if (!empty($image)) {
            // Попробуем проверить, существует ли файл в storage
            if (str_starts_with($image, 'storage/') || str_starts_with($image, 'public/')) {
                $path = str_replace('storage/', 'public/', $image);
                if (Storage::exists($path)) {
                    return Storage::url($path);
                }
                // Если не нашли в storage, попробуем как asset
                return asset('storage/' . str_replace('public/', '', $image));
            }
            // Если это просто путь, вернем как asset
            return asset('storage/' . $image);
        }

        // Если изображения нет, вернем null (будет использован fallback в view)
        return null;
    }
}
