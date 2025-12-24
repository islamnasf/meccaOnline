<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'section_id'
    ];

    /**
     * علاقة الوسائط بالقسم
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Accessor للحصول على URL الملف
     */
    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return asset($this->file);
        }
        return null;
    }

    /**
     * Accessor للحصول على نوع الملف
     */
    public function getFileTypeAttribute()
    {
        if (!$this->file) return null;
        
        $extension = pathinfo($this->file, PATHINFO_EXTENSION);
        
        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $videoTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv'];
        $audioTypes = ['mp3', 'wav', 'ogg', 'm4a'];
        $documentTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
        
        if (in_array(strtolower($extension), $imageTypes)) {
            return 'image';
        } elseif (in_array(strtolower($extension), $videoTypes)) {
            return 'video';
        } elseif (in_array(strtolower($extension), $audioTypes)) {
            return 'audio';
        } elseif (in_array(strtolower($extension), $documentTypes)) {
            return 'document';
        } else {
            return 'other';
        }
    }

    /**
     * Accessor للحصول على أيقونة حسب نوع الملف
     */
    public function getFileIconAttribute()
    {
        switch ($this->file_type) {
            case 'image':
                return 'fa-image';
            case 'video':
                return 'fa-video';
            case 'audio':
                return 'fa-music';
            case 'document':
                if (str_contains($this->file, '.pdf')) {
                    return 'fa-file-pdf';
                } elseif (str_contains($this->file, '.doc')) {
                    return 'fa-file-word';
                } elseif (str_contains($this->file, '.xls')) {
                    return 'fa-file-excel';
                } elseif (str_contains($this->file, '.ppt')) {
                    return 'fa-file-powerpoint';
                }
                return 'fa-file';
            default:
                return 'fa-file';
        }
    }

    /**
     * Accessor للحصول على اسم الملف فقط
     */
    public function getFileNameAttribute()
    {
        if ($this->file) {
            return basename($this->file);
        }
        return null;
    }

    /**
     * Scope للتصفية حسب نوع الملف
     */
    public function scopeByFileType($query, $type)
    {
        return $query->where('file', 'like', "%.{$type}");
    }

    /**
     * Scope للتصفية حسب القسم
     */
    public function scopeBySection($query, $sectionId)
    {
        return $query->where('section_id', $sectionId);
    }
}