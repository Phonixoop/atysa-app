<?php

namespace App\Http\Controllers;

use App\Classes\functions;
use App\Models\Hotbox;
use App\Models\Plan;
use App\Models\Plate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;

class ApiController extends Controller
{
    public function updateHotbox(Request $request)
    {
        $hotbox = Hotbox::find($request->id);
        if ($hotbox != null) {
            $hotbox->lat = $request->lat ? $request->lat : null;
            $hotbox->lang = $request->lang ? $request->lang : null;
            $hotbox->temp = $request->temperature ? $request->temperature : null;
            $hotbox->update();
            return response()->json([
                'message' => 'ok',
                'status'  => 1
            ]);
        } else {
            return response()->json([
                'message' => 'nok',
                'status'  => 0
            ]);
        }
    }
    public function todayFoods(Request $request)
    {
        $func = new functions();
        $numberWeekOn = (int)$func->emroozhaftechandomemahe(\Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d'));
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        $output = array();
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
        $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::now()));
        if (isset($plan->days[$numberWeekOn][$currentDay])) {
            $todayPlates = $plan->days[$numberWeekOn][$currentDay];
            foreach ($todayPlates as $row) {
                $pla = Plate::find($row)->toArray();
                array_push($output, $pla);
            }

            return response()->json($output)->header("Access-Control-Allow-Origin",  "*");
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'No Related Data',
            ]);
        }
    }
}
