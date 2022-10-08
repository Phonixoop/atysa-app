<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;

class UserplateController extends Controller
{
    public function single(Request $request){
        $single = Plate::find($request->id);
        return view('admin.userplate.single')->with('single',$single);
    }
    public function all(){
        $all = Plate::where('userId','!=',null)->get();
        return view('admin.userplate.all')->with('all',$all);
    }
    public function update(Request $request){
        $single = Plate::find($request->id);
        $array = array();
        foreach($request->materials as $row){
            if($row['name'] != null){
                array_push($array, $row);
            }
        }
        $data = array();
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['calory'] = $request->calory;
        $data['size'] = $request->size;
        $data['materials'] = $array;
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('updated', 'بشقاب مورد نظر ویرایش شد.');
        return redirect('admin/userplate/all');
    }
    public function delete(Request $request){
        $single = Plate::find($request->id)->delete();
        $request->session()->flash('removed', 'بشقاب مورد نظر حذف شد.');
        return back();
    }
}
