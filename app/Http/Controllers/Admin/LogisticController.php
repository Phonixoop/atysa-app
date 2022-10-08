<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Hotbox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function hotboxUpdate(Request $request){
        $company = Company::find($request->id);
        $data = array();
        $data['hotboxes'] = $request->hotboxes;
        $company->update($data);
        return back();
    }
    public function all(){
        $company = Company::all();
        $hotboxes = Hotbox::all();
        return view('admin.logistic.all')->with('all',$company)->with('hotboxes',$hotboxes);
    }
}
