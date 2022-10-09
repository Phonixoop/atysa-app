<?php

namespace App\Http\Controllers;

use App\Classes\functions;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Material;
use App\Models\Plan;
use App\Models\Plate;
use App\Models\Poll;
use App\Models\User;
use App\Models\UserBasket;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use Traversable;
use Zarinpal\Zarinpal;

class UserController extends Controller
{
    public function dashboard()
    {
        $func = new functions();
        $materials = Material::all();
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();

        $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $startOfMonth = CalendarUtils::toGregorian($currentYearNumber, $currentMonthNumber, 1);
        $endOfMonth = CalendarUtils::toGregorian($currentYearNumber, $currentMonthNumber + 1, 1);
        $gregoryDates = CarbonPeriod::create(
            $startOfMonth[0] . '-' . $startOfMonth[1] . '-' . $startOfMonth[2],
            $endOfMonth[0] . '-' . $endOfMonth[1] . '-' . ($endOfMonth[2] - 1)
        );

        $weekCounter = 0;
        $holidayInWeek = array();
        foreach ($gregoryDates as $row) {
            if ($row->format('D') == 'Sat' || $gregoryDates->startDate == $row) {
                $holidayInWeek[$weekCounter] = 0;
                $weekCounter++;
            }
            if (Holiday::where('date', $row)->count() != 0) {
                if ($row->format('D') != 'Fri') {
                    $holidayInWeek[$weekCounter - 1]++;
                }
            }
        }

        $startOfWeek = intval($day) - $dayOfWeek;
        if ($startOfWeek <= 1) {
            $weekOfMonth = 0;
        } elseif ($startOfWeek >= 2 && $startOfWeek < 9) {
            $weekOfMonth = 1;
        } elseif ($startOfWeek >= 9 && $startOfWeek < 16) {
            $weekOfMonth = 2;
        } elseif ($startOfWeek >= 16 && $startOfWeek < 23) {
            $weekOfMonth = 3;
        } elseif ($startOfWeek >= 23 && $startOfWeek < 30) {
            $weekOfMonth = 4;
        } else {
            $weekOfMonth = 5;
        }
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
        return view('user.dashboard')->with('gregoryDates', $gregoryDates)
            ->with('weekOfMonth', $weekOfMonth)
            ->with('dayOfWeek', $dayOfWeek)
            ->with('plan', $plan->days)
            ->with('defaults', $plan->default)
            ->with('holidayInWeek', $holidayInWeek);
    }

    public function addPlan(Request $request)
    {

        $func = new functions();

        $dateWithCurrentMonth = Carbon::now();
        $dateWithNextMonth = Carbon::now()->addMonth(1);

        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');

        if ($day >= 29)
            $dynamicDate = $dateWithNextMonth;
        else
            $dynamicDate = $dateWithCurrentMonth;


        $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($dynamicDate);
        $currentMonthDaysCount = \Morilog\Jalali\Jalalian::fromCarbon($dynamicDate)->getMonthDays();



        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addweek(1))->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('d');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getMonthDays();





        $nextMonth = \Morilog\Jalali\Jalalian::fromCarbon($dynamicDate->addDays(30));
        $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('m');
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $startOfMonth = CalendarUtils::toGregorian($jalaliDate->format("Y"), $jalaliDate->format("m"), 1);
        $endOfMonth = CalendarUtils::toGregorian($jalaliDate->format("Y"), $nextMonth->format("m"), 1);
        $gregoryDates = CarbonPeriod::create(
            $startOfMonth[0] . '-' . $startOfMonth[1] . '-' . $startOfMonth[2],
            $endOfMonth[0] . '-' . $endOfMonth[1] . '-' . $endOfMonth[2]
        );




        //  $startOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber,1 );
        //  $gregoryDates = CarbonPeriod::create($startOfMonth[0].'-'.$startOfMonth[1].'-'.($startOfMonth[2])
        //      , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]-1));

        $weekCounter = 0;
        $holidayInWeek = array();
        foreach ($gregoryDates as $row) {
            if ($row->format('D') == 'Sat' || $gregoryDates->startDate == $row) {
                $holidayInWeek[$weekCounter] = 0;
                $weekCounter++;
            }
            if (Holiday::where('date', $row)->count() != 0) {
                if ($row->format('D') != 'Fri') {
                    $holidayInWeek[$weekCounter - 1]++;
                }
            }
        }
        $startOfWeek = intval($day) - $dayOfWeek;
        if ($startOfWeek <= 1) {
            $weekOfMonth = 0;
        } elseif ($startOfWeek >= 2 && $startOfWeek < 9) {
            $weekOfMonth = 1;
        } elseif ($startOfWeek >= 9 && $startOfWeek < 16) {
            $weekOfMonth = 2;
        } elseif ($startOfWeek >= 16 && $startOfWeek < 23) {
            $weekOfMonth = 3;
        } elseif ($startOfWeek >= 23 && $startOfWeek < 30) {
            $weekOfMonth = 4;
        } else {
            $weekOfMonth = 5;
        }
        $monthName = $func->returnFullMonthFromDateType($jalaliDate->format("M"));

        $plan = Plan::where('month', $monthName)->first();

        $mydishes = Plate::where('userId', Auth::id())->get();
        $myArray = array();
        $planning = [];
        foreach ($mydishes as $key => $row) {
            $myArray[$key] = $row->id;
        }

        foreach ($plan->days[$weekOfMonth] as $key => $row) {
            $planning[$key] = $row;
            foreach ($myArray as $row2) {
                array_push($planning[$key], $row2);
            }
        }




        if ($currentMonthDaysCount == 31) $weekOfMonth = 0;
        else if ($currentMonthDaysCount == 30) $weekOfMonth = -1;
        else if ($currentMonthDaysCount == 29) $weekOfMonth = -2;
        else $weekOfMonth = -3;

        $companyId = Auth::user()->companyId;
        $company = Company::find($companyId);
        $plateFee = $company->plateFee ? $company->plateFee : 0;


        return view('user.meals')->with('myDishes', $myArray)->with('weekOfMonth', $weekOfMonth)
            ->with('dayOfWeek', $dayOfWeek)->with('plan', $plan)->with('gregoryDates', $gregoryDates)
            ->with('plateFee', $plateFee)
            ->with('holidayInWeek', $holidayInWeek)->with('monthNumber', $jalaliDate->format("m"))
            ->with("monthName", $monthName);
    }
    public function pollPage(Request $request)
    {
        return view('user.poll');
    }
    public function pollSend(Request $request)
    {
        Poll::create([
            'mobile'            => $request->mobile,
            'zaherKolli'        => $request->zaherKolli,
            'rangeGhaza'        => $request->rangeGhaza,
            'bafteGhaza'        => $request->bafteGhaza,
            'cheghadrLezzat'    => $request->cheghadrLezzat,
            'mojaddad'          => $request->mojaddad,
        ]);
        $request->session()->flash('Inserted', 'نظر شما با موفقیت قبت شد.');
        return back();
    }
    public function createplate(Request $request)
    {
        $materials = Material::all();
        return view('user.createPlate')->with('materials', $materials);
    }
    public function allplates(Request $request)
    {
        $plates = Plate::where('userId', Auth::id())->get();
        return view('user.allPlates')->with('plates', $plates);
    }
    public function updatePlan(Request $request)
    {


        $func = new functions();

        $companyId = Auth::user()->companyId;
        $company = Company::find($companyId);
        $plateFee = $company->plateFee ? $company->plateFee : 0;

        $plans = array();

        foreach ($request->plate as $date => $row) {
            if ($row != null) {
                $plan = new PlanClass();
                $plan->plateDate = $date;
                $plan->plate = $row;
                array_push($plans, $plan);
            }
        }



        $boughtCount =  User::getPlansCount(Auth::id());
        $plansRequestCount = count($plans);
        $amount = max($plansRequestCount, $boughtCount) - $boughtCount;

        $totalFee = $amount * $plateFee;

        if ($totalFee > 0) // if have to pay first
        {


            #region create history
            $purchase = new Purchase();
            $purchase->hasPayed = false;
            $purchase->totalFee = $totalFee;
            $purchase->plans = $plans;
            $purchase->purchaseDate = Carbon::now()->format('Y-m-d H-i-s');
            $purchase->authority = null;


            $history = new History();
            $history->date = Carbon::now()->format('Y-m');

            #endregion


            $userBasket = UserBasket::where("userId", Auth::id())->first();



            if ($userBasket) {
                $basket = $userBasket->jsonserialize();
                foreach ($basket["histories"] as $key => $historyItem) {

                    if ($historyItem["date"] === Carbon::now()->format('Y-m')) {
                        //  dd(json_encode($userBasket, JSON_PRETTY_PRINT));
                        array_push($basket["histories"][$key]["purchases"], $purchase);
                        //  dd(json_encode($userBasket["histories"][$key]["purchases"], JSON_PRETTY_PRINT));
                        break;
                    } else {
                        $history->purchases = array($purchase);
                        array_push($basket["histories"], $history);

                        break;
                    }
                }

                $userBasket->fill($basket);
                $userBasket->save();
            } else {

                $data = array();
                $data['userId'] = Auth::id();
                $history->purchases = array($purchase);
                $data['histories'] = array($history);
                $userBasket =  UserBasket::create($data);
            }


            // zarinpal
            //  dd(json_encode($userBasket, JSON_PRETTY_PRINT));

            $response = zarinpal()
                ->amount($totalFee * 1.09) // مبلغ تراکنش
                ->request()
                ->description(' خرید ' . $plansRequestCount . ' تعداد غذا') // توضیحات تراکنش
                ->callbackUrl('http://localhost:8000/pay?basketId=' . $userBasket->id . "&historyDate=" . $history->date) // آدرس برگشت پس از پرداخت
                ->mobile(Auth::user()->mobile) // شماره موبایل مشتری - اختیاری
                ->email('sales@atysa.ir') // ایمیل مشتری - اختیاری
                ->send();

            if (!$response->success()) {
                return $response->error()->message();
            }

            // ذخیره اطلاعات در دیتابیس
            // $response->authority();

            // هدایت مشتری به درگاه پرداخت
            return $response->redirect();
        }

        User::updateUserPlan($request->plate, Auth::id());



        // dd(json_encode($plans,JSON_PRETTY_PRINT));
        return redirect('/');
    }
    public function deletePlate(Request $request)
    {
        $plate = Plate::find($request->plateId)->delete();
        return back();
    }
    public function takeSecondLevel(Request $request)
    {
        $level = Material::find($request->id);
        return $level->materialChilds;
    }
    public function profile()
    {
        $user = User::find(Auth::id());
        return view('user.profile')->with('user', $user);
    }
    public function updateProfile(Request $request)
    {
        $function = new functions();
        $user = new User();
        $imgUrl = Auth::user()->avatar;
        if ($request->hasFile('file')) {
            $fileName = $function->uploadImage($request->file('file'), 'uploads/avatars', $imgUrl);
            $imgUrl = $fileName;
        }

        $data = [
            'calory' => $request->calory,
            'avatar' => $imgUrl,
        ];
        $user = User::find(Auth::id());
        $user->update($data);
        return back();
    }
    public function editCalory()
    {
        $user = User::find(Auth::id());
        return view('user.calory')->with('user', $user);
    }
    public function updateEditCalory(Request $request)
    {
        $user = new User();
        $data = [
            'calory' => $request->calory,
        ];
        $user = User::find(Auth::id());
        $user->update($data);
        return back();
    }
    public function insertPlate(Request $request)
    {
        $plate = new Plate();
        $plate->userId = Auth::id();
        $plate->calory = $request->totalCalory;
        $data = array();
        $count = 0;
        foreach ($request->materials as $element) {
            foreach ($element as $item) {
                $data[$count]['name'] = $element;
                $count++;
            }
        }
        $plate->materials = $data;
        $plate->name = $request->plateName;
        $plate->save();
        return redirect('/user/all-plates');
    }
}

class PlanClass
{
    public $plateDate; //Date
    public $plate; //String

}
class Purchase
{
    public $hasPayed; //boolean 
    public $totalFee; //int
    public $plans; //array( Plan )
    public $purchaseDate; // date
    public $authority;
}
class History
{
    public $date; //Date
    public $purchases; //array( Purchse )

}

class Basket
{
    public $history;
}
