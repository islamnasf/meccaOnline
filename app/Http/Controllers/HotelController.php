<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelDetail;
use App\Models\ItemType;
use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // عرض جميع الفنادق
    public function index()
    {
        $hotels = Hotel::with('users')->latest()->get();
$users = User::all();
return view('dashboard.hotel', compact('hotels','users'));

    }

    // إضافة فندق جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Hotel::create([
            'name' => $request->name,
        ]);

        ToastMagic::success('تم إضافة الفندق بنجاح ✅');

        return redirect()->back();
    }

    // تعديل فندق موجود
    public function update(Request $request)
    {
        $request->validate([
            'id'   => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
        ]);

        $hotel = Hotel::findOrFail($request->id);
        $hotel->update([
            'name' => $request->name,
        ]);

        ToastMagic::success('تم تحديث الفندق بنجاح ✏️');

        return redirect()->back();
    }

    // حذف فندق
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:hotels,id',
        ]);

        Hotel::findOrFail($request->id)->delete();
        ToastMagic::success('تم حذف الفندق بنجاح 🗑️');
        return redirect()->back();
    }
    public function assignUsers(Request $request)
{
    $request->validate([
        'hotel_id' => 'required|exists:hotels,id',
        'user_ids' => 'array',
        'user_ids.*' => 'exists:users,id',
    ]);

    $hotel = Hotel::findOrFail($request->hotel_id);

    $hotel->users()->sync($request->user_ids ?? []);

    ToastMagic::success('تم تحديث مستخدمي الفندق بنجاح ✅');

    return redirect()->back();
}


 

public function indexDetails($hotelId)
{
    // البحث عن الفندق باستخدام ID
    $hotel = Hotel::findOrFail($hotelId);
    
    // جلب تفاصيل الفندق المحدد فقط (ليس كل التفاصيل)
    $details = HotelDetail::with(['hotel', 'itemType'])
                          ->where('hotel_id', $hotelId)
                          ->get();
    
    $itemTypes = ItemType::all();
    
    return view('dashboard.hotelDetails', compact('hotel', 'itemTypes', 'details'));
}

    public function storeDetail(Request $request )
    {
        $request->validate([
            'hotel_id' => 'required',
            'item_type_id' => 'required',
            'count' => 'nullable|integer',
        ]);

        HotelDetail::create($request->all());
                ToastMagic::success('تم إضافة التفاصيل بنجاح ✅');

        return redirect()->back();
    }

    public function updateDetail(Request $request)
    {
        $detail = HotelDetail::findOrFail($request->id);
        $detail->update($request->all());
                ToastMagic::success('تم تحديث التفاصيل بنجاح ✏️');

        return redirect()->back();
    }

    public function destroyDetail(Request $request)
    {
        HotelDetail::findOrFail($request->id)->delete();
                ToastMagic::success('تم حذف التفاصيل بنجاح 🗑️');

        return redirect()->back();
    }

    // إدارة أنواع العناصر
    public function storeItemType(Request $request)
    {
        $request->validate(['name' => 'required|unique:item_types,name']);
        ItemType::create(['name' => $request->name]);
                ToastMagic::success('تم إضافة نوع العنصر بنجاح ✅');

        return redirect()->back();
    }

    public function destroyItemType(Request $request)
    {
        ItemType::findOrFail($request->id)->delete();
                ToastMagic::success('تم حذف نوع العنصر بنجاح 🗑️');

        return redirect()->back();
    }

}
