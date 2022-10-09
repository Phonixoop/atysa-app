<?php

namespace App\Http\Controllers\Admin;

use App\Classes\functions;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Plate;
use App\Models\Poll;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\CalendarUtils;

class UserController extends Controller
{
    public function validation($data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'string', 'unique:users', 'numeric', 'digits:11'],
            'name' => ['required', 'string', 'max:255'],
        ], [
            'mobile.required' => 'شماره موبایل را وارد نکرده اید',
            'name.required' => 'نام الزامی است',
            'mobile.unique' => 'شماره موبایل تکراری است',
            'mobile.numeric' => 'شماره موبایل نمی تواند شامل حروف باشد',
            'mobile.digits' => 'شماره موبایل باید 11 رقم باشد',
        ]);
    }
    public function new()
    {
        return view('admin.user.new');
    }
    public function single(Request $request)
    {
        $single = User::find($request->id);
        $companies = Company::all();
        return view('admin.user.single')->with('single', $single)->with('companies', $companies);
    }
    public function all()
    {
        $all = User::all();
        return view('admin.user.all')->with('all', $all);
    }
    public function create(Request $request)
    {
        $validation = $this->validation($request->all());
        if ($validation->fails()) {
            return back()->withErrors($validation);
        } else {
            $new = new User();
            $new->create(array_merge($request->all(), ['password' => Hash::make('//7d8sa8d&^&*^D8saa7d9'), 'activated' => 1]));
            $request->session()->flash('Inserted', 'کاربر مورد نظر افزوده شد.');
            return redirect('admin/users/all');
        }
    }
    public function update(Request $request)
    {
        // $validation = $this->validation($request->all());
        // if ($validation->fails()) {
        //     return back()->withErrors($validation);
        // }else{
        $single = User::find($request->id);
        $data = array();
        $data['type'] = $request->type;
        $data['name'] = $request->name;
        $data['activated'] = $request->activated == 1 ? true : false;
        $data['mobile'] = $request->mobile;
        $data['companyId'] = $request->companyId;
        if ($request->password && $request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        $data['email'] = $request->email;
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('Updated', 'کاربر مورد نظر ویرایش شد.');
        return redirect('admin/users/all');
        // }
    }
    public function delete(Request $request)
    {
        $single = User::find($request->id)->delete();
        $request->session()->flash('Deleted', 'کاربر مورد نظر حذف شد.');
        return back();
    }
    public function loginAs(Request $request)
    {
        $user = User::find($request->id);
        Auth::login($user);
        if ($user->type == 1) {
            return redirect('/admin');
        } elseif ($user->type == 4) {
            return redirect('/company');
        } elseif ($user->type == 6) {
            return redirect('/logistic');
        } elseif ($user->type == 2) {
            return redirect('/sale');
        } else {
            return redirect('/');
        }
    }
    public function profile()
    {
        return view('admin.profile');
    }
    public function profileUpdate(Request $request)
    {
        $function = new functions();
        $data = array();
        if ($request->password && $request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        $imgUrl = Auth::user()->avatar;
        if ($request->hasFile('file')) {
            $fileName = $function->uploadImage($request->file('file'), 'uploads/avatars', $imgUrl);
            $imgUrl = $fileName;
        }
        $data['avatar'] = $imgUrl;
        $user = User::find(Auth::id());
        $user->update($data);
        return back();
    }
    public function poll()
    {
        $func = new functions();
        $poll = Poll::orderBy('created_at', 'DESC')->get();
        $extra = array();
        foreach ($poll as $key => $row) {
            if (isset($row->mobile)) {

                $user = User::where('mobile', 'like', '%' . $this->convert2english($row->mobile) . '%')->first();
                if ($user) {
                    $extra[$key]['user'] = $user->name;
                    if (isset($user->plan)) {
                        if (isset($user->plan[Carbon::parse($row->created_at)->format('Y-m-d')])) {
                            $extra[$key]['food'] = Plate::find($user->plan[Carbon::parse($row->created_at)->format('Y-m-d')])->name;
                        } else {
                            $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($row->created_at))->format('M');
                            $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
                            $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::parse($row->created_at)));
                            $extra[$key]['food'] = Plate::find($plan->default[1][$currentDay])->name;
                        }
                    } else {
                        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($row->created_at))->format('M');
                        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
                        $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::parse($row->created_at)));
                        $extra[$key]['food'] = Plate::find($plan->default[1][$currentDay])->name;
                    }
                    if (isset($user->companyId)) {
                        $company = Company::find($user->companyId);
                        $extra[$key]['company'] = $company->name;
                    }
                }
            }
        }
        return view('admin.poll')->with('poll', $poll)->with('extra', $extra);
    }
    public function exportPoll()
    {
        $func = new functions();
        $poll = Poll::orderBy('created_at', 'DESC')->get();
        foreach ($poll as $key => $row) {
            if (isset($row->mobile)) {

                $user = User::where('mobile', 'like', '%' . $this->convert2english($row->mobile) . '%')->first();
                if ($user) {
                    $extra[$key]['user'] = $user->name;
                    if (isset($user->plan)) {
                        if (isset($user->plan[Carbon::parse($row->created_at)->format('Y-m-d')])) {
                            $extra[$key]['food'] = Plate::find($user->plan[Carbon::parse($row->created_at)->format('Y-m-d')])->name;
                        } else {
                            $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($row->created_at))->format('M');
                            $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
                            $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::parse($row->created_at)));
                            $extra[$key]['food'] = Plate::find($plan->default[1][$currentDay])->name;
                        }
                    } else {
                        $mainMonth = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($row->created_at))->format('M');
                        $plan = Plan::where('month', $func->returnFullMonthFromDateType($mainMonth))->first();
                        $currentDay = CalendarUtils::strftime('w', strtotime(Carbon::parse($row->created_at)));
                        $extra[$key]['food'] = Plate::find($plan->default[1][$currentDay])->name;
                    }

                    if (isset($user->companyId)) {
                        $company = Company::find($user->companyId);
                        $extra[$key]['company'] = $company->name;
                    }
                }
            }
        }
        $fileName = Carbon::now()->format('Y-m-d-h-s') . '.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('نام غذا', 'رنگ غذا', 'ظاهر کلی غذا', 'بافت غذا', 'چقدر لذت بردید', 'سفارش مجدد', 'موبایل', 'مشتری', 'شرکت', 'تاریخ');
        $callback = function () use ($poll, $extra, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $columns);

            foreach ($poll as $key => $row) {
                $array = array(
                    isset($extra[$key]['food']) ? $extra[$key]['food'] : '',
                    $row->rangeGhaza,
                    $row->zaherKolli,
                    $row->bafteGhaza,
                    $row->cheghadrLezzat,
                    $row->mojaddad,
                    $row->mobile,
                    isset($extra[$key]['user']) ? $extra[$key]['user'] : '',
                    isset($extra[$key]['company']) ? $extra[$key]['company'] : '',
                    \Morilog\Jalali\CalendarUtils::strftime('Y/m/d h:i:s', strtotime($row->created_at))
                );
                fputcsv($file, $array);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    private function convert2english($string)
    {
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
