<?php

namespace App\Http\Controllers;

use App\Classes\functions;
use App\Models\UserBasket;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class WalletController extends Controller
{


    public function charge(Request $request)
    {
        $func = new functions();
        if (is_null($request->amount) || $request->amount <= 0)
            return view('purchase')->with("error", "خطا");

        $amount =  $func->parse($request->amount);
        $user = Auth::user();

        $transaction = new Transaction();
        $transaction->hasPayed = false;
        $transaction->amount = (int)$amount;
        $transaction->date = Carbon::now()->format("Y-m-d h:i:s");
        $transaction->authority = null;

        $wallet = Wallet::where("user", $user->id)->first();
        if ($wallet) {
            $walletJson = $wallet->jsonserialize();
            array_push($walletJson["transactions"], $transaction);
            $wallet->fill($walletJson);
            $wallet->save();
        } else {
            $data = array();
            $data["budget"] = 0;
            $data["user"] =  $user->id;
            $data["transactions"] = array($transaction);
            $wallet =  Wallet::create($data);
        }

        $response = $func->payWithZarinpal($amount, $user->mobile, "wallet/walletverify?walletId=" . $wallet->id . "&transactionDate=" . $transaction->date);


        if (!$response->success()) {
            return $response->error()->message();
        }

        // ذخیره اطلاعات در دیتابیس
        // dd($response->authority());
        $walletToUpdate = Wallet::where('transactions.date', $transaction->date)->first();
        $walletJson = $walletToUpdate->jsonserialize();
        $walletJson["transactions"][0]["authority"] = $response->authority();
        $wallet->fill($walletJson);
        $wallet->update();
        // هدایت مشتری به درگاه پرداخت
        return $response->redirect();
    }
    // http://localhost:8000/wallet/walletverify?walletId=6342e22082b238f1ad0476e8&transactionDate=2022-10&Authority=A00000000000000000000000000381605546&Status=OK
    public function walletverify(Request $request)
    {

        if (!$request->Status)
            return view('purchase')->with("ok", false);


        $wallet  = Wallet::find($request->walletId)->where("transactions.date", $request->transactionDate)->first();

        $walletJson = $wallet->jsonserialize();







        $count = count($walletJson["transactions"]);
        $transaction = $walletJson["transactions"][$count - 1];

        if ($walletJson["transactions"][$count - 1]["hasPayed"])
            return redirect('/user/wallet');


        $walletJson["transactions"][$count - 1]["hasPayed"] = true;
        $amount =  $walletJson["transactions"][$count - 1]["amount"];
        $budget = $walletJson["budget"];
        $walletJson["budget"] = $budget + $amount;
        $wallet->fill($walletJson);
        $wallet->update();
        return redirect('/user/wallet')->with("budget", $walletJson["budget"]);
    }
}


class Transaction
{
    public $hasPayed;
    public $amount;
    public $date;
    public $authority;
}
