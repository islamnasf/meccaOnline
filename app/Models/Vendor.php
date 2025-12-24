<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'logo',
        'phone1',
        'phone2',
        'email',
        'aboute',
        'aboute_image',
        'address',
        'Latitude', // تغيير من location
        'Longitude', // تغيير من location
        'color1',
        'color2',
        'color3',
        'category_id'
    ];

    /**
     * علاقة البائع بالخدمات
     */
    public function services(): HasMany
    {
        return $this->hasMany(VendorService::class);
    }

    /**
     * علاقة البائع بشرائح العرض
     */
    public function slides(): HasMany
    {
        return $this->hasMany(VendorSlide::class);
    }

    /**
     * علاقة البائع بالفئة
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * دالة للحصول على جميع الأقسام من خلال الخدمات
     */
    public function allSections()
    {
        return $this->hasManyThrough(
            Section::class,
            VendorService::class,
            'vendor_id', // Foreign key on VendorService table
            'service_id', // Foreign key on Section table
            'id', // Local key on Vendor table
            'id' // Local key on VendorService table
        );
    }

    /**
     * دالة للحصول على جميع الوسائط من خلال الأقسام
     */
    public function allMedia()
    {
        return $this->hasManyThrough(
            SectionMedia::class,
            Section::class,
            'service_id', // Foreign key on Section table
            'section_id', // Foreign key on SectionMedia table
            'id', // Local key on Vendor table
            'id' // Local key on VendorService table
        )->through('services.sections');
    }

    /**
     * Accessor للحصول على الموقع كـ array
     */
    public function getLocationAttribute()
    {
        return [
            'latitude' => $this->Latitude,
            'longitude' => $this->Longitude
        ];
    }

    /**
     * Scope للبحث عن البائعين
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone1', 'like', "%{$search}%")
                    ->orWhereHas('category', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
    }

    /**
     * Scope للتصفية حسب الفئة
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}