<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBasket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class PayController extends Controller
{

    public function zarinpalverify(Request $request)
    {
        // http://localhost:8000/pay?basketId=63414fa2f18ecc276a03f948&historyDate=2022-10&Authority=A00000000000000000000000000381605546&Status=OK

        if ($request->Status == "NOK") {
            return "نشد که";
        }


        $userBasket = UserBasket::find($request->basketId)->where("histories.date", $request->historyDate)->first();
        if (!$userBasket)
            return "سبد شما خالی است";

        $basket = $userBasket->jsonserialize();
        $plans = array();
        $count = count($basket["histories"][0]["purchases"]);
        $purchase = $basket["histories"][0]["purchases"][$count - 1];
        if ($purchase["hasPayed"] == false) {
            // if user payed
            $basket["histories"][0]["purchases"][$count - 1]["hasPayed"] = true;
            $basket["histories"][0]["purchases"][$count - 1]["authority"] = $request->Authority;
            foreach ($purchase["plans"] as $plan) {

                $plans[$plan["plateDate"]] = $plan["plate"];
            }
        }




        $userBasket->fill($basket);
        $userBasket->save();
        User::updateUserPlan($plans, $userBasket->userId);
        return redirect('/');
    }
}
