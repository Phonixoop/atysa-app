<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dessert;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Plate;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function new(){
        $plates = Plate::all();
        $dessert = Dessert::all();
        return view('admin.plan.new')->with('plates',$plates)->with('dessert',$dessert);
    }
    public function single(Request $request){
        $single = Plan::find($request->id);
        $plates = Plate::where('userId',null)->get();
        $dessert = Dessert::all();
        return view('admin.plan.single')->with('single',$single)->with('plates',$plates)->with('desserts',$dessert);
    }
    public function all(){
        $all = Plan::all();
        return view('admin.plan.all')->with('all',$all);
    }
    public function create(Request $request){
        $new = new Plan();
        $array = array();

        $new->month = $request->month;
        $new->days = $request->days;
        $new->desserts = $request->desserts;
        $new->default = $request->default;
        $new->save();
        $request->session()->flash('Inserted', 'بشقاب مورد نظر افزوده شد.');
        return redirect('admin/plans/all');
    }
    public function update(Request $request){
        $single = Plan::find($request->id);
        $data = array();
        $data['month'] = $request->month;
        $data['days'] = $request->days;
        $data['desserts'] = $request->desserts;
        $data['default'] = $request->default;
        $single->update($data, ['upsert' => true]);
        
        $request->session()->flash('updated', 'بشقاب مورد نظر ویرایش شد.');
        return redirect('admin/plans/all');
    }
    public function delete(Request $request){
        $single = Plan::find($request->id)->delete();
        $request->session()->flash('removed', 'بشقاب مورد نظر حذف شد.');
        return back();
    }
}
