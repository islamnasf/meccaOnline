<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Order;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $orders = Order::when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
        })

            // لو role = 1 (يشوف موافق + مرفوض + قيد التنفيذ)
            ->when($user->role == 1, function ($q) {
                $q->whereIn('status', ['approved', 'rejected', 'processing']);
            })

            // لو role = 2 (يشوف طلبات فنادقه فقط)
            ->when($user->role == 2, function ($q) use ($user) {
                $q->whereIn('hotel_id', $user->hotels->pluck('id'));
            })

            ->with('user')
            ->get();

        $stats = Order::when($user->role == 1, function ($q) {
            $q->whereIn('status', ['approved', 'rejected', 'processing']);
        })
            ->when($user->role == 2, function ($q) use ($user) {
                $q->whereIn('hotel_id', $user->hotels->pluck('id'));
            })
            ->selectRaw('status, COUNT(*) as total_orders, SUM(price) as total_price')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $hotels = $user->hotels;
        $allhotels = Hotel::all();

        return view('dashboard.orders', compact('orders', 'stats', 'hotels' ,'allhotels'));
    }



    public function store(Request $request)
    {
        $path = null;

        if ($request->hasFile('file')) { // لازم الاسم يطابق input في الفورم
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // لتجنب التكرار
            $path = $file->move(public_path('orders/file'), $fileName); // move للـ public/orders/file
            $path = 'orders/file/' . $fileName; // حفظ المسار النسبي في قاعدة البيانات
        }

        Order::create([
            'name' => $request->name,
            'price' => $request->price,
            'count' => $request->count,
            'unit' => $request->unit,
            'place' => $request->place,
            'type' => $request->type,
            'hotel_id' => $request->hotel_id,
            'description' => $request->description,
            'status' => 'waiting',
            'file' => $path,
            'user_id' => auth()->id(),
        ]);

        ToastMagic::success('تم إضافة الطلب بنجاح ✅');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $path = null;

        if ($request->hasFile('price_file')) { // لازم الاسم يطابق input في الفورم
            $file = $request->file('price_file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // لتجنب التكرار
            $path = $file->move(public_path('orders/file'), $fileName); // move للـ public/orders/file
            $path = 'orders/file/' . $fileName; // حفظ المسار النسبي في قاعدة البيانات
        }
        $order = Order::findOrFail($request->id);

        $order->update([
            'name' => $request->name,
            'price' => $request->price,
            'count' => $request->count,
            'price_file' => $path,
            'description' => $request->description,
        ]);

        ToastMagic::success('تم تحديث البيانات بنجاح ✅');
        return redirect()->back();
    }


    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->update(['status' => $request->status]);

        ToastMagic::success('تم تحديث حالة الطلب ✅');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Order::findOrFail($request->id)->delete();

        ToastMagic::success('تم حذف الطلب بنجاح 🗑️');
        return redirect()->back();
    }

}
