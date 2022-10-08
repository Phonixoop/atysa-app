<?php

namespace App\Http\Controllers\Admin;

use App\Models\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;

class HolidayController extends Controller
{
    protected function convert($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
    
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    
        return $englishNumbersOnly;
    }
    public function new(){

        return view('admin.holiday.new');
    }
    public function single(Request $request){
        $single = Holiday::find($request->id);
        return view('admin.holiday.single')->with('single',$single);
    }
    public function all(){
        $all = Holiday::all();
        return view('admin.holiday.all')->with('all',$all);
    }
    public function create(Request $request){
        $new = new Holiday();
        $tempDate = $this->convert($request->date);
        $new->date = CalendarUtils::createDatetimeFromFormat('Y/n/j', $tempDate);
        $new->save();
        $request->session()->flash('Inserted', 'بشقاب مورد نظر افزوده شد.');
        return redirect('admin/holiday/all');
    }
    public function update(Request $request){
        $single = Holiday::find($request->id);
        $tempDate = $this->convert($request->date);
        $ddd = CalendarUtils::createDatetimeFromFormat('Y/n/j', $tempDate);
        $data = array();
        $data['date'] = $ddd;
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('updated', 'بشقاب مورد نظر ویرایش شد.');
        return redirect('admin/holiday/all');
    }
    public function delete(Request $request){
        $single = Holiday::find($request->id)->delete();
        $request->session()->flash('removed', 'بشقاب مورد نظر حذف شد.');
        return back();
    }
}
