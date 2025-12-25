<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('dashboard.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'تم إضافة القسم بنجاح');
    }

 public function update(Request $request)
    {
        // تحقق أولاً من الـ ID
        if (!$request->id) {
            return redirect()->back()->with('error', 'لم يتم تحديد القسم للتعديل');
        }

        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $category = Category::findOrFail($request->id);

            $data = [
                'name' => $request->name,
                'description' => $request->description,
            ];

            // التعامل مع الصورة
            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
                
                $imagePath = $request->file('image')->store('categories', 'public');
                $data['image'] = $imagePath;
            }

            $category->update($data);

            return redirect()->back()->with('success', 'تم تحديث القسم بنجاح');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id'
        ]);

        $category = Category::findOrFail($request->id);

        // حذف الصورة إذا كانت موجودة
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->back()->with('success', 'تم حذف القسم بنجاح');
    }

    public function deleteImage(Request $request)
{
    $request->validate([
        'id' => 'required|exists:categories,id'
    ]);

    try {
        $category = Category::findOrFail($request->id);
        
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
            $category->image = null;
            $category->save();
        }

        return response()->json(['success' => true, 'message' => 'تم حذف الصورة بنجاح']);
        
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'حدث خطأ: ' . $e->getMessage()]);
    }
}
}