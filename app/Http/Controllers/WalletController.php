<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Models\User;
use App\Models\UserBasket;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class WalletController extends Controller
{
    // http://localhost:8000/pay?basketId=63414fa2f18ecc276a03f948&historyDate=2022-10&Authority=A00000000000000000000000000381605546&Status=OK
    public function chargeWallet(Request $request)
    {
        if (!$request->OK)
            return view('purchase')->with("ok", false);

        $wallet = Wallet::where("userId", $request->userId);
        $walletJson = $wallet->jsonserialize();
    }
}
