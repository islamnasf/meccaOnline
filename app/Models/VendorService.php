<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'logo',
        'vendor_id'
    ];

    /**
     * علاقة الخدمة بالبائع
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * علاقة الخدمة بالأقسام
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'service_id');
    }

    /**
     * Accessor للحصول على URL الصورة
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset($this->image);
        }
        return null;
    }

    /**
     * Accessor للحصول على URL الشعار
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset($this->logo);
        }
        return null;
    }

    /**
     * دالة للحصول على جميع الوسائط من خلال الأقسام
     */
    public function allMedia()
    {
        return $this->hasManyThrough(
            SectionMedia::class,
            Section::class,
            'service_id',
            'section_id',
            'id',
            'id'
        );
    }

    /**
     * Scope للبحث عن الخدمات
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }
}