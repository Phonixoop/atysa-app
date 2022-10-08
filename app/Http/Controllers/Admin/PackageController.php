<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function new(){

        return view('admin.side.new');
    }
    public function single(Request $request){
        $single = Package::find($request->id);
        return view('admin.side.single')->with('single',$single);
    }
    public function all(){
        $all = Package::all();
        return view('admin.side.all')->with('all',$all);
    }
    public function create(Request $request){
        $new = new Package();
        $array = array();
        foreach($request->childs as $row){
            if($row['name'] != null){
                array_push($array, $row);
            }
        }
        $new->name = $request->name;
        $new->childs = $array;
        $new->calory = $request->calory;
        $new->size = $request->size;
        $new->save();
        $request->session()->flash('Inserted', 'بشقاب مورد نظر افزوده شد.');
        return redirect('admin/side/all');
    }
    public function update(Request $request){
        $single = Package::find($request->id);
        $array = array();
        foreach($request->childs as $row){
            if($row['name'] != null){
                array_push($array, $row);
            }
        }
        $data = array();
        $data['name'] = $request->name;
        $data['calory'] = $request->calory;
        $data['size'] = $request->size;
        $data['childs'] = $array;
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('updated', 'بشقاب مورد نظر ویرایش شد.');
        return redirect('admin/side/all');
    }
    public function delete(Request $request){
        $single = Package::find($request->id)->delete();
        $request->session()->flash('removed', 'بشقاب مورد نظر حذف شد.');
        return back();
    }
    public function duplicate(Request $request){
        $dessert = Package::find($request->id);
        $newdessert = $dessert->replicate();
        $newdessert->save();
        $request->session()->flash('updated', 'بشقاب مورد نظر کپی شد.');
        return redirect('admin/side/all');
    }
}
