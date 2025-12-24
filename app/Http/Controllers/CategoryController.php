<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * عرض جميع الفئات
     */
    public function index()
    {
        $categories = Category::ordered()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * عرض نموذج إنشاء فئة
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * حفظ فئة جديدة
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        DB::beginTransaction();

        try {
            $categoryData = $request->only(['name', 'description', 'icon', 'color', 'order', 'is_active']);

            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('categories'), $fileName);
                $categoryData['image'] = 'categories/' . $fileName;
            }

            $category = Category::create($categoryData);

            DB::commit();

            return redirect()->route('categories.index')
                ->with('success', 'تم إنشاء الفئة بنجاح');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    /**
     * عرض نموذج تعديل فئة
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * تحديث فئة
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        DB::beginTransaction();

        try {
            $category = Category::findOrFail($id);
            $categoryData = $request->only(['name', 'description', 'icon', 'color', 'order', 'is_active']);

            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إذا وجدت
                if ($category->image && file_exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                }

                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('categories'), $fileName);
                $categoryData['image'] = 'categories/' . $fileName;
            }

            $category->update($categoryData);

            DB::commit();

            return redirect()->route('categories.index')
                ->with('success', 'تم تحديث الفئة بنجاح');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    /**
     * حذف فئة
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($id);

            // حذف الصورة إذا وجدت
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')
                ->with('success', 'تم حذف الفئة بنجاح');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    /**
     * الحصول على الفئات كـ JSON (لـ AJAX)
     */
    public function getCategories()
    {
        $categories = Category::active()->ordered()->get();
        return response()->json($categories);
    }
}