<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        session()->flash('showLoginModal', true);
        return redirect()->back(); // العودة للصفحة الحالية

    }

    /**
     * Handle an incoming authentication request.
     */

    public function redirectTo()
    {
        if (auth()->user()->roles()->first()->allowed_route != '') {
            return $this->redirectTo = auth()->user()->roles()->first()->allowed_route . '/index';
        }
    }


    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();


        if (auth()->user()->roles()->first()->allowed_route != ''){
            return redirect()->intended('/admin/index');
        }else{
            return redirect()->intended('/');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:9', // تأكد من رقم الهاتف
        ]);

        // منطق إرسال كود OTP (يمكنك استخدام Twilio أو أي خدمة أخرى)
        $otp = rand(100000, 999999); // إنشاء كود عشوائي

        // احفظ الكود في جلسة المستخدم للتحقق لاحقًا
        session(['otp' => $otp, 'phone' => $request->phone]);

        // إرسال الكود عبر الرسائل النصية (يجب تكوين خدمة الرسائل)
        // Twilio أو خدمات الرسائل
        $apiIs ='12217188-dbe7-436c-9a05-b4bbab3512a8';
        $message = $otp.'هوه كود التحقق الخاص بكم لا تشاركة مع احد';
        $mobile =$request->phone;
        whatsapp ($apiIs, $mobile, $message);


        return response()->json(['success' => true, 'message' => 'OTP sent successfully.']);
    }

    // دالة للتحقق من كود OTP وتسجيل الدخول
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);
        if ($request->otp == session('otp')) {
            $mobile = '966'.session('phone');
            $user = User::where('mobile',$mobile )->first();
            if ($user) {
                Auth::login($user);
                return response()->json(['success' => true]);

            } else {
                return response()->json(['success' => false, 'message' => 'Phone number not found.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP code.']);
        }
    }

}
