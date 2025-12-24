<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorService;
use App\Models\Section;
use App\Models\VendorSlide;
use App\Models\SectionMedia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * عرض قائمة البائعين
     */
    public function index()
    {
        $categories = Category::all();
        $vendors = Vendor::with(['services', 'slides'])->get();
        return view('vendors.index', compact('categories', 'vendors'));
    }
    
    /**
     * عرض نموذج إنشاء بائع جديد
     */
    public function create()
    {
        $categories = Category::all();
        return view('vendors.create', compact('categories'));
    }

    /**
     * عرض نموذج تعديل بائع موجود
     */
    public function edit($id)
    {
        $vendor = Vendor::with(['services.sections.media', 'slides', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('vendors.edit', compact('vendor', 'categories'));
    }

    /**
     * حفظ بيانات البائع الجديد
     */
    public function store(Request $request)
    {
        return $this->saveVendorData($request);
    }

    /**
     * تحديث بيانات البائع الموجود
     */
    public function update(Request $request, $id)
    {
        return $this->saveVendorData($request, $id);
    }

    /**
     * دالة مشتركة للحفظ والتحديث
     */
    private function saveVendorData(Request $request, $vendorId = null)
    {
        // التحقق من صحة البيانات الأساسية
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'color1' => 'nullable|string|max:7',
            'color2' => 'nullable|string|max:7',
            'color3' => 'nullable|string|max:7',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        
        try {
            // بيانات البائع الأساسية
            $vendorData = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'aboute' => $request->input('aboute'),
                'phone1' => $request->input('phone1'),
                'phone2' => $request->input('phone2'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'Latitude' => $request->input('latitude'),
                'Longitude' => $request->input('longitude'),
                'color1' => $request->input('color1'),
                'color2' => $request->input('color2'),
                'color3' => $request->input('color3'),
                'category_id' => $request->input('category_id'),
            ];

            // حفظ أو تحديث البائع
            if ($vendorId) {
                $vendor = Vendor::findOrFail($vendorId);
                $vendor->update($vendorData);
            } else {
                $vendor = Vendor::create($vendorData);
            }

            // رفع صورة البائع
            if ($request->hasFile('image')) {
                $this->uploadImage($request->file('image'), $vendor, 'image');
            } elseif ($request->has('delete_image')) {
                $this->deleteImage($vendor->image);
                $vendor->update(['image' => null]);
            }

            // رفع شعار البائع
            if ($request->hasFile('logo')) {
                $this->uploadImage($request->file('logo'), $vendor, 'logo');
            } elseif ($request->has('delete_logo')) {
                $this->deleteImage($vendor->logo);
                $vendor->update(['logo' => null]);
            }

            // رفع صورة الـ about
            if ($request->hasFile('about_image')) {
                $this->uploadImage($request->file('about_image'), $vendor, 'aboute_image');
            } elseif ($request->has('delete_about_image')) {
                $this->deleteImage($vendor->aboute_image);
                $vendor->update(['aboute_image' => null]);
            }

            // معالجة الخدمات المحذوفة
            if ($request->has('deleted_services') && !empty($request->input('deleted_services'))) {
                $deletedServices = json_decode($request->input('deleted_services'), true);
                if (is_array($deletedServices)) {
                    VendorService::where('vendor_id', $vendor->id)
                        ->whereIn('id', $deletedServices)
                        ->delete();
                }
            }

            // حفظ الخدمات
            if ($request->has('services')) {
                $this->saveServices($request, $vendor);
            }

            // معالجة الشرائح المحذوفة
            if ($request->has('deleted_slides') && !empty($request->input('deleted_slides'))) {
                $deletedSlides = json_decode($request->input('deleted_slides'), true);
                if (is_array($deletedSlides)) {
                    VendorSlide::where('vendor_id', $vendor->id)
                        ->whereIn('id', $deletedSlides)
                        ->delete();
                }
            }

            // حفظ الشرائح
            if ($request->has('slides')) {
                $this->saveSlides($request, $vendor);
            }

            DB::commit();

            return redirect()->route('vendors.index')->with('success', 
                $vendorId ? 'تم تحديث بيانات البائع بنجاح' : 'تم إضافة البائع بنجاح'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error saving vendor: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * رفع صورة وحفظها
     */
    private function uploadImage($file, $model, $field)
    {
        $path = $file->store('vendors/' . $model->id, 'public');
        $model->update([$field => $path]);
    }

    /**
     * حذف صورة
     */
    private function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * حفظ الخدمات والأقسام والوسائط
     */
    private function saveServices(Request $request, Vendor $vendor)
    {
        $services = $request->input('services', []);
        
        foreach ($services as $serviceIndex => $serviceData) {
            // بيانات الخدمة
            $serviceInfo = [
                'name' => $serviceData['name'] ?? '',
                'description' => $serviceData['description'] ?? null,
                'vendor_id' => $vendor->id,
            ];

            // تحديد إذا كانت خدمة موجودة أو جديدة
            if (isset($serviceData['id']) && !empty($serviceData['id'])) {
                $service = VendorService::where('id', $serviceData['id'])
                    ->where('vendor_id', $vendor->id)
                    ->first();
                
                if ($service) {
                    $service->update($serviceInfo);
                } else {
                    $service = VendorService::create($serviceInfo);
                }
            } else {
                $service = VendorService::create($serviceInfo);
            }

            // رفع صورة الخدمة
            if ($request->hasFile("services.{$serviceIndex}.image")) {
                $this->uploadServiceImage($request->file("services.{$serviceIndex}.image"), $service);
            } elseif (isset($serviceData['delete_image'])) {
                $this->deleteImage($service->image);
                $service->update(['image' => null]);
            }

            // رفع شعار الخدمة
            if ($request->hasFile("services.{$serviceIndex}.logo")) {
                $this->uploadServiceLogo($request->file("services.{$serviceIndex}.logo"), $service);
            } elseif (isset($serviceData['delete_logo'])) {
                $this->deleteImage($service->logo);
                $service->update(['logo' => null]);
            }

            // معالجة الأقسام المحذوفة
            if ($request->has('deleted_sections') && !empty($request->input('deleted_sections'))) {
                $deletedSections = json_decode($request->input('deleted_sections'), true);
                if (is_array($deletedSections)) {
                    Section::where('service_id', $service->id)
                        ->whereIn('id', $deletedSections)
                        ->delete();
                }
            }

            // حفظ أقسام الخدمة
            if (isset($serviceData['sections'])) {
                $this->saveSections($request, $service, $serviceIndex);
            }

            // معالجة الوسائط المحذوفة
            if ($request->has('deleted_media') && !empty($request->input('deleted_media'))) {
                $deletedMedia = json_decode($request->input('deleted_media'), true);
                if (is_array($deletedMedia)) {
                    SectionMedia::whereIn('id', $deletedMedia)->delete();
                }
            }
        }
    }

    /**
     * رفع صورة الخدمة
     */
    private function uploadServiceImage($file, VendorService $service)
    {
        $path = $file->store('vendors/' . $service->vendor_id . '/services', 'public');
        $service->update(['image' => $path]);
    }

    /**
     * رفع شعار الخدمة
     */
    private function uploadServiceLogo($file, VendorService $service)
    {
        $path = $file->store('vendors/' . $service->vendor_id . '/services/logos', 'public');
        $service->update(['logo' => $path]);
    }

    /**
     * حفظ أقسام الخدمة
     */
    private function saveSections(Request $request, VendorService $service, $serviceIndex)
    {
        $sections = $request->input("services.{$serviceIndex}.sections", []);
        
        foreach ($sections as $sectionIndex => $sectionData) {
            // بيانات القسم
            $sectionInfo = [
                'name' => $sectionData['name'] ?? '',
                'description' => $sectionData['description'] ?? null,
                'service_id' => $service->id,
            ];

            // تحديد إذا كان قسم موجود أو جديد
            if (isset($sectionData['id']) && !empty($sectionData['id'])) {
                $section = Section::where('id', $sectionData['id'])
                    ->where('service_id', $service->id)
                    ->first();
                
                if ($section) {
                    $section->update($sectionInfo);
                } else {
                    $section = Section::create($sectionInfo);
                }
            } else {
                $section = Section::create($sectionInfo);
            }

            // رفع صورة القسم
            if ($request->hasFile("services.{$serviceIndex}.sections.{$sectionIndex}.image")) {
                $this->uploadSectionImage(
                    $request->file("services.{$serviceIndex}.sections.{$sectionIndex}.image"), 
                    $section, 
                    $service
                );
            } elseif (isset($sectionData['delete_image'])) {
                $this->deleteImage($section->image);
                $section->update(['image' => null]);
            }

            // حفظ الوسائط الجديدة
            if ($request->hasFile("services.{$serviceIndex}.sections.{$sectionIndex}.media")) {
                $this->saveSectionMedia(
                    $request->file("services.{$serviceIndex}.sections.{$sectionIndex}.media"), 
                    $section
                );
            }

            // الاحتفاظ بالوسائط الحالية
            if (isset($sectionData['existing_media'])) {
                $this->keepExistingMedia($sectionData['existing_media'], $section);
            }
        }
    }

    /**
     * رفع صورة القسم
     */
    private function uploadSectionImage($file, Section $section, VendorService $service)
    {
        $path = $file->store(
            'vendors/' . $service->vendor_id . '/services/' . $service->id . '/sections', 
            'public'
        );
        $section->update(['image' => $path]);
    }

    /**
     * حفظ وسائط القسم
     */
    private function saveSectionMedia($files, Section $section)
    {
        if (!is_array($files)) {
            $files = [$files];
        }
        
        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $path = $file->store(
                    'vendors/sections/' . $section->id . '/media', 
                    'public'
                );
                
                SectionMedia::create([
                    'file' => $path,
                    'section_id' => $section->id,
                ]);
            }
        }
    }

    /**
     * الاحتفاظ بالوسائط الحالية
     */
    private function keepExistingMedia($existingMediaIds, Section $section)
    {
        // حذف الوسائط التي لم يتم تضمينها في القائمة
        SectionMedia::where('section_id', $section->id)
            ->whereNotIn('id', $existingMediaIds)
            ->delete();
    }

    /**
     * حفظ شرائح العرض
     */
    private function saveSlides(Request $request, Vendor $vendor)
    {
        $slides = $request->input('slides', []);
        
        foreach ($slides as $slideIndex => $slideData) {
            // بيانات الشريحة
            $slideInfo = [
                'name' => $slideData['name'] ?? '',
                'description' => $slideData['description'] ?? null,
                'vendor_id' => $vendor->id,
            ];

            // تحديد إذا كانت شريحة موجودة أو جديدة
            if (isset($slideData['id']) && !empty($slideData['id'])) {
                $slide = VendorSlide::where('id', $slideData['id'])
                    ->where('vendor_id', $vendor->id)
                    ->first();
                
                if ($slide) {
                    $slide->update($slideInfo);
                } else {
                    $slide = VendorSlide::create($slideInfo);
                }
            } else {
                $slide = VendorSlide::create($slideInfo);
            }

            // رفع صورة الشريحة
            if ($request->hasFile("slides.{$slideIndex}.image")) {
                $this->uploadSlideImage($request->file("slides.{$slideIndex}.image"), $slide, $vendor);
            } elseif (isset($slideData['delete_image'])) {
                $this->deleteImage($slide->image);
                $slide->update(['image' => null]);
            }
        }
    }

    /**
     * رفع صورة الشريحة
     */
    private function uploadSlideImage($file, VendorSlide $slide, Vendor $vendor)
    {
        $path = $file->store('vendors/' . $vendor->id . '/slides', 'public');
        $slide->update(['image' => $path]);
    }

    /**
     * عرض بيانات بائع
     */
    public function show($id)
    {
        $vendor = Vendor::with(['services.sections.media', 'slides', 'category'])->findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }

    /**
     * حذف بائع
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        try {
            $vendor = Vendor::findOrFail($id);
            
            // حذف جميع الملفات المرتبطة
            $this->deleteVendorFiles($vendor);
            
            $vendor->delete();
            
            DB::commit();
            
            return redirect()->route('vendors.index')->with('success', 'تم حذف البائع بنجاح');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error deleting vendor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
        }
    }

    /**
     * حذف ملفات البائع
     */
    private function deleteVendorFiles(Vendor $vendor)
    {
        // حذف ملفات البائع
        $files = [
            $vendor->image,
            $vendor->logo,
            $vendor->aboute_image
        ];
        
        foreach ($files as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }
        
        // حذف ملفات الخدمات
        foreach ($vendor->services as $service) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            if ($service->logo && Storage::disk('public')->exists($service->logo)) {
                Storage::disk('public')->delete($service->logo);
            }
            
            // حذف ملفات الأقسام
            foreach ($service->sections as $section) {
                if ($section->image && Storage::disk('public')->exists($section->image)) {
                    Storage::disk('public')->delete($section->image);
                }
                
                // حذف وسائط الأقسام
                foreach ($section->media as $media) {
                    if ($media->file && Storage::disk('public')->exists($media->file)) {
                        Storage::disk('public')->delete($media->file);
                    }
                }
            }
        }
        
        // حذف ملفات الشرائح
        foreach ($vendor->slides as $slide) {
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }
        }
    }
}