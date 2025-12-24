<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // بيانات البائع الأساسية
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'aboute' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'location' => 'nullable|string',
            'color1' => 'nullable|string|max:7',
            'color2' => 'nullable|string|max:7',
            'color3' => 'nullable|string|max:7',
            
            // صور البائع
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'aboute_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            // الخدمات (مصفوفة)
            'services' => 'nullable|array',
            'services.*.name' => 'required|string|max:255',
            'services.*.description' => 'nullable|string',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'services.*.logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            // الأقسام داخل الخدمات (مصفوفة متداخلة)
            'services.*.sections' => 'nullable|array',
            'services.*.sections.*.name' => 'required|string|max:255',
            'services.*.sections.*.description' => 'nullable|string',
            'services.*.sections.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'services.*.sections.*.media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,pdf,doc,docx|max:5120',
            
            // شرائح العرض (مصفوفة)
            'slides' => 'required|array|min:1',
            'slides.*.name' => 'required|string|max:255',
            'slides.*.description' => 'nullable|string',
            'slides.*.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * رسائل التحقق المخصصة
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم البائع مطلوب',
            'category_id.required' => 'فئة البائع مطلوبة',
            'phone1.required' => 'رقم الهاتف الرئيسي مطلوب',
            'slides.required' => 'يجب إضافة شريحة عرض واحدة على الأقل',
            'slides.*.name.required' => 'اسم الشريحة مطلوب',
            'slides.*.image.required' => 'صورة الشريحة مطلوبة',
            'services.*.name.required' => 'اسم الخدمة مطلوب',
            'services.*.sections.*.name.required' => 'اسم القسم مطلوب',
        ];
    }
}