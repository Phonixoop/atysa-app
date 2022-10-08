<?php

namespace App\Http\Controllers\Admin;

use App\Classes\functions;
use App\Models\Company;
use App\Models\Dessert;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Plan;
use App\Models\Plate;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class CompanyController extends Controller
{
    public function validation($data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'manager' => ['required'],
            'endDate' => ['required'],
        ],[
            'endDate.required' => 'تاریخ اتمام باید مشخص شود',
            'name.required' => 'باید نام وارد شود',
            'manager.required' => 'حتا باید مدیر داشته باشد',
        ]);
    }
    public function new(){
        $managers = User::where('type','=','4')->get();
        return view('admin.company.new')->with('managers',$managers);
    }
    public function single(Request $request){
        $single = Company::find($request->id);
        $managers = User::where('type','=','4')->get();
        return view('admin.company.single')->with('single',$single)
                                           ->with('managers',$managers);
    }
    public function all(){
        $all = Company::all();
        $managers = array();
        foreach($all as $key=>$row){
            $managers[$key] = User::find($row->manager);
        }
        return view('admin.company.all')->with('all',$all)->with('managers',$managers);
    }
    public function create(Request $request){
        $validation = $this->validation($request->all());
        if ($validation->fails()) {
            return back()->withErrors($validation);
        }else{
            $new = new Company();
            $tempDate = $this->convert($request->endDate);
            $dateTime = CalendarUtils::createDatetimeFromFormat('Y/n/j', $tempDate);
            $new->name = $request->name;
            $new->manager = $request->manager;
            if(is_numeric($request->plateFee))
            {
                $new->plateFee =  $request->plateFee > 0 ? $request->plateFee : 0;
            }
            else
            {
                $new->plateFee = 0;
            }
         
            try{
                if($request->manager){
                    $function = new functions();
                    $manager = User::find($request->manager);
                   
                        $function->welcomeMessage($manager->mobile,$manager->name);
                    
                }
                
            }catch(Exception $e){

            }
            $new->phone = $request->phone;
            $new->endDate = $dateTime;
            if($request->enable == 'true'){
                $new->enable = true;
            }else{
                $new->enable = false;
            }
            $new->save();
        }
        $request->session()->flash('Inserted', 'شرکت مورد نظر افزوده شد.');
        return redirect('admin/companies/all');
    }
    public function update(Request $request){
        $single = Company::find($request->id);
        $data = array();
        $tempDate = $this->convert($request->endDate);
        $dateTime = CalendarUtils::createDatetimeFromFormat('Y/n/j', $tempDate);
        $data['name'] = $request->name;
        $data['manager'] = $request->manager;
        $data['plateFee'] = $request->plateFee;

        if(is_numeric($request->plateFee))
        {
            $data['plateFee'] =   $request->plateFee > 0 ? $request->plateFee : 0;
        }
        else
        {
            $data['plateFee'] = 0;
        }
       

        try{
            if($request->manager &&  $request->manager != $single->manager){
                $function = new functions();
                $manager = User::find($request->manager);
                if(count($manager) > 0){
                    $function->welcomeMessage($manager->mobile,$manager->name);
                }
            }
            
        }catch(Exception $e){

        }
        $data['phone'] = $request->phone;
        $data['endDate'] = $dateTime;
        if($request->enable == 'true'){
            $data['enable'] = true;
        }else{
            $data['enable'] = false;
        }
        if($request->accessCamera && $request->accessCamera == '1'){
            $data['accessCamera'] = 1;
        }else{
            $data['accessCamera'] = 0;
        }
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('Updated', 'شرکت مورد نظر ویرایش شد.');
        return redirect('admin/companies/all');
    }
    public function delete(Request $request){
        Company::find($request->id)->delete();
        $request->session()->flash('Deleted', 'شرکت مورد نظر حذف شد.');
        return back();
    }
    public function personels(Request $request){
        $company = Company::find($request->id);
        $all = User::where('companyId',$request->id)->where('type',5)->get();
        $request->session()->flash('Updated', 'شرکت مورد نظر ویرایش شد.');
        return view('admin.company.personels')->with('all',$all)->with('company', $company);
    }
    protected function convert($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
    
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    
        return $englishNumbersOnly;
    }
    public function companySidedishes(Request $request){
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
        $user = User::find(Company::find($request->id)->manager);
        return view('admin.company.sides')
                                        ->with('weekOfMonth',$weekOfMonth)
                                        ->with('user',$user)
                                        ->with('dayOfWeek',$dayOfWeek)
                                        ->with('plan',$plan->desserts[$weekOfMonth]);
    }
    public function companySidedishesUpdate(Request $request){
        $arr = array();
        $User = User::find($request->userId);
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
    public function userPlan(Request $request){
        $func = new functions();
        $materials = Material::all();
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();

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
        $user = User::find($request->id);
        return view('admin.company.user_meals')->with('materials', $materials)
                                    ->with('weekOfMonth',$weekOfMonth)
                                    ->with('dayOfWeek',$dayOfWeek)
                                    ->with('user',$user)
                                    ->with('plan',$plan->days[$weekOfMonth]);
    }
    public function userPlanUpdate(Request $request){
        $arr = array();
        $User = User::find($request->userId);
        if($User->plates){
            foreach($User->plates as $key=>$row){
                if($row != null){
                    $arr[$key] = $row;
                }
            }
        }
        
        foreach($request->plate as $key=>$row){
            if($row != null){
                $arr[$key] = $row;
            }
        }
        $User->update(['plan' => $arr]);
        return back();
    }
    public function daily(Request $request){
        $company = Company::find($request->id);
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
        if(isset($usr->dessert[Carbon::now()->format('Y-m-d')])){
            
            foreach($usr->dessert[Carbon::now()->format('Y-m-d')] as $key=>$row){
                $data['dessert'][$key]['name'] = Dessert::find($row['name'])->name;
                $data['dessert'][$key]['count'] = $row['count'];
            }
        }else{
            $data['dessert'] = null;
        }
        if(isset($usr->guest[Carbon::now()->format('Y-m-d')])){
            foreach($usr->guest[Carbon::now()->format('Y-m-d')] as $key=>$row){
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
        $columns = array('نام کارمند', 'نوع کارمند', 'غذا');
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
    public function endOfMonth(Request $request){
        $company = Company::find($request->id);
        $usr = User::find($company->manager);
        $func = new functions();
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');
        
        $personels = User::where('companyId',$company->id)->get();
        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
		if($day > 25){
          $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m') + 1;
        }else{
          $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        }
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $startOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber,1 );
        $endOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber+1,1 );
        $gregoryDates = CarbonPeriod::create($startOfMonth[0].'-'.$startOfMonth[1].'-'.$startOfMonth[2]
                                            , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]));


        $startOfMonth2 = Carbon::now()->addHour(12)->format('Y-m-d');
        $gregoryDates2 = CarbonPeriod::create($startOfMonth2
                                            , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]-1));
        $weekCounter = 0;
      	$currentWeek = 0;
        
        $data = array();
        foreach($gregoryDates as $key2=>$row2){
          	if($row2->format('D') == 'Sat' || $gregoryDates->startDate == $row2){
                $weekCounter++;
            }
            if($row2->format('Y-m-d') == Carbon::now()->format('Y-m-d')){
                $currentWeek = $weekCounter -1;
            }
          
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
                    if(isset($row->plan[$row2->format('Y-m-d')])) {
                   
                        $data[$key2]['users'][$key]['plate'] = Plate::find($row->plan[$row2->format('Y-m-d')])->name ?? "عدم انتخاب";
                    
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
              $plates = array();
              $tempPlates = array();
            
              foreach($da['users'] as $item)
              {        
                 $plateName = $item["plate"];    
                 array_push($tempPlates , $plateName);
                 $plates[$plateName] =  $plateName;     
              }
              foreach($plates as $plate)
              {     
                $countAr = array_count_values($tempPlates);
                $count = $countAr[$plate];
                $temp1 = array($plate,$count);
                 fputcsv($file,  $temp1 );
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
}

