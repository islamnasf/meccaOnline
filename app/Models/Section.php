<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'service_id'
    ];

    protected $casts = [
        'description' => 'string'
    ];

    /**
     * علاقة القسم بالخدمة
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(VendorService::class, 'service_id');
    }

    /**
     * علاقة القسم بالوسائط
     */
    public function media(): HasMany
    {
        return $this->hasMany(SectionMedia::class);
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
     * دالة للحصول على البائع من خلال الخدمة
     */
    public function getVendorAttribute()
    {
        return $this->service->vendor ?? null;
    }

    /**
     * Scope للبحث عن الأقسام
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    /**
     * Scope للتصفية حسب الخدمة
     */
    public function scopeByService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }

    /**
     * Scope للحصول على الأقسام مع العلاقات
     */
    public function scopeWithRelations($query)
    {
        return $query->with(['service', 'media']);
    }
}