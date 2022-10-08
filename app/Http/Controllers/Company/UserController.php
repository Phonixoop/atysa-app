<?php

namespace App\Http\Controllers\Company;

use App\Classes\functions;
use App\Models\Company;
use App\Models\Holiday;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Plan;
use App\Models\Plate;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class UserController extends Controller
{
    public function validation($data){
        return Validator::make($data, [
            'mobile' => ['required', 'string', 'unique:users','numeric','digits:11'],
            'name' => ['required', 'string', 'max:255'],
        ],[
            'mobile.required' => 'شماره موبایل را وارد نکرده اید',
            'name.required' => 'نام الزامی است',
            'mobile.unique' => 'شماره موبایل تکراری است',
            'mobile.numeric' => 'شماره موبایل نمی تواند شامل حروف باشد',
            'mobile.digits' => 'شماره موبایل باید 11 رقم باشد',
        ]);
    }
    public function new(){
        return view('company.user.new');
    }
    public function single(Request $request){
        $single = User::find($request->id);
        return view('company.user.single')->with('single',$single);
    }
    public function all(){
        $company = Company::where('manager',Auth::user()->id)->first();
        $all = User::where('companyId',$company->id)->where('type',5)->get();
        return view('company.user.all')->with('all',$all);
    }
    public function create(Request $request){
        $validation = $this->validation($request->all());
        if ($validation->fails()) {
            return back()->withErrors($validation);
        }else{
            $new = new User();
            $company = Company::where('manager',Auth::user()->id)->first();
            $isVip = 0;
            if(isset($request->isVip) && $request->isVip == '1'){
                $isVip = 1;
            }
            
            $new->create(array_merge($request->all(), 
                                        ['password' => Hash::make('123456'),
                                        'companyId' => $company->id,
                                        'type' => 5,
                                        'activated' => 1,
                                        'isVip' => $isVip])
                                    );
            $function = new functions();
            $function->welcomeMessage($request->mobile,$request->name);
            $request->session()->flash('Inserted', 'کاربر مورد نظر افزوده شد.');
            return redirect('company/users/all');
        }
    }
    public function update(Request $request){
        $single = User::find($request->id);
        // $validation = $this->validation($request->all());
        // if ($validation->fails()) {
        //     return back()->withErrors($validation);
        // }else{
            $data = array();
            $data['name'] = $request->name;
            $data['mobile'] = $request->mobile;
            $isVip = 0;
            if(isset($request->isVip) ){
                $isVip = $request->isVip;
            }
            $data['isVip'] = $isVip;
            if($request->password && $request->password != null){
                $data['password'] = Hash::make($request->password);
            }
            $data['email'] = $request->email;
            $single->update($data, ['upsert' => true]);
            $request->session()->flash('Updated', 'کاربر مورد نظر ویرایش شد.');
            return redirect('company/users/all');
        // }
    }
    public function delete(Request $request){
        $single = User::find($request->id)->delete();
        $request->session()->flash('Deleted', 'کاربر مورد نظر حذف شد.');
        return back();
    }
    public function loginAs(Request $request){
        $user = User::find($request->id);
        Auth::login($user);
        return redirect('/');
    }
    public function file(){
        return view('company.user.upload');
    }
    public function upload(Request $request){
        $function = new functions();
        $company = Company::where('manager',Auth::user()->id)->first();
        if (!file_exists($request->file) || !is_readable($request->file))
        return false;
        $customerArr = $function->csvToArray($request->file);
        foreach($customerArr as $customer){
            $validation = $this->validation($customer);
            if ($validation->fails()) {
                return back()->withErrors($validation);
            }else{
                $new = new User();
                $new->create(array_merge($customer, 
                                        ['password' => Hash::make('123456'),
                                        'companyId' => $company->id,
                                        'type' => 5,
                                        'activated' => 1])
                                    );
                }
                $function->welcomeMessage($customer['mobile'],$customer['name'] );
        }
        return redirect('company/users/all');
    }
   public function plan(Request $request){
      $func = new functions();
     
        $dateWithCurrentMonth = Carbon::now();
        $dateWithNextMonth = Carbon::now()->addMonth(1);
  
      	$day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
      
      if($day >= 29)
         $dynamicDate = $dateWithNextMonth;
      else 
         $dynamicDate = $dateWithCurrentMonth;
      
    
        $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($dynamicDate);
      	$currentMonthDaysCount = \Morilog\Jalali\Jalalian::fromCarbon($dynamicDate)->getMonthDays();
  
      	
     
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('M');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('Y');
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('d');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getMonthDays();
		
      	
		
       
    
      	$nextMonth = \Morilog\Jalali\Jalalian::fromCarbon($dynamicDate->addDays(30));
        $currentMonthNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now()->addWeek(1))->format('m');
        $currentYearNumber = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
         $startOfMonth = CalendarUtils::toGregorian($jalaliDate->format("Y"), $jalaliDate->format("m"),1);
         $endOfMonth = CalendarUtils::toGregorian($jalaliDate->format("Y"),$nextMonth->format("m"),1);
         $gregoryDates = CarbonPeriod::create($startOfMonth[0].'-'.$startOfMonth[1].'-'.$startOfMonth[2], 
                                              $endOfMonth[0].'-'.$endOfMonth[1].'-'.$endOfMonth[2]);
        
      
    
      
      //  $startOfMonth = CalendarUtils::toGregorian($currentYearNumber,$currentMonthNumber,1 );
      //  $gregoryDates = CarbonPeriod::create($startOfMonth[0].'-'.$startOfMonth[1].'-'.($startOfMonth[2])
                                      //      , $endOfMonth[0].'-'.$endOfMonth[1].'-'.($endOfMonth[2]-1));

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
        if($startOfWeek <= 1) {
            $weekOfMonth = 0;
        } elseif($startOfWeek >= 2 && $startOfWeek < 9){
            $weekOfMonth = 1;
        }
        elseif($startOfWeek >= 9 && $startOfWeek < 16){
            $weekOfMonth = 2;
        }
        elseif($startOfWeek >= 16 && $startOfWeek < 23){
            $weekOfMonth = 3;
        }elseif($startOfWeek >= 23 && $startOfWeek < 30){
            $weekOfMonth = 4;
        }else{
        	$weekOfMonth = 5;
        }
      	$monthName = $func->returnFullMonthFromDateType($jalaliDate->format("M"));
  
        $plan = Plan::where('month', $monthName)->first();
    
        $mydishes = Plate::where('userId', Auth::id())->get();
        $myArray = array();
        $planning = [];
        foreach($mydishes as $key=>$row){
            $myArray[$key] = $row->id;
        }
  
        foreach($plan->days[$weekOfMonth] as $key=>$row){
            $planning[$key] = $row;
            foreach($myArray as $row2){
                array_push($planning[$key], $row2);
            }
        }
      
      
 
   
         if($currentMonthDaysCount == 31) $weekOfMonth = 0;
      	 else if($currentMonthDaysCount == 30) $weekOfMonth = -1;
         else if($currentMonthDaysCount == 29) $weekOfMonth = -2;
         else $weekOfMonth = -3;
     
        return view('company.plan.user_meals')
        ->with('myDishes',$myArray)->with('weekOfMonth',$weekOfMonth)
        ->with('dayOfWeek',$dayOfWeek)->with('plan',$plan)->with('gregoryDates',$gregoryDates)
        ->with('holidayInWeek',$holidayInWeek)->with('monthNumber',$jalaliDate->format("m"))->with('user',User::find($request->id));
        // ->with('materials', $materials)
        //                             ->with('weekOfMonth',$weekOfMonth)
        //                             ->with('dayOfWeek',$dayOfWeek)
        //                             ->with('user',$user)
        //                             ->with('plan',$plan->days[$weekOfMonth]);
    }
    public function planUpdate(Request $request){
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
    public function profile(){
        return view('company.profile');
    }
    public function profileUpdate(Request $request){
        $function = new functions();
        $data = array();
        if($request->password && $request->password != null){
            $data['password'] = Hash::make($request->password);
        }
        $imgUrl = Auth::user()->avatar;
        if ($request->hasFile('file')) {
            $fileName = $function->uploadImage($request->file('file'), 'uploads/avatars',$imgUrl);
            $imgUrl = $fileName;
        }
        $data['avatar'] = $imgUrl;
        $user = User::find(Auth::id());
        $user->update($data);
        return back();
    }
    public function cam(){
        $key = 'nodemedia2017privatekey';
        $streamId = '/Catering/FrontLine';
        $streamId2 = '/Catering/RiceLine';
        $streamId3 = '/Catering/HotBoxLine';
        $streamId4 = '/Catering/WashingLine';
        $exp = time()+ 1000000;
        $md = $exp.'-'.md5($streamId.'-'.$exp.'-'.$key);
        $md2 = $exp.'-'.md5($streamId2.'-'.$exp.'-'.$key);
        $md3 = $exp.'-'.md5($streamId3.'-'.$exp.'-'.$key);
        $md4 = $exp.'-'.md5($streamId4.'-'.$exp.'-'.$key);
        return view('company.cam')->with('md', $md)->with('md2', $md2)->with('md3', $md3)->with('md4', $md4);
    }
}