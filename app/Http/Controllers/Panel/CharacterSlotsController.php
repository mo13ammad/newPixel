<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\UserSecond;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CharacterSlotsController extends Controller
{
    public function index()
    {
        // گرفتن شناسه کاربری کاربر لاگین کرده
        //$userId = Auth::id();
        $userId = 683668333224394798;

        // تبدیل شناسه کاربری به فرمت "discord:<userid>"
        $discordId = "discord:" . $userId;

        // جستجوی کاربر در جدول users دیتابیس دوم
        $user = UserSecond::where('discord', $discordId)->first();

        if ($user) {
            // گرفتن مقدار license2
            $license2 = $user->license2;

            // جستجوی اطلاعات مربوط به license2 در جدول zsx_multicharacter_slots
            $slot = $user->multicharacterSlot;

            if ($slot) {
                $amount = $slot->amount;
            } else {
                $amount = 0; // اگر اطلاعاتی وجود نداشت
            }
        } else {
            $amount = 0; // اگر کاربر پیدا نشد
        }

        // ارسال اطلاعات به صفحه بلید
        return view('panel.page.character-slots', compact('amount'));
    }
    function buySlots(Request $request)
    {
        // گرفتن شناسه کاربری لاگین‌شده
        //$userId = Auth::id();
        $userId = 683668333224394798;
        $discordId = "discord:" . $userId;

        // جستجوی کاربر در دیتابیس دوم
        $user = UserSecond::where('discord', $discordId)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }

        // گرفتن اطلاعات اسلات کاربر
        $slot = $user->multicharacterSlot;

        if (!$slot || $slot->amount == 0) {
            return redirect()->back()->with('error', 'ابتدا وارد سرور بازی شوید تا کاراکتر اولیه شما ساخته شود.');
        }

        // حداکثر تعداد اسلات مجاز
        $maxSlots = 5;

        // تعداد اسلات فعلی
        $currentSlots = $slot->amount;

        // تعداد اسلات درخواستی
        $requestedSlots = $request->input('slots');

        // اعتبارسنجی تعداد اسلات درخواستی
        if ($currentSlots + $requestedSlots > $maxSlots) {
            return redirect()->back()->with('error', 'شما نمی‌توانید بیشتر از 5 اسلات داشته باشید.');
        }

        // قیمت هر اسلات
        $slotPrice = 1000;
        $totalPrice = $requestedSlots * $slotPrice;
        // انتقال به صفحه پرداخت
        return view('panel.page.buy-slots', [
            'totalPrice' => $totalPrice,
            'requestedSlots' => $requestedSlots,
        ]);
    }
}
