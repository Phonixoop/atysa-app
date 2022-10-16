<?php

namespace App\Http\Controllers\Admin;

use App\Classes\functions;
use App\Models\Dessert;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Plate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{




    // plans


    public function newPlan()
    {
        return view("admin.plan.new");
    }
    public function allPlans(Request $request)
    {
        $all = Plan::all();
        return view('admin.plan.all')->with('all', $all);
    }
    public function createPlan(Request $request)
    {
        $new = new Plan();
        $new->name = $request->name;
        $new->save();
        $request->session()->flash('Inserted', 'پلن مورد نظر افزوده شد.');
        return redirect('admin/plans/all');
    }
    public function singlePlan(Request $request)
    {
        $single = Plan::find($request->id);
        // dd(json_encode($single->months, JSON_PRETTY_PRINT));
        return view('admin.plan.single')->with('single', $single);
    }
    public function updatePlan(Request $request)
    {

        $plan = Plan::find($request->planId);
        $data = array();
        $data['name'] = $request->name;
        $plan->update($data, ['upsert' => true]);
        return redirect('admin/plans/all');
    }


    public function deletePlan(Request $request)
    {

        $plan = Plan::find($request->id);
        $plan->delete();
        $request->session()->flash('removed', 'پلن مورد نظر حذف شد.');
        return back();
    }



    //plans/months
    public function newMonth(Request $request)
    {
        $plan = Plan::find($request->id);

        $plates = Plate::all();
        $dessert = Dessert::all();

        return view('admin.plan.month.new')->with('plates', $plates)->with('dessert', $dessert)->with("plan", $plan);
    }
    public function singleMonth(Request $request)
    {
        $func = new functions();
        $single =  Plan::find($request->id);
        $month = $func->findByObj($single->months, "month", $request->month);

        // dd(json_encode($month["days"], JSON_PRETTY_PRINT));
        $plates = Plate::where('userId', null)->get();
        $dessert = Dessert::all();
        //  dd(json_encode($plates, JSON_PRETTY_PRINT));
        return view('admin.plan.month.single')
            ->with('single', $month)
            ->with('plates', $plates)
            ->with('desserts', $dessert)
            ->with('planId', $request->id)
            ->with('month', $request->month);
    }
    public function allMonths(Request $request)
    {
        $plans = Plan::find($request->id);

        return view('admin.plan.month.all')->with('single', $plans);
    }
    public function createMonth(Request $request)
    {

        $plan = Plan::find($request->planId);

        $planJson = $plan->jsonserialize();


        $month = new Month();
        $month->id = Str::random(9);
        $month->month = $request->month;
        $month->days = $request->days;
        $month->desserts = $request->desserts;
        $month->default = $request->default;

        if (isset($plan->months))
            array_push($planJson["months"], $month);
        else
            $plan->months  = array($month);
        $plan->fill($planJson);

        $plan->save();
        //dd(json_encode(count($plan->months), JSON_PRETTY_PRINT));
        $request->session()->flash('Inserted', 'بشقاب مورد نظر افزوده شد.');

        return redirect("admin/plans/single/$plan->id");
    }
    public function updateMonth(Request $request)
    {
        $func = new functions();
        $single =  Plan::find($request->planId);
        $singleJson = $single->jsonserialize();
        $month = $func->findByObj($single->months, "month", $request->month);
        //dd(json_encode($request->desserts, JSON_PRETTY_PRINT));
        // dd(json_encode($single, JSON_PRETTY_PRINT));
        $data = array();
        $data['month'] = $request->month;
        $data['days'] = $request->days;
        $data['desserts'] = $request->desserts;
        $data['default'] = $request->default;
        foreach ($singleJson["months"] as $key => $element) {
            if ($element["month"] == $request->month) {

                $singleJson["months"][$key] = $data;
                break;
            }
        }
        // dd(json_encode($singleJson, JSON_PRETTY_PRINT));
        $single->fill($singleJson);
        $single->save();
        // $single->update($data, ['upsert' => true]);

        $request->session()->flash('updated', 'بشقاب مورد نظر ویرایش شد.');

        return redirect("admin/plans/$request->planId");
    }
    public function deleteMonth(Request $request)
    {

        $plan = Plan::find($request->planId);
        $planJson = $plan->jsonserialize();

        foreach ($planJson["months"] as $key => $element) {
            if ($element["id"] == $request->monthId) {
                unset($planJson["months"][$key]);
                break;
            }
        }

        $plan->fill($planJson);
        $plan->save();

        $request->session()->flash('removed', 'ماه مورد نظر حذف شد.');
        return back();
    }
}


class Month
{
    public $id;
    public $month;
    public $days;
    public $desserts;
    public $default;
}
