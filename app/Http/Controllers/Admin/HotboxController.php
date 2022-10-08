<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotbox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotboxController extends Controller
{
    public function new(){

        return view('admin.hotbox.new');
    }
    public function single(Request $request){
        $single = Hotbox::find($request->id);
        return view('admin.hotbox.single')->with('single',$single);
    }
    public function all(){
        $all = Hotbox::all();
        return view('admin.hotbox.all')->with('all',$all);
    }
    public function create(Request $request){
        $new = new Hotbox();
        $new->name = $request->name;
        $new->capacity = $request->capacity;
        $new->save();
        $request->session()->flash('Inserted', 'هات باکس مورد نظر افزوده شد.');
        return redirect('admin/hotbox/all');
    }
    public function update(Request $request){
        $single = Hotbox::find($request->id);
        $data = array();
        $data['name'] = $request->name;
        $data['capacity'] = $request->capacity;
        $single->update($data, ['upsert' => true]);
        $request->session()->flash('updated', 'هات باکس مورد نظر ویرایش شد.');
        return redirect('admin/hotbox/all');
    }
    public function delete(Request $request){
        Hotbox::find($request->id)->delete();
        $request->session()->flash('removed', 'هات باکس مورد نظر حذف شد.');
        return back();
    }
    public function duplicate(Request $request){
        $dessert = Hotbox::find($request->id);
        $newdessert = $dessert->replicate();
        $newdessert->save();
        $request->session()->flash('updated', 'هات باکس مورد نظر کپی شد.');
        return redirect('admin/hotbox/all');
    }
}
