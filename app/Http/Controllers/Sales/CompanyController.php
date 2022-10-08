<?php

namespace App\Http\Controllers\Sales;

use App\Classes\functions;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Plan;
use App\Models\Plate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        return view('sale.company.new')->with('managers',$managers);
    }
    public function single(Request $request){
        $single = Company::find($request->id);
        $managers = User::where('type','=','4')->get();
        return view('sale.company.single')->with('single',$single)
                                           ->with('managers',$managers);
    }
    public function all(){
        $all = Company::all();
        $managers = array();
        foreach($all as $key=>$row){
            $managers[$key] = User::find($row->manager);
        }
        return view('sale.company.all')->with('all',$all)->with('managers',$managers);
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
        return redirect('sale/companies/all');
    }
    public function update(Request $request){
        $single = Company::find($request->id);
        $data = array();
        $tempDate = $this->convert($request->endDate);
        $dateTime = CalendarUtils::createDatetimeFromFormat('Y/n/j', $tempDate);
        $data['name'] = $request->name;
        $data['manager'] = $request->manager;
        $data['phone'] = $request->phone;
        $data['endDate'] = $dateTime;
        if($request->enable == 'true'){
            $data['enable'] = true;
        }else{
            $data['enable'] = false;
        }
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('Updated', 'شرکت مورد نظر ویرایش شد.');
        return redirect('sale/companies/all');
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
        return view('sale.company.personels')->with('all',$all)->with('company', $company);
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
        return view('sale.company.sides')
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
        return view('sale.company.user_meals')->with('materials', $materials)
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
        $day = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('d');
        $month = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('m');
        $Year = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('Y');
        $dayOfWeek = (new Jalalian(intval($Year), intval($month), intval($day)))->getDayOfWeek();
        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::now())->format('M');


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

        $function = new functions();
        $users = User::where('companyId', $request->id)->get();
        $today = Carbon::now()->format('Y-m-d');
        $plan = Plan::where('month', $function->returnFullMonthFromDateType($mainMonth))->first();
        $todayDishes = $plan->days[$weekOfMonth][$dayOfWeek];
        // $todayDesserts = $plan->desserts[$weekOfMonth][$dayOfWeek];
        $data = array();
        foreach($users as $key=>$user){
            $data['users'][$key]['user'] = $user->name;
            if($user->plates && $user->plates[$today]){
                $data['users'][$key]['plate'] = Plate::find($user->plates[$today])->name;
            }else{
                $data['users'][$key]['plate'] = Plate::find($todayDishes[0])->name;
            }
        }
        foreach($todayDishes as $key=>$dish){
            $data['dishes'][$key]['name'] = Plate::find($dish)->name;
            $data['dishes'][$key]['count'] = 0;
            foreach($users as $user){
                if($user->plates && $user->plates[$today]){
                    $data['dishes'][$key]['count']++;
                }else{
                    $data['dishes'][$key]['count']++;
                }
            }
        }
        return view('sale.company.daily')->with('data',$data);
    }
    public function loginAs(Request $request){
        $company = Company::find($request->id);
        $manager = User::find($company->manager);
        Auth::logout();
        Auth::login($manager);
        return redirect('/company');
    }
    public function profile(){
        return view('sale.profile');
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
}
