<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Models\User;
use App\Models\UserBasket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class PayController extends Controller
{

    public function zarinpalverify(Request $request)
    {
        // http://localhost:8000/pay?basketId=63414fa2f18ecc276a03f948&historyDate=2022-10&Authority=A00000000000000000000000000381605546&Status=OK



        if (strlen($request->Authority) <= 0)
            return redirect('/');

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

        $plates = array();
        foreach ($purchase["plans"] as $plan) {
            $plate = new PlateClass();
            $temp = Plate::find($plan["plate"]);
            $plate->name =  $temp["name"];
            $plate->date = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::createFromDate($plan["plateDate"]))->format('Y/m/d');

            array_push($plates, $plate);
        }





        // $userBasket->fill($basket);
        // $userBasket->save();
        // User::updateUserPlan($plans, $userBasket->userId);

        return view('purchase')->with("ok", true)->with("plates", $plates);
    }
}


class PlateClass
{
    public $name;
    public $date;
}
