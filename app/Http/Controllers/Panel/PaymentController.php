<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\UserSecond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'totalPrice' => 'required|numeric|min:0',
            'requestedSlots' => 'required|integer|min:1',
        ]);

                //$userId = Auth::id();
        $userId = 683668333224394798;
        $discordId = "discord:" . $userId;

        // جستجوی کاربر در دیتابیس دوم
        $user = UserSecond::where('discord', $discordId)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }

        // ایجاد تراکنش
        $transaction = new Transaction();
        $transaction->user_id = $userId;
        $transaction->slots = $request->input('requestedSlots');
        $transaction->amount = $request->input('totalPrice');
        $transaction->save();

        // ایجاد فاکتور
        $invoice = new Invoice();
        $invoice->amount($request->input('totalPrice'))
            ->detail('user_id', $userId)
            ->detail('slots', $request->input('requestedSlots'));

        // شروع فرآیند پرداخت
        return Payment::callbackUrl(route('payment.callback', ['transaction' => $transaction->id]))
            ->purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                $transaction->trans_id = $transactionId;
                $transaction->save();
            })
            ->pay()
            ->render();
    }

    // متد برای بازگشت از درگاه پرداخت
    public function paymentCallback(Request $request, Transaction $transaction)
    {
        try {
            if ($transaction->is_paid) {
                return redirect()->route('character.slots')->withErrors('این تراکنش قبلاً پرداخت شده است.');
            }

            // تأیید پرداخت
            $receipt = Payment::amount($transaction->amount)->transactionId($transaction->trans_id)->verify();

            // به‌روزرسانی تراکنش
            $transaction->update([
                'is_paid' => true,
                'trans_id' => $receipt->getReferenceId(),
            ]);

            // به‌روزرسانی اسلات‌های کاربر
                    //$userId = Auth::id();
        $userId = 683668333224394798;
            $discordId = "discord:" . $userId;

            $user = UserSecond::where('discord', $discordId)->first();
            if ($user && $user->multicharacterSlot) {
                $user->multicharacterSlot->increment('amount', $transaction->slots);
            }

            return redirect()->route('character.slots')->with('success', 'پرداخت با موفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('character.slots')->withErrors('پرداخت ناموفق بود: ' . $e->getMessage());
        }
    }
}
