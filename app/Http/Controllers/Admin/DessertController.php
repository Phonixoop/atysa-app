<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dessert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DessertController extends Controller
{
    public function new(){

        return view('admin.dessert.new');
    }
    public function single(Request $request){
        $single = Dessert::find($request->id);
        return view('admin.dessert.single')->with('single',$single);
    }
    public function all(){
        $all = Dessert::all();
        return view('admin.dessert.all')->with('all',$all);
    }
    public function create(Request $request){
        $new = new Dessert();
        $new->name = $request->name;
        $new->calory = $request->calory;
        $new->save();
        $request->session()->flash('Inserted', 'بشقاب مورد نظر افزوده شد.');
        return redirect('admin/dessert/all');
    }
    public function update(Request $request){
        $single = Dessert::find($request->id);
        $data = array();
        $data['name'] = $request->name;
        $data['calory'] = $request->calory;
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('updated', 'بشقاب مورد نظر ویرایش شد.');
        return redirect('admin/dessert/all');
    }
    public function delete(Request $request){
        $single = Dessert::find($request->id)->delete();
        $request->session()->flash('removed', 'بشقاب مورد نظر حذف شد.');
        return back();
    }
    public function duplicate(Request $request){
        $dessert = Dessert::find($request->id);
        $newdessert = $dessert->replicate();
        $newdessert->save();
        $request->session()->flash('updated', 'بشقاب مورد نظر کپی شد.');
        return redirect('admin/dessert/all');
    }
}
