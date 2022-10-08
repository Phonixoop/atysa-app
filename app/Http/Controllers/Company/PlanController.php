<?php

namespace App\Http\Controllers\Company;

use App\Classes\functions;
use App\Models\Company;
use App\Models\Dessert;
use App\Models\Holiday;
use App\Models\Hotbox;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Plan;
use App\Models\Plate;
use App\Models\Poll;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class PlanController extends Controller
{
    public function all(){
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('d');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();
        $func = new functions();
        $startOfWeek = intval($day) - $dayOfWeek;
        if($startOfWeek <= 1){
            $weekOfMonth = 0;
        }elseif($startOfWeek >= 2 && $startOfWeek < 9){
            $weekOfMonth = 1;
        }
        elseif($startOfWeek >= 9 && $startOfWeek < 16){
            $weekOfMonth = 2;
        }
        elseif($startOfWeek >= 16 && $startOfWeek < 23){
            $weekOfMonth = 3;
        }elseif($startOfWeek >= 23 && $startOfWeek < 30){
            $weekOfMonth = 4;
        }
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
        if(isset($plan->desserts[$weekOfMonth])){
        return view('company.plan.all')->with('weekOfMonth',$weekOfMonth)->with('dayOfWeek',$dayOfWeek)->with('plan',$plan->desserts[$weekOfMonth]);
        }else{
        return view('company.plan.all')->with('weekOfMonth',$weekOfMonth)->with('dayOfWeek',$dayOfWeek)->with('plan',null);
        }
        
    }
    public function update(Request $request){
        $arr = array();
        $User = User::find(Auth::id());
        $User->update();
        if($User->dessert){
            foreach($User->dessert as $key=>$row){
                if($row != null){
                    $arr[$key] = $row;
                }    
            }
        }

        foreach($request->dessert as $key=>$row){
            if($row != null){
                $arr[$key] = $row;
            }
        }
        $User->update(['dessert' => $arr]);
        return back();
    }
    public function meals(){
        $func = new functions();
        $materials = Material::all();
        /*$mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');*/
      
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('d');
      
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();


        $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('m');
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
      
       // $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        //$currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $startOfMonth = Carbon::now()->addHour(12)->format('Y-m-d');
        $endOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber+1,1 );
      
      
      
        $gregoryDates = CarbonPeriod::create($startOfMonth
                                           , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]-1));
      
      
      

      
        $weekCounter = 0;
        $holidayInWeek = array();
        foreach($gregoryDates as $row){
            if($row->format('D') == 'Sat' || $gregoryDates->startDate == $row){
                $holidayInWeek[$weekCounter] = 0;
                $weekCounter++;
            }
            if(Holiday::where('date', $row) ->count() != 0){
                if($row->format('D') != 'Fri'){
                    $holidayInWeek[$weekCounter-1]++;
                }
            }
        }
        $startOfWeek = intval($day) - $dayOfWeek;
        if($startOfWeek <= 1){
            $weekOfMonth = 0;
        }elseif($startOfWeek >= 2 && $startOfWeek < 9){
            $weekOfMonth = 1;
        }
        elseif($startOfWeek >= 9 && $startOfWeek < 16){
            $weekOfMonth = 2;
        }
        elseif($startOfWeek >= 16 && $startOfWeek < 23){
            $weekOfMonth = 3;
        }elseif($startOfWeek >= 23 && $startOfWeek < 30){
            $weekOfMonth = 4;
        }
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
        return view('company.plan.meals')->with('materials', $materials)
                                         ->with('weekOfMonth',$weekOfMonth)
                                         ->with('dayOfWeek',$dayOfWeek)
                                         ->with('plan',$plan)
                                         ->with('gregoryDates',$gregoryDates)
                                         ->with('holidayInWeek',$holidayInWeek);
                                         
    }
    public function mealUpdate(Request $request){
        $arr = array();
        $User = User::find(Auth::id());
        if($User->guest){
            foreach($User->guest as $key=>$row){
                if($row != null){
                    $arr[$key] = $row;
                }
            }
        }
        foreach($request->plan as $key=>$row){
            foreach($row as $key2=>$row2){
                if(isset($row2['count']) && $row2['count'] != null){
                    $arr[$key][$key2] = $row2;
                }
            }
        }
        $User->update(['guest' => $arr]);
        return back();
    }
    public function day(){
        $func = new functions();
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        
        $company = Company::where('manager',Auth::id())->first();
        $personels = User::where('companyId',$company->id)->get();
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();

        $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $startOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber,1 );
        $endOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber+1,1 );
        $gregoryDates = CarbonPeriod::create($startOfMonth[0].'-'.$startOfMonth[1].'-'.$startOfMonth[2]
                                            , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]-1));
      

        $weekCounter = 0;
        foreach($gregoryDates as $row){
            if($row->format('D') == 'Sat' || $gregoryDates->startDate == $row){
                $weekCounter++;
            }
            if($row->format('Y-m-d') == Carbon::now()->format('Y-m-d')){
                $currentWeek = $weekCounter -1;
            }
        }
        $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::now()));
        $data = array();
        $todayPlates = $plan->days[$currentWeek][$currentDay];
        foreach($todayPlates as $key=>$row){
            $data['dishes'][$key]['name'] = Plate::find($row)->name;
            $data['dishes'][$key]['count'] = 0;
        }
        foreach($personels as $key=>$row){
            $data['users'][$key]['name'] = $row->name;
            $data['users'][$key]['type'] = $row->isVip == 1  ? 'وی آی پی' : 'کارمند ساده' ;
            if(isset($row->plan[Carbon::now()->format('Y-m-d')])){
                $data['users'][$key]['plate'] = Plate::find($row->plan[Carbon::now()->format('Y-m-d')])->name;
            }else{
                $data['users'][$key]['plate'] = Plate::find($plan->default[$currentWeek][$currentDay])->name;
            }
            foreach($todayPlates as $key=>$planDish){
                if(isset($row->plan[Carbon::now()->format('Y-m-d')])){
                    if($planDish == $row->plan[Carbon::now()->format('Y-m-d')]){
                        $data['dishes'][$key]['count']++;
                    }
                }else{
                    if($planDish == $plan->default[$currentWeek][$currentDay]){
                        $data['dishes'][$key]['count']++;
                    }
                }
            }
        }
        if(isset(Auth::user()->dessert[Carbon::now()->format('Y-m-d')])){
            
            foreach(Auth::user()->dessert[Carbon::now()->format('Y-m-d')] as $key=>$row){
                $data['dessert'][$key]['name'] = Dessert::find($row['name'])->name;
                $data['dessert'][$key]['count'] = $row['count'];
            }
        }else{
            $data['dessert'] = null;
        }
        if(isset(Auth::user()->guest[Carbon::now()->format('Y-m-d')])){
            foreach(Auth::user()->guest[Carbon::now()->format('Y-m-d')] as $key=>$row){
                $data['guest'][$key]['name'] = Plate::find($row['name'])->name;
                $data['guest'][$key]['count'] = $row['count'];
            }
        }else{
            $data['guest'] = null;
        }
        $fileName = Carbon::now()->format('Y-m-d-h-s').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('نام کارمند','نوع کارمند', 'غذا' );
        $columns2 = array('نام غذا', 'تعداد');
        $columns3 = array('نام پیش غذا یا دسر', 'تعداد');
        $columns4 = array('نام غذای مهمان', 'تعداد');
        $callback = function() use($data, $columns,$columns2,$columns3,$columns4) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns2);
            foreach ($data['dishes'] as $task) {

                fputcsv($file, $task);
            }
            $blanks = array("\t","\t","\t","\t");
            fputcsv($file, $blanks);
            fputcsv($file, $columns);
            foreach ($data['users'] as $task) {
                fputcsv($file, $task);
            }
            if($data['dessert'] != null){
                $blanks = array("\t","\t","\t","\t");
                fputcsv($file, $blanks);
                fputcsv($file, $columns3);
                foreach ($data['dessert'] as $task) {
                    fputcsv($file, $task);
                }
            }
            if($data['guest'] != null){
                $blanks = array("\t","\t","\t","\t");
                fputcsv($file, $blanks);
                fputcsv($file, $columns4);
                foreach ($data['guest'] as $task) {
                    fputcsv($file, $task);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function hotBox(Request $request){
        return view('company.hotbox');
    }
    public function month(Request $request){
        $company = Company::where('manager',Auth::id())->first();
        $usr = User::find($company->manager);
        $func = new functions();
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        
        $personels = User::where('companyId',$company->id)->get();
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();

        $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $startOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber,1 );
        $endOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber+1,1 );
        $gregoryDates = CarbonPeriod::create($startOfMonth[0].'-'.$startOfMonth[1].'-'.$startOfMonth[2]
                                            , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]));
      
    

        $startOfMonth2 = Carbon::now()->addHour(12)->format('Y-m-d');
        $gregoryDates2 = CarbonPeriod::create($startOfMonth2
                                            , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]-1));
        $weekCounter = 0;
        foreach($gregoryDates as $row){
            if($row->format('D') == 'Sat' || $gregoryDates->startDate == $row){
                $weekCounter++;
            }
            if($row->format('Y-m-d') == Carbon::now()->format('Y-m-d')){
                $currentWeek = $weekCounter -1;
            }
        }
        
        $data = array();
        foreach($gregoryDates2 as $key2=>$row2){
            if($row2->format('D') != 'Fri' && $row2->format('D') != 'Thu'){
            $currentDay = CalendarUtils::strftime('w', strtotime($row2));
            if(isset($plan->days[$currentWeek][$currentDay])){
                $data[$key2]['date'] = \Morilog\Jalali\Jalalian::fromCarbon($row2)->format('Y/m/d');
                
                $todayPlates = $plan->days[$currentWeek][$currentDay];
                foreach($todayPlates as $key=>$row){
                    $data[$key2]['dishes'][$key]['name'] = Plate::find($row)->name;
                    $data[$key2]['dishes'][$key]['count'] = 0;
                }
                foreach($personels as $key=>$row){
                    $data[$key2]['users'][$key]['name'] = $row->name;
                    $data[$key2]['users'][$key]['type'] = $row->isVip == 1  ? 'وی آی پی' : 'کارمند ساده' ;
                    if(isset($row->plan[$row2->format('Y-m-d')])){
                        $data[$key2]['users'][$key]['plate'] = Plate::find($row->plan[$row2->format('Y-m-d')])->name;
                    }else{
                        $data[$key2]['users'][$key]['plate'] = Plate::find($plan->default[$currentWeek][$currentDay])->name;
                    }
                    foreach($todayPlates as $key=>$planDish){
                        if(isset($row->plan[$row2->format('Y-m-d')])){
                            if($planDish == $row->plan[$row2->format('Y-m-d')]){
                                $data[$key2]['dishes'][$key]['count']++;
                            }
                        }else{
                            if($planDish == $plan->default[$currentWeek][$currentDay]){
                                $data[$key2]['dishes'][$key]['count']++;
                            }
                        }
                    }
                }
                if(isset($usr->dessert[$row2->format('Y-m-d')])){
                    
                    foreach($usr->dessert[$row2->format('Y-m-d')] as $key=>$row){
                        $data[$key2]['dessert'][$key]['name'] = Dessert::find($row['name'])->name;
                        $data[$key2]['dessert'][$key]['count'] = $row['count'];
                    }
                }else{
                    $data[$key2]['dessert'] = null;
                }
                if(isset($usr->guest[$row2->format('Y-m-d')])){
                    foreach($usr->guest[$row2->format('Y-m-d')] as $key=>$row){
                        $data[$key2]['guest'][$key]['name'] = Plate::find($row['name'])->name;
                        $data[$key2]['guest'][$key]['count'] = $row['count'];
                    }
                }else{
                    $data[$key2]['guest'] = null;
                }
            }
            }
            if($row2->format('D') == 'Fri'){
                $currentWeek++;
            }
        }
        $fileName = Carbon::now()->format('Y-m-d-h-s').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('نام کارمند', 'نوع کارمند', 'غذا');
        $columns2 = array('نام غذا', 'تعداد');
        $columns3 = array('نام پیش غذا یا دسر', 'تعداد');
        $columns4 = array('نام غذای مهمان', 'تعداد');
        $callback = function() use($data, $columns,$columns2,$columns3,$columns4) {
            $file = fopen('php://output', 'w');
            foreach($data as $key=>$da){
                    fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

                    $blanks = array("\t","\t","\t","\t");
                    fputcsv($file, $blanks);
                    fputcsv($file, array($da['date']));
                    $blanks = array("\t","\t","\t","\t");
                    fputcsv($file, $blanks);
                    fputcsv($file, $columns2);
                    foreach ($da['dishes'] as $task) {
    
                        fputcsv($file, $task);
                    }
                    $blanks = array("\t","\t","\t","\t");
                    fputcsv($file, $blanks);
                    fputcsv($file, $columns);
                    foreach ($da['users'] as $task) {
                        fputcsv($file, $task);
                    }
                    if(isset($da['dessert'])){
                        if($da['dessert'] != null){
                            $blanks = array("\t","\t","\t","\t");
                            fputcsv($file, $blanks);
                            fputcsv($file, $columns3);
                            foreach ($da['dessert'] as $task) {
                                fputcsv($file, $task);
                            }
                        }
                    }
                    if(isset($da['guest'])){
                        if($da['guest'] != null){
                            $blanks = array("\t","\t","\t","\t");
                            fputcsv($file, $blanks);
                            fputcsv($file, $columns4);
                            foreach ($da['guest'] as $task) {
                                fputcsv($file, $task);
                            }
                        }
                    }
                
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function map(Request $request){
        $hotBox =Hotbox::find($request->id);
        return view('company.google')->with('hotbox', $hotBox);
    }
    public function polls(){
    	$func = new functions();
        $company = Company::where('manager', Auth::user()->id);
        $poll = Poll::orderBy('created_at','DESC')->get();
        $extra = array();
        if($company->count() != 0){
            foreach($poll as $key=>$row){
                if(isset($row->mobile)){
                    $user = User::where('mobile','like', '%' . $this->convert2english($row->mobile). '%')
                    ->where('companyId', $company->first()->id);
                    if($user->count() == 1){
                        if(isset($user->first()->plan)){
                            if(isset($user->first()->plan[Carbon::parse($row->created_at)->format('Y-m-d')])){
                                $food = Plate::find($user->first()->plan[Carbon::parse($row->created_at)->format('Y-m-d')])->name;
                            }else{
                                $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($row->created_at))->format('M');
                                $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
                                $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::parse($row->created_at)));
                                $food = Plate::find($plan->default[1][$currentDay])->name;
                            }
                        }else{
                                $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($row->created_at))->format('M');
                                $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
                                $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::parse($row->created_at)));
                                $food = Plate::find($plan->default[1][$currentDay])->name;
                        }
                        array_push($extra, [
                            'poll' => $row,
                            'user' => $user->first()->toArray(),
                            'food' => $food
                        ]);
                    }
                }
            }
        }
        return view('company.poll')->with('extra',$extra);
    }
    private function convert2english($string) {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    
        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
}
