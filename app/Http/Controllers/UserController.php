<?php

namespace App\Http\Controllers;

use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("dashboard.users", compact("users"));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'phone'    => 'required|string|max:20',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role'     => 'required|string'
            ]);

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

             ToastMagic::success('تم إضافة المستخدم بنجاح ✅');
            return back();

        } catch (ValidationException $e) {
            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    ToastMagic::error($message);
                }
            }
            return back()->withInput();

        } catch (\Exception $e) {
           ToastMagic::error('حصل خطأ أثناء الإضافة ❌');
            return back();
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'phone'    => 'required|string|max:20',
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6',
                'role'     => 'required|string'
            ]);

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

             ToastMagic::success('تم تحديث البيانات بنجاح ✅');
            return back();

        } catch (ValidationException $e) {
            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    ToastMagic::error($message);
                }
            }
            return back()->withInput();

        } catch (\Exception $e) {
     ToastMagic::error('حصل خطأ أثناء التحديث ❌');
            return back();
        }
    }

    public function destroy(Request $request)
    {
        try {
            User::findOrFail($request->id)->delete();
            ToastMagic::success('تم حذف المستخدم بنجاح 🗑️');
            return back();

        } catch (\Exception $e) {
          ToastMagic::error('فشل حذف المستخدم ❌');
            return back();
        }
    }
}
